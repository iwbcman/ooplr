<?php
require_once 'core/init.php';
$h = new Htmlgenerator(array('title' => 'User Profile', 'csshref' => 'css/style.css'));
$whoami = new User;
if(!$whoami->isLoggedIn()) {
    Redirect::to(403);
}
//var_dump_pre($whoami);
$whoamidata = $whoami->data();
if ($whoamidata->username != Input::get('user')) {
    Redirect::to(406);
}
if (!$username = Input::get('user')) {
    Redirect::to('index.php');
} else {
    $user = new User($username);
    $data = $user->data();
        if(!$user->exists()) {
        Redirect::to(404);
    } else {
        //$h = new Htmlgenerator();
        $t = array();
        $t[] = "<h1>" . escape($data->username) . '\'s' . " profile: </h1>";
        $t[] = "<h2>User ID:       " . escape($data->id) ."</h2>";
        $t[] = "<h2>Full Name:     " . escape($data->name) ."</h2>";
        $t[] = "<h2>Username:      " . escape($data->username) ."</h2>";
        $t[] = "<h2>Joined:        " . escape($data->joined) . "</h2>";
        $t[] = "<br /><br /><br />";
        $t[] =	"<p>Return <a href=index.php>Home</a></p>";
        $h($t);
    }
}
