<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config['no_login_pages'] = array(
    "admin/auth/signin",
    "admin/auth/signout",
    "auth/signin",
    "auth/signup",
    "auth/signout"
);

define("PICS_UPLOAD_DIRECTORY", "uploads/");

$config['address_pic'] = array(
    "upload_path" => "./" . PICS_UPLOAD_DIRECTORY,
    "allowed_types" => "gif|jpg|png|jpeg",
    "max_size" => 10000
);

define("ASSETS_VERSION", "1.0.5");
define('DEFAULT_TIMEZONE', 'Europe/Warsaw');
define('DEFAULT_COUNTRY', 'US');

define('GOOGLE_MAP_API_KEY', 'AIzaSyBNpVN9Q_zlQlq0nFV4XrKMrrOoN-GVBko');


