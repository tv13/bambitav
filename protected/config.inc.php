<?php
/**************************************************************
* Project  : 
* Name     : Main configuration
* Version  : 1.0
* Date     : 2011.05.01
* Modified : $Id$
* Author   : forjest@gmail.com
**************************************************************
* 
* This file will be included in each script in project
* 
* 
*/ 
define('VERSION', trim(strstr('$Revision$', ' '), ' $'));
if (file_exists(dirname(__FILE__).'/config.local.inc.php'))
{
     if (require_once dirname(__FILE__).'/config.local.inc.php')
     {
          return;
     }
}

ini_set('display_errors', false);
ini_set('html_errors', true);
error_reporting(E_ALL);

ob_start();

define('DEV_MODE', false);

date_default_timezone_set('Europe/Kiev');
define('DOMAIN_ROOT', 'bambitax.com');
define('PROJECT_NAME', 'bambitav');
define('SESSION_NAME', PROJECT_NAME . '_rand');
define('AUTH_EXPIRATION_MINUTES', 30);

define('ABS_PATH', rtrim(str_replace('\\', '/',dirname(__FILE__))),  '/');
define('ABS_STATIC_PATH', rtrim(realpath(ABS_PATH.'/../static/'), '/'));

define('SMARTY_DIR', ABS_PATH.'/Lib/Smarty/');
define('LAYERS_DIR', ABS_PATH.'/Layers');
define('HANDLERS_DIR', ABS_PATH.'/handlers');
define('LIB_DIR', ABS_PATH.'/Lib');

define('HTTP_ABS_PATH', 'http://'.DOMAIN_ROOT.'/');
define('HTTP_STATIC_PATH', HTTP_ABS_PATH.'/static');

////////////////////////////////////////////////////////////////////////////

$Config['db_name'] = 'tm';
$Config['db_host'] = 'node30146-bambitaxcom.unicloud.pl';
$Config['db_user'] = 'root';
$Config['db_pass'] = 'AEahaCFeFq';

$Config['db_persistent'] = false;
$Config['db_debug_mode'] = false;

////////////////////////////////////////////////////////////////////////////

define('RECAPTCHA_GOOGLE_SECRET', '6LcuuBsTAAAAAFtBWpbxWPypvlygPkkDAz_8OOEn');

////////////////////////////////////////////////////////////////////////////

define('PER_PAGE_DEFAULT', 10);

////////////////////////////////////////////////////////////////////////////

// i.onthe.io - images
define('IMAGES_SERVER', 'https://i.onthe.io/');
define('IMAGES_APP', 'wjfkb8');
define('IMAGES_SECRET', 'AJHBOyn1LAEDIPax53bO91M6d3oPwSZX');

////////////////////////////////////////////////////////////////////////////

// filter
define('FILTER_AGE_MIN', 18);
define('FILTER_AGE_MAX', 100);

////////////////////////////////////////////////////////////////////////////

// frequency of rise questionnaire (in hours)
define('FREQUENCY_RISE', 24);

?>
