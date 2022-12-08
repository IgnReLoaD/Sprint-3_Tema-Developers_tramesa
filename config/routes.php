<?php 

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 */
$routes = array(
	'/test' => 'test#index',
	
	'/listtask' => 'task#index',
	'/addtask'  => 'task#add',
	'/edittask' => 'task#edit',
	'/deltask'  => 'task#del',
	'/viewtask' => 'task#view',
	'/searchtask' => 'task#search',
	'/searchtodeletetask' => 'task#searchtodelete',
	'/viewalltask' => 'task#viewall',
	// rutes per taula USERS
    '/'         => 'user#index',
    '/index'    => 'user#index',
    // '/listuser' => 'user#index',
    '/adduser'  => 'user#add',
    '/edituser' => 'user#edit',   // 'UserController.php?id=3' ... rebrà per GET la ID ... function editAction($_GET[id])
    '/deluser'  => 'user#del'
);
