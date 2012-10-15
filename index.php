<?php
/**
 * @version   $Id: index.php 1.0 2011-03-08 19:09:53 
 * @package   JoomLess Teplate Pack
 * @copyright Copyright (C) 1998 - 2011 Ideas Net Studio. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die; ?>

<!doctype html>
<?php 
//Identify of the visitor's Browser is IE and what version
$br = strtolower($_SERVER['HTTP_USER_AGENT']); // Browser ?
if(preg_match("/msie 6/", $br)) : ?>
<html xmlns:fb="http://ogp.me/ns/fb#" class="no-js ie6" lang="<?php echo $this->language; ?>">
<?php elseif (preg_match("/msie 7/", $br)): ?>
<html xmlns:fb="http://ogp.me/ns/fb#" class="no-js ie7" lang="<?php echo $this->language; ?>">
<?php elseif (preg_match("/msie 8/", $br)): ?>
<html xmlns:fb="http://ogp.me/ns/fb#" class="no-js ie8" lang="<?php echo $this->language; ?>">
<?php elseif (preg_match("/msie 9/", $br)): ?>
<html xmlns:fb="http://ogp.me/ns/fb#" class="no-js ie9" lang="<?php echo $this->language; ?>">
<?php else: ?>
<html xmlns:fb="http://ogp.me/ns/fb#" class="no-js" lang="<?php echo $this->language; ?>">
<?php endif; ?>
<head>
  <?php require_once( JPATH_THEMES.DS.$this->template.DS.'includes'.DS.'head.php' ); ?>
</head>
<?php if ($menu->getActive() == $menu->getDefault()) : ?>
<body id="homepage">
<?php else: ?>
<body>
<?php endif; ?>

    <?php //Top Positions Row
      if (
        $this->countModules('top1') || 
        $this->countModules('top2') || 
        $this->countModules('top3') || 
        $this->countModules('top4')
      ) : 
    ?>
    <div id="pageTop">
        <div class="container">
            <div class="row clearfix">
                <jdoc:include type="modules" name="top1" style="custom" />
                <jdoc:include type="modules" name="top2" style="custom" />
                <jdoc:include type="modules" name="top3" style="custom" />
                <jdoc:include type="modules" name="top4" style="custom" />  
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php //Header Positions Row
      if (
        $this->countModules('header1') || 
        $this->countModules('header2') || 
        $this->countModules('header3') || 
        $this->countModules('header4') ||
        $this->countModules('nav')
      ) : 
    ?>
    <header id="pageHeader">
        <div class="container">
            <div class="row clearfix">
                <jdoc:include type="modules" name="header1" style="custom" />
                <jdoc:include type="modules" name="header2" style="custom" />
                <jdoc:include type="modules" name="header3" style="custom" />
                <jdoc:include type="modules" name="header4" style="custom" />
                <jdoc:include type="modules" name="nav" style="custom" />
            </div>
        </div>
    </header>
    <?php endif; ?>

    <?php if ($this->countModules('banner')) : ?>
    <div id="pageBanner" class="container">
        <div class="container">
            <div class="row clearfix">
                <jdoc:include type="modules" name="banner" style="custom" />
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php //Above Positions Row
      if (
        $this->countModules('grid1') || 
        $this->countModules('grid2') || 
        $this->countModules('grid3') || 
        $this->countModules('grid4')
      ) : 
    ?>
    <div id="pageGrid1">
        <div class="container">
            <div class="row clearfix">
                <jdoc:include type="modules" name="grid1" style="custom" />
                <jdoc:include type="modules" name="grid2" style="custom" />
                <jdoc:include type="modules" name="grid3" style="custom" />
                <jdoc:include type="modules" name="grid4" style="custom" /> 
            </div> 
        </div>
    </div>
    <?php endif; ?>

    <div id="pageMain">
      <div class="container">
        <div class="row clearfix">
        <?php if ($this->countModules('breadcrumb')) : ?>
        <jdoc:include type="modules" name="breadcrumb" style="custom" />
        <?php endif; ?>

        <?php if ($this->countModules('left')) : ?>
        <aside id="left" class="span6">
          <jdoc:include type="modules" name="left" style="custom" />
        </aside>
        <?php endif; ?>

        <?php if (preg_replace("/(\r\n|\n|\r)/", "",$this->getBuffer('message')) != '<div id="system-message-container"></div>') : ?>
            <jdoc:include type="message" />
        <?php endif;?>
        <section id="middle" class="span<?php echo ($this->countModules('right'))?"9":"12"; ?>">
            <?php //Abovgriditions Row
              if (
                $this->countModules('above1') || 
                $this->countModules('above2') || 
                $this->countModules('above3') || 
                $this->countModules('above4')
              ) : 
            ?>
            <div id="pageAbove">
                <div class="row clearfix">
                    <jdoc:include type="modules" name="above1" style="custom" />
                    <jdoc:include type="modules" name="above2" style="custom" />
                    <jdoc:include type="modules" name="above3" style="custom" />
                    <jdoc:include type="modules" name="above4" style="custom" /> 
                </div>
            </div>
            <?php endif; ?>
            
            <jdoc:include type="component" />

            <?php //Under Positions Row
              if (
                $this->countModules('under1') || 
                $this->countModules('under2') || 
                $this->countModules('under3') || 
                $this->countModules('under4')
              ) : 
            ?>
            <div id="pageUnder">
                <div class="row clearfix">
                    <jdoc:include type="modules" name="under1" style="custom" />
                    <jdoc:include type="modules" name="under2" style="custom" />
                    <jdoc:include type="modules" name="under3" style="custom" />
                    <jdoc:include type="modules" name="under4" style="custom" /> 
                </div>
            </div>
            <?php endif; ?>
        </section>
       
        <?php if ($this->countModules('right')) : ?>
        <aside id="right" class="span3">
          <jdoc:include type="modules" name="right" style="custom" />
        </aside>
        <?php endif; ?>
        </div>
      </div>
    </div>

    <?php //Above Positions Row
      if (
        $this->countModules('grid5') || 
        $this->countModules('grid6') || 
        $this->countModules('grid7') || 
        $this->countModules('grid8')
      ) : 
    ?>
    <div id="pageGrid2">
        <div class="container">
            <div class="row clearfix">
                <jdoc:include type="modules" name="grid5" style="custom" />
                <jdoc:include type="modules" name="grid6" style="custom" />
                <jdoc:include type="modules" name="grid7" style="custom" />
                <jdoc:include type="modules" name="grid8" style="custom" /> 
            </div> 
        </div>
    </div>
    <?php endif; ?>

    <?php //Bottom Positions Row
      if (
        $this->countModules('bottom1') || 
        $this->countModules('bottom2') || 
        $this->countModules('bottom3') || 
        $this->countModules('bottom4')
      ) : 
    ?>
    <div id="pageBottom">
        <div class="container">
            <div class="row clearfix">
                <jdoc:include type="modules" name="bottom1" style="custom" />
                <jdoc:include type="modules" name="bottom2" style="custom" />
                <jdoc:include type="modules" name="bottom3" style="custom" />
                <jdoc:include type="modules" name="bottom4" style="custom" />
            </div>  
        </div>
    </div>
    <?php endif; ?>

    <?php //Footer Positions Row
      if (
        $this->countModules('footer1') || 
        $this->countModules('footer2') || 
        $this->countModules('footer3') || 
        $this->countModules('footer4') 
      ) : 
    ?>
    <footer id="pageFooter">
        <div class="container">
            <div class="row clearfix">
                <jdoc:include type="modules" name="footer1" style="custom" />
                <jdoc:include type="modules" name="footer2" style="custom" />
                <jdoc:include type="modules" name="footer3" style="custom" />
                <jdoc:include type="modules" name="footer4" style="custom" />
            </div>
        </div>
    </footer>
    <?php endif; ?>


    <script src="<?php echo $template.'/js/script.js'; ?>"></script>
  </body>
</html>