<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['sample_manage'] = array(
		'module_name' => '範例管理',
		'model_name' => 'sample_manage_model',
		'module_uri' => 'sample/lists',
		'model_location' => 'sample',
		'permission' => 'sample',
		'nav_selected' => 'sample/lists',
		'archivable' => TRUE,
		'instructions' => '新增/修改'
	);
?>