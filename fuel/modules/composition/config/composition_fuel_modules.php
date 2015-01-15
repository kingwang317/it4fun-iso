<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['composition_manage'] = array(
		'module_name' => '撰寫管理',
		'model_name' => 'composition_manage_model',
		'module_uri' => 'composition/lists',
		'model_location' => 'composition',
		'permission' => 'composition',
		'nav_selected' => 'composition/lists',
		'archivable' => TRUE,
		'instructions' => '新增/修改'
	);
?>