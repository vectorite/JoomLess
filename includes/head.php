
<?php
/**
 * @version   $Id: index.php 1.0 2011-03-08 19:09:53
 * @package   JoomLess Teplate Pack
 * @copyright Copyright (C) 1998 - 2011 Ideas Net Studio. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$br         = strtolower($_SERVER['HTTP_USER_AGENT']);
$app        = JFactory::getApplication();
$doc        = JFactory::getDocument();
$template   = 'templates/'.$this->template;
$user       = JFactory::getUser();
$menu       = $app->getMenu();
$mainframe  = JFactory::getApplication();

/* Set Expire Header */
header("Content-type: text/html; charset: ISO-8859-1");
header("Cache-Control: must-revalidate");
$offset = 60 * 60 ;
$ExpStr = "Expires: " .
gmdate("D, d M Y H:i:s",
time() + $offset) . " GMT";
header($ExpStr);

/* Disable Mootools and extra JS script if selected at Template Params */
if (($this->params->get('mootools') == 0) && (JRequest::getVar('option') != ('com_finder')) ):
  if($user->get('guest') == 1) :
    $search = array('mootools', 
                    'caption.js', 
                    'core.js', 
                    'jquery-1.7.2.min.js', 
                    'jquery-noconflict.js', 
                    'jquery-more.js',
                    'rendering.js',
                    'cck.css',
                    'intro.css',
                    'finder.css',
                    'content.css'
                    );
    // remove the js files
    foreach($this->_scripts as $key => $script) :
      foreach($search as $findme) :
        if(stristr($key, $findme) !== false) :
          unset($this->_scripts[$key]);
        endif;
      endforeach;
    endforeach;

    //Remove the CSS files
    foreach($this->_styleSheets as $key => $styleSheets) :
      foreach($search as $findme) :
        if(stristr($key, $findme) !== false) :
          unset($this->_styleSheets[$key]);
        endif;
      endforeach;
    endforeach;
  endif;

  //Remove Tootips call
  $doc->_script = preg_replace('%window\.addEvent\(\'domready\',\s*function\(\)\s*{\s*\$\$\(\'.hasTip\'\).each\(function\(el\)\s*{\s*var\s*title\s*=\s*el.get\(\'title\'\);\s*if\s*\(title\)\s*{\s*var\s*parts\s*=\s*title.split\(\'::\',\s*2\);\s*el.store\(\'tip:title\',\s*parts\[0\]\);\s*el.store\(\'tip:text\',\s*parts\[1\]\);\s*}\s*}\);\s*var\s*JTooltips\s*=\s*new\s*Tips\(\$\$\(\'.hasTip\'\),\s*{\s*maxTitleChars:\s*50,\s*fixed:\s*false}\);\s*}\);\s*%', '', $doc->_script);

  //Remove Caption Call
  if (isset($this->_script['text/javascript'])) :
      $this->_script['text/javascript'] = preg_replace('%window\.addEvent\(\'load\',\s*function\(\)\s*{\s*new\s*JCaption\(\'img.caption\'\);\s*}\);\s*%', '', $this->_script['text/javascript']);
      if (empty($this->_script['text/javascript']))
          unset($this->_script['text/javascript']);
  endif;
endif;


$column1  = $this->countModules('column-1');
$column2  = $this->countModules('column-2');

$this->setGenerator($this->params->get('generator'));

// Site icons
$doc->addFavicon($template.'/images/apple-touch-icon-iphone.png','image/png','apple-touch-icon');
$doc->addCustomTag('<link rel="apple-touch-icon" sizes="72x72" href="' . $template . '/images/apple-touch-icon-ipad.png"    />');
$doc->addCustomTag('<link rel="apple-touch-icon" sizes="114x114" href="' . $template . '/images/apple-touch-icon-iphone4.png" />');

$doc->addStyleSheet($template.'/css/template.css','text/css','all');
//$doc->addStyleSheet($template.'/css/bootstrap-responsive.css','text/css','all');

$doc->addScript($template.'/js/script-full.js');
//$doc->addScript($template.'/js/script.js');

// Always force latest IE rendering engine (even in intranet) & Chrome Frame
$doc->setMetaData( 'X-UA-Compatible', 'IE=edge,chrome=1', true );
// Mobile viewport optimized: j.mp/bplateviewport
$doc->setMetaData( 'viewport', 'width=device-width, initial-scale=1.0' );
$doc->setMetaData( 'copyright', $app->getCfg('sitename') );

/* Script to load LESS CSS PHP */
if ($this->params->get('lessphp') == 1):
  require_once( JPATH_THEMES.DS.$this->template.DS.'includes'.DS.'lessc.inc.php' );

  try {
    lessc::ccompile(JPATH_THEMES.DS.$this->template.DS.'less'.DS.'bootstrap.less', JPATH_THEMES.DS.$this->template.DS.'css'.DS.'template.css');
  } catch (exception $ex) {
    exit('bootstrap.less fatal error:<br />'.$ex->getMessage());
  }

endif;

//If IE is detected, it will load ie.php into the head of the template
if(preg_match("/msie/", $br)) :
  require_once( JPATH_THEMES.DS.$this->template.DS.'includes'.DS.'ie.php' );
endif;

/* Code to add Facebook Meta Datas */
$doc->setMetaData( 'og:title', $mainframe->getCfg('sitename') );
$doc->setMetaData( 'og:type', 'blog' );
$doc->setMetaData( 'og:url', JURI::base() );
$doc->setMetaData( 'og:image', JURI::root(true, $template.'/images/apple-touch-icon-ipad.png') );
$doc->setMetaData( 'og:site_name', $mainframe->getCfg('sitename') );
$doc->setMetaData( 'fb:admins', '100001049526800' );

echo '<jdoc:include type="head" />';
?>
