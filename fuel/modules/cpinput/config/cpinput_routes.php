<?php 
//link the controller to the nav link


$route[FUEL_ROUTE.'cpinput/lists'] 			    = CPINPUT_FOLDER.'/cpinput_manage_model/lists';
$route[FUEL_ROUTE.'cpinput/lists/(:num)'] 		= CPINPUT_FOLDER.'/cpinput_manage_model/lists/$1';
$route[FUEL_ROUTE.'cpinput/create'] 			= CPINPUT_FOLDER.'/cpinput_manage_model/create';
$route[FUEL_ROUTE.'cpinput/edit/(:num)'] 	    = CPINPUT_FOLDER.'/cpinput_manage_model/edit/$1';
$route[FUEL_ROUTE.'cpinput/del/(:num)'] 	    = CPINPUT_FOLDER.'/cpinput_manage_model/do_del/$1';
$route[FUEL_ROUTE.'cpinput/do_create'] 		    = CPINPUT_FOLDER.'/cpinput_manage_model/do_create';
$route[FUEL_ROUTE.'cpinput/do_edit/(:num)'] 	= CPINPUT_FOLDER.'/cpinput_manage_model/do_edit/$1';
$route[FUEL_ROUTE.'cpinput/do_multi_del'] 		= CPINPUT_FOLDER.'/cpinput_manage_model/do_multi_del';  


 