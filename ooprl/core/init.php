<?php
session_start();
/**
 * 
 * This file is being kept here for historical reasons even though it is now unused.
 * Since we do not wish to have credentials stored in publicly accessible files, 
 * the *actual* init.php file is now located in the root directory, above public/, 
 * rendering it inaccessible to the public via the .htaccess file also located in 
 * the root directory. Given that the *actual* init.sql is not included in this
 * git repository(https://github.com/iwbcman/ooplr.git), If you wish to get this code
 * up and running simply link ooplr/ooplr (notice the double directory structure) to 
 * your publicly accessible directory public/, public_html/, or whichever directory
 * you have configured for public access. Once the link has been created copy 
 * core/init.php to '../../', ie. the root directory of your virtual server and modify 
 * it according to the site specifics(host, username, password etc.) 
 */
$GLOBALS['config'] = $arrayName = array(
        'mysql' => array(
                'host' => '127.0.0.1',
                'username' => 'admin',
                'password' => '',
                'db' => 'lr'
        ),
        'remember' => array (
                'cookie_name' => 'hash',
                'cookie_expiry' => 604800
        ),
        'session' => array (
                'session_name' => 'user',
                'token_name' => 'token'
        )
);
spl_autoload_register(function ($class){
    require_once 'classes/' . $class . '.php';
});
    require_once 'functions/sanitize.php';
    if (Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
        $hash = Cookie::get(Config::get('remember/cookie_name'));
        $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));
        if ($hashCheck->count()) {
            $user = new User($hashCheck->first()->user_id);
            $user->login();
}
    }