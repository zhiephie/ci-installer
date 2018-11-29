<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

# minVersionPhp
$config['minVersionPhp'] = '5.6.0';
# check php ext
$config['phpExt'] = array('openssl', 'pdo', 'mbstring', 'tokenizer', 'JSON', 'cURL', 'LDAP');
# check is_writable files
$config['is_writable'] = array('application/config/database.php', 'application/config/routes.php', 'application/config/config.php', 'application/config/autoload.php', 'backups');
# set default route
$config['defaultRoute'] = 'login';
# set autoload libraries
$config['autoload'] = "array('session', 'form_validation', 'database', 'wahana_auth', 'tree')";
# session drive
$config['sessDrive'] = 'database';
# session save
$config['sessSave'] = 'assets/';
# Path .sql
$config['pathSql'] = './assets/install.sql';
