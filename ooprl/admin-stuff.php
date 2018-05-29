<?php
require_once 'core/init.php';
$h = new Htmlgenerator(array('title' => 'Administrator Tools', 'csshref' => 'css/adminstyle.css'));
$user = new User();
if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}
if ($user->hasPermission('admin')) {
    //$h = new Htmlgenerator();
    $t0 = array();
    $t0[] = "Alright, you are logged in as admin so you have a right to be here. ";
    $h($t0);
} else {
    Redirect::to('403');
}
echo Config::get('mysql/host'); // '127.0.0.1'
if (Input::exists()) {
    if(Input::get('cancel')) {
        Redirect::to('index.php');
    }
}
$users = DB::getInstance()->query('SELECT * FROM users');

$t1[] ="<body>";
$t1[] =	"<h1>User Database</h1>";
$t1[] =	"<table class=data-table>";
$t1[] =	"<caption class=title>Registered Users</caption>";
$t1[] =	"<thead>";
$t1[] =	"<tr>";
$t1[] =	"<th>Username</th>";
$t1[] =	"<th>Name</th>";
$t1[] =	"<th>Id</th>";
$t1[] =	"<th>Joined</th>";
$t1[] =	"<th>Group</th>";
$t1[] =	"<th>DELETE</th>";
$t1[] =	"<th>PROMOTE</th>";
$t1[] =	"<th>DEMOTE</th>";
$t1[] =	"</tr>";
$t1[] =	"</thead>";
$t1[] =	"<tbody>";

foreach ($users->results() as $dbuser) {
    $t1[] = "<tr>";
    $t1[] = "<td>{$dbuser->username}</td>";
    $t1[] = "<td>{$dbuser->name}</td>";
    $t1[] = "<td>{$dbuser->id}</td>";
    $t1[] = "<td>{$dbuser->joined}</td>";
    $t1[] = "<td>{$dbuser->groupid}</td>";
    $t1[] = "<td><a href=delete.php?id={$dbuser->id} />Delete</a></td>";
    $t1[] = "<td><a href=promote.php?id={$dbuser->id} />Promote</a></td>";
    $t1[] = "<td><a href=demote.php?id={$dbuser->id} />Demote</a></td>";
    $t1[] ="</tr>";
}

$t1[] = "</tbody>";
$t1[] = "</table>";
$t1[] = "</body>";
$t1[] = "<form action='' method ='post'>";
$t1[] = "<div>";
$t1[] = "<button type='submit' class='button_2' name='cancel' value='cancel' >Exit</button>";
$t1[] = "</div>";
$t1[] = "</form>";
$t1[] = "</html>";

$h($t1);
?>
