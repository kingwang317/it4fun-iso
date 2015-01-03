<?php
/*
|--------------------------------------------------------------------------
| FUEL NAVIGATION: An array of navigation items for the left menu
|--------------------------------------------------------------------------
*/
$config['nav']['chapter'] = array(
'chapter/lists'		=> '全文列表', 
'sample/lists'		=> '    - 範例',
'parse/lists'		=> '    - 解析'
);

// deterines whether to use this configuration below or the database for controlling the blogs behavior
$config['crawleruse_db_table_settings'] = TRUE;

// the cache folder to hold blog cache files
$config['chapter'] = 'chapter';

$config['tables']['mod_chapter'] = 'mod_chapter';


$config['chapter_javascript'] = array(
    site_url().'assets/admin_js/jquery.js',
    site_url().'assets/admin_js/bootstrap.min.js', 
	site_url().'assets/admin_js/jquery-ui.min.js',
);

$config['chapter_ck_javascript'] = array(
    site_url().'assets/admin_js/ckeditor.js',
    site_url().'assets/admin_js/adapters/jquery.js',  
);

$config['chapter_css'] = array(
	site_url().'assets/admin_css/bootstrap.min.css',
	site_url().'assets/admin_css/style.css',
	site_url().'assets/admin_css/style-responsive.css'
	// site_url().'assets/admin_css/datepicker.css'
);

?>