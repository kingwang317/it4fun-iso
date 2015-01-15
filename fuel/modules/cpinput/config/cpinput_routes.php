<?php 
//link the controller to the nav link


$route[FUEL_ROUTE.'cpinput/lists'] 			    = CPINPUT_FOLDER.'/cpinput_manage/lists';
$route[FUEL_ROUTE.'cpinput/lists/(:num)'] 		= CPINPUT_FOLDER.'/cpinput_manage/lists/$1';
$route[FUEL_ROUTE.'cpinput/create'] 			= CPINPUT_FOLDER.'/cpinput_manage/create';
$route[FUEL_ROUTE.'cpinput/edit/(:num)'] 	    = CPINPUT_FOLDER.'/cpinput_manage/edit/$1';
$route[FUEL_ROUTE.'cpinput/detail/(:num)'] 	    = CPINPUT_FOLDER.'/cpinput_manage/detail/$1';
$route[FUEL_ROUTE.'cpinput/verify/(:num)'] 	    = CPINPUT_FOLDER.'/cpinput_manage/verify/$1';
$route[FUEL_ROUTE.'cpinput/del/(:num)'] 	    = CPINPUT_FOLDER.'/cpinput_manage/do_del/$1';
$route[FUEL_ROUTE.'cpinput/do_create'] 		    = CPINPUT_FOLDER.'/cpinput_manage/do_create';
$route[FUEL_ROUTE.'cpinput/do_edit/(:num)'] 	= CPINPUT_FOLDER.'/cpinput_manage/do_edit/$1';
$route[FUEL_ROUTE.'cpinput/do_verify/(:num)'] 	= CPINPUT_FOLDER.'/cpinput_manage/do_verify/$1';
$route[FUEL_ROUTE.'cpinput/do_multi_del'] 		= CPINPUT_FOLDER.'/cpinput_manageß/do_multi_del';  


 