<?php
/*
Plugin Name: OpenSpacer API
Plugin URI: http://openspacer.org
Description: Get data from OpenSpacer REST API
Author: Proud Sourcing GmbH
Author URI: http://www.proudsourcing.de
Version: 2.1.0
*/

// including required files
include_once 'OpenSpacerApiSettings.php';
include_once 'OpenSpacerApiShortCode.php';
include_once 'OpenSpacerApiOptions.php';
include_once 'OpenSpacerApiUrlGenerator.php';
include_once 'OpenSpacerApiCacheEngine.php';
include_once 'OpenSpacerApiEventOutputGenerator.php';
include_once 'OpenSpacerApiSessionOutputGenerator.php';

// register shortcode
add_shortcode('openspacer', array('OpenSpacerApiShortCode', 'openSpacerData') );

//Adding menu in administration
if( is_admin() )
    $ospacerApiSettings = new OpenSpacerApiSettings();
