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
    Redirect::to('405');
}
echo Config::get('mysql/host'); // '127.0.0.1'
if (Input::exists()) {
    if(Input::get('cancel')) {
        Redirect::to('index.php');
    }
}
//$now = new DateTime(null, new DateTimeZone('America/New_York'));
//$date = $now->format('Y-m-d h:i:s');
//$users = DB::getInstance()->insert('users', array(
//        'username' => 'mtdman',
//        'password' => password_hash('mtdman1',PASSWORD_ARGON2I),
//        'name' => 'Karl Zollner',
//        'joined' => $date,
//        'groups' => 1,
//)) ;
//$now = new DateTime(null, new DateTimeZone('America/New_York'));
//$date = $now->format('Y-m-d h:i:s');
//$users = DB::getInstance()->update('users', WHATS MY ID ,array(
//        'username' => 'mtdman',
//        'password' => password_hash('mtdman1',PASSWORD_ARGON2I),
//        'name' => 'Karl Zollner',
//        'joined' => $date,
//        'groups' => 1,
//)) ;
//var_dump_pre($users);
$users = DB::getInstance()->query('SELECT * FROM users');
//var_dump_pre($users);
//$id = $users->id;
//$name = $users->username;
//if (!$users->count()) {
//    echo 'No User';
//} else {
//    foreach ($users->results() as $user) {
//        echo $user->username . ' ' . $user->id, '<br/>';
//    }
//}
//unset($id, $name);

//echo $id, $name;
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
//$t[] ="<form action ='' method='post'>";
//$t[] = "<select name='id'>";
//$t[] = "<label for=Select><select name=chosen>";
//$options = '';
/*if (!$users->count()) {
    $t[] = 'No User';
} else {
    
    foreach ($users->results() as $user) {
        $id = $user->id;
        $name = $user->username;
        $options .="<option value=\"$id\">".$id . '   ' . $name;
        //$t[] = "<option value={$user->id}>Name: {$user->username}   ID: {$user->id} </option>";
    }
//    $t[] = "</select>";
}
 
$t[] = "<option>";
$t[] = $options;
$t[] = "</option>";
$t[] = "</select>";
$t[] = "<input type=submit name=Submit value=Submit >";
$t[] = "</form>";
if (isset($_POST['Submit'])) {
    //var_dump_pre($_POST['chosen']);
    $chosen = $_POST['chosen'];
    $t[] = "<br /><br />";
    $t[] = "You Chose ID:" . $chosen;


//$t[] ="<form action ='' method='post'>";
//$t[] ="<div class ='field'>";
//$t[] ="<label for='delete'>";
//$t[] ="<input type='checkbox' name='delete' id='delete'>Delete user</label>";
//$t[] ="</div> ";
$t[] ="<b><a href=admin-stuff.php?del=$chosen  ><input type=submit name=delete value=Delete class=button_3 /><a/><b>";

//$t[] = "</form>";
//$delete = Input::get('delete');
//$todelete = $chosen;
//$t[] =  "this should return value of" . Input::get('del');
$todelete = Input::get('del');
if ($chosen === $todelete) {
    $t[] = "Howdy<br>";
    $t[] = "todelete is reading : " . $todelete;
    //$todelete = $chosen;
    $t[] = "todelete is now reading : " . $todelete;
    $t[] = "chosen is now reading : " . $chosen;
    try {
        $t[] ="before";
        $userdelete = DB::getInstance()->get('users', array('id', '=', $chosen));
        $t[] ="after";
    } catch (Exception $e) {
        $t[] = "Something went wrong?";
        die($e->getMessage());
    }
}
}
//$userdelete = DB::getInstance()->get('users', array('id', '=', $chosen));
//$userpromote = DB::getInstance()->get('users', $chosen, array('groupid', '=', '2'));
$t[] ="<div class ='field'>";
$t[] ="<label for='promote'>";
$t[] ="<input type='checkbox' name='promote' id='promote'>Promote user</label>";
$t[] ="</div> ";
$promote = (Input::get('promote') === 'on') ? true : false;
/*try {
    $user->update(array(
            'groupid' => '2'
    ));
    
    Session::flash('home', 'You have been promoted.');
    Redirect::to('index.php');
} catch (Exception $e) {
    die($e->getMessage());
}

//$userdemote = DB::getInstance()->get('users', $chosen, array('groupid', '=', '1'));
$t[] ="<div class ='field'>";
$t[] ="<label for='demote'>";
$t[] ="<input type='checkbox' name='demote' id='demote'>Demote user</label>";
$t[] ="</div> ";
$demote = (Input::get('demote') === 'on') ? true : false;
/*try {
    $user->update(array(
            'groupid' => '1'
    ));
    
    Session::flash('home', 'You have been demoted.');
    Redirect::to('index.php');
} catch (Exception $e) {
    die($e->getMessage());
}

//var_dump_pre($chosen);


//$pid = $_POST['id'];
//$dbid = DB::getInstance()->get('users', array('id', '=', "$pid"));
$now = new DateTime(null, new DateTimeZone('America/New_York'));
$date = $now->format('Y-m-d h:i:s');
//$users = DB::getInstance()->update('users', $pid ,array(
//        'username' => 'mtdman',
//        'password' => password_hash('mtdman1',PASSWORD_ARGON2I),
//        'name' => 'Karl Zollner',
//        'joined' => $date,
//        'groups' => 1,
//)) ;
*/
$t[] = "<form action='' method ='post'>";
$t[] = "<div>";
$t[] = "<button type='submit' class='button_3' name='cancel' value='cancel' >Exit</button>";
$t[] = "</div>";
$t[] = "</form>";
$h($t);

