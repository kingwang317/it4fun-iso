<?php 
//link the controller to the nav link


$route[FUEL_ROUTE.'chapter/lists'] 			    = CHAPTER_FOLDER.'/chapter_manage/lists';
$route[FUEL_ROUTE.'chapter/lists/(:num)'] 		= CHAPTER_FOLDER.'/chapter_manage/lists/$1';
$route[FUEL_ROUTE.'chapter/create'] 			= CHAPTER_FOLDER.'/chapter_manage/create';
$route[FUEL_ROUTE.'chapter/edit/(:num)'] 		= CHAPTER_FOLDER.'/chapter_manage/edit/$1';
$route[FUEL_ROUTE.'chapter/del/(:num)'] 		= CHAPTER_FOLDER.'/chapter_manage/do_del/$1';
$route[FUEL_ROUTE.'chapter/do_create'] 		    = CHAPTER_FOLDER.'/chapter_manage/do_create';
$route[FUEL_ROUTE.'chapter/do_edit/(:num)'] 	= CHAPTER_FOLDER.'/chapter_manage/do_edit/$1';
$route[FUEL_ROUTE.'chapter/do_multi_del'] 		= CHAPTER_FOLDER.'/chapter_manage/do_multi_del'; 
// $route[FUEL_ROUTE.'chapter/get'] 		= CHAPTER_FOLDER.'/chapter_manage/get_chapter';  
 