<?php
/**
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<!doctype html>
<?php 
//Identify of the visitor's Browser is IE and what version
$br = strtolower($_SERVER['HTTP_USER_AGENT']); // Browser ?
if(preg_match("/msie 6/", $br)) : ?>
<html class="no-js ie6" lang="<?php echo $this->language; ?>">
<?php elseif (preg_match("/msie 7/", $br)): ?>
<html class="no-js ie7" lang="<?php echo $this->language; ?>">
<?php elseif (preg_match("/msie 8/", $br)): ?>
<html class="no-js ie8" lang="<?php echo $this->language; ?>">
<?php elseif (preg_match("/msie 9/", $br)): ?>
<html class="no-js ie9" lang="<?php echo $this->language; ?>">
<?php else: ?>
<html class="no-js" lang="<?php echo $this->language; ?>">
<?php endif; ?>
<head>
  <?php require_once( JPATH_THEMES.DS.$this->template.DS.'includes'.DS.'head.php' ); ?>
</head>
<body id="component" class="contentpane">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>
