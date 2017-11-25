<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 07/11/2017
 * Time: 11:33
 */


function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;

    // This stops JavaScript being able to access the session id.
    $httponly = true;

    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location:  index.php?reponse=1");
        exit();
    }

    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);

    // Sets the session name to the one set above.


    session_name($session_name);

    session_start();            // Start the PHP session
    session_regenerate_id();    // regenerated the session, delete the old one.
}

function login($email, $password, $mysqli) {
    // Using prepared statements means that SQL injection is not possible.
    if ($stmt = $mysqli->prepare("SELECT uid,password, salt,roles  FROM users WHERE email = ? LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();

        // get variables from result.
        $stmt->bind_result($id_users, $db_password, $salt,$roles);
        $stmt->fetch();

        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts
            if (checkbrute($id_users, $mysqli) == true) {
                // Account is locked
                // Send an email to user saying their account is locked
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];

                    // XSS protection as we might print this value
                    $id_users = preg_replace("/[^0-9]+/", "", $id_users);
                    $_SESSION['id_users'] = $id_users;

                    $roles = preg_replace("/[^0-9]+/", "", $roles);
                    $_SESSION['roles'] = $roles;



                    // XSS protection as we might print this value

                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);

                    // Login successful.
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    if (!$mysqli->query("INSERT INTO login_attempts(uid, time)  VALUES ('$id_users', '$now')")) {
                        header("Location: index.php?reponse=2");
                        exit();
                    }

                    return false;
                }
            }
        } else {
            // No user exists.
            return false;
        }
    } else {
        // Could not create a prepared statement
        header("Location: index.php?reponse=3");
        exit();
    }
}

function checkbrute($id_users, $mysqli) {
    // Get timestamp of current time
    $now = time();

    // All login attempts are counted from the past 2 hours.
    $valid_attempts = $now - (2 * 60 * 60);

    if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE uid = ? AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $id_users);

        // Execute the prepared query.
        $stmt->execute();
        $stmt->store_result();

        // If there have been more than 5 failed logins
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    } else {
        // Could not create a prepared statement
        header("Location: index.php?reponse=4");
        exit();
    }
}

function login_check($mysqli) {
    // Check if all session variables are set
    if (isset($_SESSION['id_users'], $_SESSION['login_string'])) {
        $id_users = $_SESSION['id_users'];
        $login_string = $_SESSION['login_string'];



        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        if ($stmt = $mysqli->prepare("SELECT password FROM users WHERE uid = ? LIMIT 1")) {
            // Bind "$id_users" to parameter.
            $stmt->bind_param('i', $id_users);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);

                if ($login_check == $login_string) {
                    // Logged In!!!!
                    return true;
                } else {
                    // Not logged in
                    return false;
                }
            } else {
                // Not logged in
                return false;
            }
        } else {
            // Could not prepare statement
            header("Location: index.php?reponse=5");
            exit();
        }
    }



    else {
        // Not logged in
        return false;
    }
}
function droitCocher($name,$mysqli)
{
    $decoupe = explode('_',$name);
    $sql = $mysqli->query('SELECT '._champsAappeler($decoupe[1]).' FROM'.' '._tableAappeler($decoupe[0]).' WHERE id_entity_access='.$decoupe[2].' and rid='.$decoupe[3].' and '._champsAappeler($decoupe[1]).'=1');
    $res = $sql->num_rows;
    if($res == 1):
        return 'checked';
    else:
        return '';
    endif;
}

  function _tableAappeler($valeur)
{
    $retour = '';
    switch ($valeur)
    {
        case 'show' :
            $retour = 'access_show';
            break;
        case 'delete' :
            $retour = 'access_delete';
            break;
        case 'update' :
            $retour = 'access_update';
            break;
        case 'create' :
            $retour = 'access_create';
            break;
        case 'page' :
            $retour = 'access_page';
            break;
        default :
            $retour = FALSE;
            break;

    }
    return $retour;
}

 function _champsAappeler($valeur)
{
    $retour = '';
    switch ($valeur)
    {
        case 'own' :
            $retour = 'son';
            break;
        case 'all' :
            $retour = 'tous';
            break;
        case 'page' :
            $retour ='page';
            break;
        default :
            $retour = FALSE;
            break;

    }
    return $retour;
}

function debug($var) {
    $debug = debug_backtrace();
    echo '<p>&nbsp;</p><p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;"><strong>' . $debug[0]['file'] . ' </strong> l.' . $debug[0]['line'] . '</a></p>';
    echo '<ol style="display:none;">';
    foreach ($debug as $k => $v) {
        if ($k > 0) {
            echo '<li><strong>' . $v['file'] . '</strong> l.' . $v['line'] . '</li>';
        }
    }
    echo '</ol>';
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

function ConvertirTimestampDate($timestamp)
{
    return date('d-m-Y', $timestamp);
}
function ConvertirDatetimestamp($date)
{
    $publishDate = DateTime::createFromFormat('Y-m-d', $date);
    return $publishDate->getTimestamp();
}

function AuteurContenu($mysqli,$uid)
{
    $stmt = $mysqli->query("SELECT name  FROM users WHERE uid =$uid LIMIT 1");
    return $stmt->fetch_all();
}

function chaineProteger($chaine)
{
    return addslashes($chaine);
}

function chaineProtegerRetirer($var) // Fonction qui supprime l'effet des magic quotes

{

    if(is_array($var)) // Si la variable passée en argument est un array, on appelle la fonction stripslashes_r dessus

    {

        return array_map('stripslashes_r', $var);

    }

    else // Sinon, un simple stripslashes suffit

    {

        return stripslashes($var);

    }

}


