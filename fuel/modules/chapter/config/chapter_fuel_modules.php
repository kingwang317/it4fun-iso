<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['chapter_manage'] = array(
		'module_name' => '章節管理',
		'model_name' => 'chapter_manage_model',
		'module_uri' => 'chapter/lists',
		'model_location' => 'chapter',
		'permission' => 'chapter',
		'nav_selected' => 'chapter/lists',
		'archivable' => TRUE,
		'instructions' => '新增/修改'
	);
?>