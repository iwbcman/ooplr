<?php
require_once 'core/init.php';
$user = new User();
if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}
try {
    $update = DB::getInstance()->delete('users', array('id', '=', Input::get('id')));
 
 Session::flash('home', 'User has been deleted.');
 Redirect::to('admin-stuff.php');
 } catch (Exception $e) {
 die($e->getMessage());
 }
 