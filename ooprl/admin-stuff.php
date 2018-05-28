<?php
require_once 'core/init.php';
$user = new User();
if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}
if ($user->hasPermission('admin')) {
    $h = new Htmlgenerator();
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
$h = new Htmlgenerator();
$t1[] = "<div class='container-fluid' style='margin-top: 10px'>";
$t1[] = "<div class='table-row header'>";
$t1[] = "<div class='text1'>Username</div>";
$t1[] = "<div class='text1'>Name</div>";
$t1[] = "<div class='text1'>ID</div>";
$t1[] = "<div class='text1'>Joined</div>";
$t1[] = "<div class='text1'>Group #</div>";
$t1[] = "<div class='text1'>Delete</div>";
$t1[] = "<div class='text1'>Promote</div>";
$t1[] = "<div class='text1'>Demote</div>";
$t1[] = "</div>";
foreach ($users->results() as $dbuser) {
    $t1[] = "<div class='table-row'>";
    $t1[] = "<div class='text1'>{$dbuser->username}</div>";
    $t1[] = "<div class='text1'>{$dbuser->name}</div>";
    $t1[] = "<div class='text1'>{$dbuser->id}</div>";
    $t1[] = "<div class='text1'>{$dbuser->joined}</div>";
    $t1[] = "<div class='text1'>{$dbuser->groupid}</div>";
    $t1[] = "<div class='text1'><a href=delete.php?id={$dbuser->id} />Delete</a></div>";
    $t1[] = "<div class='text1'><a href=promote.php?id={$dbuser->id} />Promote</a></div>";
    $t1[] = "<div class='text1'><a href=demote.php?id={$dbuser->id} />Demote</a></div>";
    $t1[] = "</div>";
}
$t1[] = "</div>";
$h($t1);
$t = array ('');
$t1 = array ('');
$t[] = "<form action='' method ='post'>";
$t[] = "<div>";
$t[] = "<button type='submit' class='button_3' name='cancel' value='cancel' >Exit</button>";
$t[] = "</div>";
$t[] = "</form>";
$h($t);

