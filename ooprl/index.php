<?php
require_once '../../init.php';
$h = new Htmlgenerator(array('title' => 'Home', 'csshref' => 'css/style.css'));
if (Session::exists('home')) {
    echo '<p>' . Session::flash('home') . '</p>' ;
    echo Session::flash('success');
}

$user = new User();
//$h = new Htmlgenerator();
$t = array();
if($user->isLoggedIn()) {
    //echo $user->data()->username;
    $t[] =	"<p>Hello <a href=profile.php?user=" . escape($user->data()->username) . ">" . escape($user->data()->username) . "</a></p>";
    $t[] =	"<ul>";
    $t[] =		"<li><a href='logout.php'>Log out</a></li>";
    $t[] =		"<li><a href='update.php'>Update Profile</a></li>";
    $t[] =	"</ul>";
    if ($user->hasPermission('admin')) {
        $t[] = "<p>You are logged in under an Administrator account</p>";
        $t[] = "<p>As An Administrator you may access the <a href=admin-stuff.php>admin page</a> to make changes to the database.";
    } else {
        $t[] = "<p>You are logged in under a standard user account</p>";
    }
} else {
	$t[] = "<p>You need to <a href='login.php'>log in</a> or <a href='register.php'>register</a><p>";

}
$h($t);