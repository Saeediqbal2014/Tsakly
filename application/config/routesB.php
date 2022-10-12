<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//calendar
$route['events_calendar'] = 'fullcalendar/index';
$route['tasks_calendar'] = 'fullcalendar/task_calendar';
$route['subtasks_calendar'] = 'fullcalendar/subtask_calendar';