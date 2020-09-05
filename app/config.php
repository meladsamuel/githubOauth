<?php
// SITE NAME
defined('WEB_SITE_NAME') ? null : define('WEB_SITE_NAME', '');

// DIRECTORY SEPARATOR FOR SERVER AND BROWSER
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);// the [ / ] sambol
// PROJECT FOLDERS PATH
defined('APP_PATH') ? null : define('APP_PATH', realpath(dirname(__FILE__))); //app folder path
defined('VIEWS_PATH') ? null : define('VIEWS_PATH', APP_PATH . DS . 'view' . DS);//view folder path
defined('TEMPLATE_PATH') ? null : define('TEMPLATE_PATH', APP_PATH . DS . 'template' . DS);// template folder path
defined('ROUTER_PATH') ? null : define('ROUTER_PATH', APP_PATH . DS . 'routes' . DS);// template folder path
defined('VENDOR_PATH') ? null : define('VENDOR_PATH', APP_PATH . DS . '..' . DS . 'vendor' . DS);// template folder path


defined('OAUTH_CLIENT_ID') ? null : define('OAUTH_CLIENT_ID', 'b143db07d59510b2de71');// auth client id
defined('OAUTH_CLIENT_SECRET') ? null : define('OAUTH_CLIENT_SECRET', 'bf0160b41d055f2b60e2973c0346edce01386ee0');// auth client secret


// WEBSITE ROUTE
defined('JS') ? null : define('JS', WEB_SITE_NAME . '/js/');//javascript folder path
defined('CSS') ? null : define('CSS', WEB_SITE_NAME . '/css/');//css folder path

// CONNECTION CONSTANT
defined('DATABASE_HOST_NAME') ? null : define('DATABASE_HOST_NAME', 'mysql-mevqc3xeyr6xa.mysql.database.azure.com');
defined('DATABASE_DB_NAME') ? null : define('DATABASE_DB_NAME', 'Oauth');
defined('DATABASE_USER_NAME') ? null : define('DATABASE_USER_NAME', 'melad@mysql-mevqc3xeyr6xa');
defined('DATABASE_PASSWORD') ? null : define('DATABASE_PASSWORD', '7RAprBQqD:W_"b^ce}s!');
// SESSION HANDLER
defined('SESSION_PATH') ? null : define('SESSION_PATH', APP_PATH . DS . '..' . DS . 'sessions' . DS);
// APP SALT
defined('APP_SALT') ? null : define('APP_SALT', '$2a$07$4frtkmwo83fzy3gdywsty0$');
// LANGUAGE COOKIE

// UPLOAD STORAGE HANDLER
defined('UPLOAD_PATH') ? null : define('UPLOAD_PATH', APP_PATH . DS . '..' . DS . 'upload');
defined('IMAGES_UPLOAD_PATH') ? null : define('IMAGES_UPLOAD_PATH', UPLOAD_PATH . DS . 'image' . DS);
defined('DOCUMENTS_UPLOAD_PATH') ? null : define('DOCUMENTS_UPLOAD_PATH', UPLOAD_PATH . DS . 'documents' . DS);
defined('MAX_FILE_SIZE_ALLOWED') ? null : define('MAX_FILE_SIZE_ALLOWED', ini_get('upload_max_filesize'));

