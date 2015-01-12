<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['cpinput_manage'] = array(
		'module_name' => '撰寫管理',
		'model_name' => 'cpinput_manage_model',
		'module_uri' => 'cpinput/lists',
		'model_location' => 'cpinput',
		'permission' => 'cpinput/manage',
		'nav_selected' => 'cpinput/lists',
		'archivable' => TRUE,
		'instructions' => '新增/修改'
	);
?>