<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => '127.0.0.1',
	'username' => 'root',
	'password' => '4TWFfAA]4sTi3BKI', 
	//'password' => '',
	'database' => 'db_bki',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['hana'] = array(
	'dsn'	=> '',
	//'hostname' => 'DRIVER={HDBODBC};SERVERNODE=10.100.4.12:30015;DATABASE=BKI_LIVE;UID=B1ADMIN;PWD=Password#01;',
	'hostname' => 'DRIVER={HDBODBC};SERVERNODE=10.100.4.12:30015;DATABASE=SANDBOX2;UID=B1ADMIN;PWD=Password#01;',
	'username' => '',
	'password' => '',
	'database' => '',
	'dbdriver' => 'odbc',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['addon'] = array(
	'dsn'	=> '',
	'hostname' => '206.84.101.229',
	'username' => 'it.support',	
	'password' => 'DW)M8xf70FOdCfN1',
	'port' => '3478',
	'database' => 'bki-addons',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
