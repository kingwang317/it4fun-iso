<?php
/*
|--------------------------------------------------------------------------
| FUEL NAVIGATION: An array of navigation items for the left menu
|--------------------------------------------------------------------------
*/
// $config['nav']['cpinput'] = array( 
// 'cpinput/lists'		=> 'cpinput'
// );

// deterines whether to use this configuration below or the database for controlling the blogs behavior
$config['crawleruse_db_table_settings'] = TRUE;

// the cache folder to hold blog cache files
$config['cpinput'] = 'cpinput';

$config['tables']['mod_cp_input'] = 'mod_cp_input';


$config['cpinput_javascript'] = array(
    site_url().'assets/admin_js/jquery.js',
    site_url().'assets/admin_js/bootstrap.min.js', 
	site_url().'assets/admin_js/jquery-ui.min.js',
);

$config['cpinput_ck_javascript'] = array(
    site_url().'assets/admin_js/ckeditor/ckeditor.js',
	site_url().'assets/admin_js/ckfinder/ckfinder.js'  
);

$config['cpinput_css'] = array(
	site_url().'assets/admin_css/bootstrap.min.css',
	site_url().'assets/admin_css/style.css',
	site_url().'assets/admin_css/style-responsive.css'
	// site_url().'assets/admin_css/datepicker.css'
);

?>