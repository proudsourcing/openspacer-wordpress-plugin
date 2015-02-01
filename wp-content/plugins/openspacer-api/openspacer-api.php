<?php
/*
Plugin Name: OpenSpacer API
Plugin URI: http://openspacer.org
Description: Get data from OpenSpacer REST API
Author: Proud Sourcing GmbH
Author URI: http://www.proudsourcing.de
Version: 1.0.0
*/

// including required files
include_once 'OpenSpacerApiSettings.php';
include_once 'OpenSpacerApiShortCode.php';

// register shortcode
add_shortcode('openspacer', array('OpenSpacerApiShortCode', 'openSpacerData') );

//Adding menu in administration
if( is_admin() )
    $ospacerApiSettings = new OpenSpacerApiSettings();
