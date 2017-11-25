<?php
/**
 * Created by PhpStorm.
 * User: kpassoujerry-patrickozigre
 * Date: 19/11/2017
 * Time: 12:18
 */

?>
<div class="navbar-wrapper">
    <div class="container-fluid">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- <a class="navbar-brand" href="#">Logo</a> -->
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                    <?php foreach ($RestituerData->ListerMenuByParent(0) as $contentFront){?>
                        <li class="dropdown">
                            <?php if($contentFront[2] == '#'):?>
                            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $contentFront[1] ;?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($RestituerData->ListerMenuByParent($contentFront[0]) as $contentFrontSous){ ?>
                                    <li><a href="index.php?parcours=<?php echo $contentFrontSous[2] ;?>"><?php echo $contentFrontSous[1] ;?></a></li>
                                    <?php } ;?>
                                </ul>
                            <?php else: ?>
                            <a href="index.php?parcours=<?php echo $contentFront[2] ;?>"><?php echo $contentFront[1] ;?></a>
                            <?php endif; ?>


                        </li>
                    <?php }?>

                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
