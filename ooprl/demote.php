<?php
require_once '../../init.php';
$user = new User();
if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}
try {
    $update = DB::getInstance()->update('users', Input::get('id'), array(
    'groupid' => '1'
        
 ));
 
 Session::flash('home', 'You have been promoted.');
 Redirect::to('admin-stuff.php');
 } catch (Exception $e) {
 die($e->getMessage());
 }
 