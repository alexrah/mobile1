<?php
defined('_JEXEC') or die;
include_once ('includes/functions.php');
include_once ('includes/includes.php');
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>

  <!--[if IE 8]>
    <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/ie.css" />
  <![endif]-->
  
  <?php
    $doc->addStyleSheet('templates/'.$this->template.'/css/bootstrap.css'); 
    $doc->addStyleSheet('templates/'.$this->template.'/css/default.css');
    $doc->addStyleSheet('templates/'.$this->template.'/css/template.css');
    $doc->addStyleSheet('templates/'.$this->template.'/css/touch.gallery.css');
    $doc->addStyleSheet('templates/'.$this->template.'/css/responsive.css');  
    $doc->addStyleSheet('templates/'.$this->template.'/css/komento.css');  

    if($themeLayout == 1){
      $doc->addStyleSheet('templates/'.$this->template.'/css/layout.css');
    }
  ?>

  <link href='//fonts.googleapis.com/css?family=Open+Sans:400'>
  <link href='//fonts.googleapis.com/css?family=Open+Sans:800'>
  <!--
    font-family: 'Open Sans', sans-serif;
  -->

  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
  <jdoc:include type="head" />
  
</head>

<body class="<?php echo $option . " view-" . $view . " task-" . $task . " itemid-" . $itemid . " body__" . $pageClass;?>">

  <!-- Body -->
  <div id="wrapper">
    <div class="wrapper-inner">

      <div class="headerContent">

        <!-- Top -->
        <?php if ($this->countModules('top')): ?>
          <div id="top-row">
            <div class="rightBg"></div>
            <div class="row-container">
              <div class="<?php echo $containerClass; ?>">
                <div id="top" class="<?php echo $rowClass; ?>">
                  <jdoc:include type="modules" name="top" style="themeHtml5" />
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <!-- Header -->
          <div id="header-row">
            <div class="row-container">
              <div class="<?php echo $containerClass; ?>">
                <header>
                  <div class="<?php echo $rowClass; ?>">
                      <!-- Logo -->
                      <div id="logo" class="span<?php echo $this->params->get('logoBlockWidth'); ?>">
                        <a href="<?php echo $this->baseurl; ?>">
                          <img src="<?php echo $logo;?>" alt="<?php echo $sitename; ?>" />
                        </a>
                      </div>
                      <jdoc:include type="modules" name="header" style="themeHtml5" />
                  </div>
                </header>
              </div>
            </div>
          </div>

        <!-- Navigation -->
        <?php if ($this->countModules('navigation') && $hideByView == false): ?>
          <div id="navigation-row">
            <jdoc:include type="modules" name="navigation" style="html5nosize" />
          </div>
        <?php endif; ?>

      </div>

      <!-- Showcase -->
      <?php if ($this->countModules('showcase') && $hideByView == false): ?>
        <div id="showcase-row">
          <div class="row-container">
            <div class="<?php echo $containerClass; ?>">
              <div class="<?php echo $rowClass; ?>">
                  <jdoc:include type="modules" name="showcase" style="themeHtml5" />
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- Feature -->
      <?php if ($this->countModules('feature') && $hideByView == false): ?>
        <div id="feature-row">
          <div class="row-container">
            <div class="<?php echo $containerClass; ?>">
              <div class="<?php echo $rowClass; ?>">
                  <jdoc:include type="modules" name="feature" style="themeHtml5" />
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>


      <!-- Maintop -->
      <?php if ($this->countModules('maintop') && $hideByView == false && $layout !== 'edit'): ?>
        <div id="maintop-row">
          <div class="row-container">
            <div class="<?php echo $containerClass; ?>">
              <div id="maintop" class="<?php echo $rowClass; ?>">
                <jdoc:include type="modules" name="maintop" style="themeHtml5" />
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- Main Content row -->
      <div id="content-row">
        <div class="row-container">
          <div class="<?php echo $containerClass; ?>">
            <div class="content-inner <?php echo $rowClass; ?>">
          
              <!-- Left sidebar -->
              <?php if ($this->countModules('aside-left') && ($hideByOption) == false && $view !== 'form' && $layout !== 'edit'): ?>
                <div id="aside-left" class="span<?php echo $asideLeftWidth; ?>">
                  <aside>
                    <jdoc:include type="modules" name="aside-left" style="html5nosize" />
                  </aside>
                </div>
              <?php endif; ?>
          
              <div id="component" class="span<?php echo $mainContentWidth; ?>">
                <!-- Breadcrumbs -->
                <?php if ($this->countModules('breadcrumbs')): ?>
                  <div id="breadcrumbs-row">
                    <div id="breadcrumbs">
                      <jdoc:include type="modules" name="breadcrumbs" style="html5nosize" />
                    </div>
                  </div>
                <?php endif; ?>
          
                <!-- Content-top -->
                <?php if ($this->countModules('content-top') && $hideByView == false): ?>
                  <div id="content-top-row" class="<?php echo $rowClass; ?>">
                    <div id="content-top">
                      <jdoc:include type="modules" name="content-top" style="themeHtml5" />
                    </div>
                  </div>
                <?php endif; ?>
          
                  <jdoc:include type="message" />
                  <jdoc:include type="component" />
          
                <!-- Content-bottom -->
                <?php if ($this->countModules('content-bottom') && $hideByView == false): ?>
                  <div id="content-bottom-row" class="<?php echo $rowClass; ?>">
                    <div id="content-bottom">
                      <jdoc:include type="modules" name="content-bottom" style="themeHtml5" />
                    </div>
                  </div>
                <?php endif; ?>
              </div>
          
              <!-- Right sidebar -->
              <?php if ($this->countModules('aside-right') && ($hideByOption) == false && $view !== 'form' && $layout !== 'edit'): ?>
                <div id="aside-right" class="span<?php echo $asideRightWidth; ?>">
                  <aside>
                    <jdoc:include type="modules" name="aside-right" style="html5nosize" />
                  </aside>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Mainbottom -->
      <?php if ($this->countModules('mainbottom') && $hideByView == false): ?>
        <div id="mainbottom-row">
          <div class="row-container">
            <div class="<?php echo $containerClass; ?>">
              <div id="mainbottom" class="<?php echo $rowClass; ?>">
                <jdoc:include type="modules" name="mainbottom" style="themeHtml5" />
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- Bottom -->
      <?php if ($this->countModules('bottom') && $hideByView == false): ?>
        <div id="bottom-row">
          <div class="row-container">
            <div class="<?php echo $containerClass; ?>">
              <div id="bottom" class="<?php echo $rowClass; ?>">
                <jdoc:include type="modules" name="bottom" style="themeHtml5" />
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div id="push"></div>
      
    </div>
  </div>

  <div id="footer-wrapper">
    <div class="footer-wrapper-inner">
      <!-- Footer -->
      <?php if ($this->countModules('footer')): ?>
        <div id="footer-row">
          <div class="row-container">
            <div class="<?php echo $containerClass; ?>">
              <div id="footer" class="<?php echo $rowClass; ?>">
                <jdoc:include type="modules" name="footer" style="themeHtml5" />
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
      
      <!-- Copyright -->
      <?php if ($this->countModules('copyright')): ?>
        <div id="copyright-row">
          <div class="row-container">
            <div class="<?php echo $containerClass; ?>">
              <div id="copyright" class="<?php echo $rowClass; ?>">
                <jdoc:include type="modules" name="copyright" style="themeHtml5" />
                More <a  rel='nofollow' href='http://www.templatemonster.com/category/hotels-joomla-themes/' target='_blank'>Hotels Joomla Themes at TemplateMonster.com</a>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <?php if($this->params->get('totop')): ?>
    <div id="back-top">
      <a href="#"><span></span><?php echo $this->params->get('totop_text') ?></a>
    </div>
  <?php endif; ?>


  <?php if ($this->countModules('modal')): ?>
    <jdoc:include type="modules" name="modal" style="modal" />
  <?php endif; ?>

  <jdoc:include type="modules" name="debug" style="none"/>

  <?php
    $doc->addScript($this->baseurl."/media/jui/js/jquery.min.js");
    $doc->addScript($this->baseurl."/media/jui/js/bootstrap.js");

    $noConflict = "jQuery.noConflict()";
    $doc->addScriptDeclaration($noConflict);

    $doc->addScript($this->baseurl.'/templates/'.$this->template.'/js/jquery.easing.1.3.js');
    $doc->addScript($this->baseurl.'/templates/'.$this->template.'/js/jquery.isotope.min.js');
    $doc->addScript($this->baseurl.'/templates/'.$this->template.'/js/touch.gallery.js');
    $doc->addScript($this->baseurl.'/templates/'.$this->template.'/js/scripts.js');
  ?>

</body>
</html>
