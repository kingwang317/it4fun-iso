<?php 
//link the controller to the nav link


$route[FUEL_ROUTE.'sample/lists'] 			    = SAMPLE_FOLDER.'/sample_manage/lists';
$route[FUEL_ROUTE.'sample/lists/(:num)'] 		= SAMPLE_FOLDER.'/sample_manage/lists/$1';
$route[FUEL_ROUTE.'sample/create'] 			    = SAMPLE_FOLDER.'/sample_manage/create';
$route[FUEL_ROUTE.'sample/edit/(:num)'] 		= SAMPLE_FOLDER.'/sample_manage/edit/$1';
$route[FUEL_ROUTE.'sample/del/(:num)'] 		    = SAMPLE_FOLDER.'/sample_manage/do_del/$1';
$route[FUEL_ROUTE.'sample/do_create'] 		    = SAMPLE_FOLDER.'/sample_manage/do_create';
$route[FUEL_ROUTE.'sample/do_edit/(:num)'] 	    = SAMPLE_FOLDER.'/sample_manage/do_edit/$1';
$route[FUEL_ROUTE.'sample/do_multi_del'] 		= SAMPLE_FOLDER.'/sample_manage/do_multi_del'; 

 