<?php 
//link the controller to the nav link


$route[FUEL_ROUTE.'composition/lists'] 			    = COMPOSITION_FOLDER.'/composition/lists';
$route[FUEL_ROUTE.'composition/lists/(:num)'] 		= COMPOSITION_FOLDER.'/composition/lists/$1';
$route[FUEL_ROUTE.'composition/create'] 			= COMPOSITION_FOLDER.'/composition/create';
$route[FUEL_ROUTE.'composition/edit/(:num)'] 		= COMPOSITION_FOLDER.'/composition/edit/$1';
$route[FUEL_ROUTE.'composition/del/(:num)'] 		= COMPOSITION_FOLDER.'/composition/do_del/$1';
$route[FUEL_ROUTE.'composition/do_create'] 		    = COMPOSITION_FOLDER.'/composition/do_create';
$route[FUEL_ROUTE.'composition/do_edit/(:num)'] 	= COMPOSITION_FOLDER.'/composition/do_edit/$1';
$route[FUEL_ROUTE.'composition/do_multi_del'] 		= COMPOSITION_FOLDER.'/composition/do_multi_del'; 
// $route[FUEL_ROUTE.'composition/get'] 		= COMPOSITION_FOLDER.'/composition/get_chapter';  
 