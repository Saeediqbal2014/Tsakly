<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//calendar
$route['events_calendar']       =   'fullcalendar/index';
$route['tasks_calendar']        =   'fullcalendar/task_calendar';
$route['subtasks_calendar']     =   'fullcalendar/subtask_calendar';

//POS Routes

// Category
$route['pos/categories']            =   'pos/allCategories';
$route['pos/add-category']          =   'pos/addCategory';
$route['pos/store-category']        =   'pos/storeCategory';
$route['pos/edit-category/(:any)']  =   'pos/editCategory/$1';
$route['pos/delete-category']       =   'pos/deleteCategory';
// Category End

//Product
$route['pos/products']              =   'pos/allProducts';
$route['pos/add-products']          =   'pos/addProducts';
$route['pos/store-product']         =   'pos/storeProduct';
$route['pos/edit-product/(:any)']   =   'pos/editProduct/$1';
$route['pos/delete-product']        =   'pos/deleteProduct';
//Product End

//Purchase & Sell
$route['pos/purchase']              =   'pos/purchaseItem';
$route['pos/buy-item']              =   'pos/buyItem';
$route['pos/total-sell']            =   'pos/totalSell';
$route['pos/my-purchase']           =   'pos/myPurchase';


//POS Routes End