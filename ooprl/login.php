<?php
require_once 'core/init.php';
//new Token();
if(Input::exists()){
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
                'username' => array(
                        'disp_text' => 'Username',
                        'required' => true),
                'password' => array(
                        'disp_text' => 'Password',
                        'required' => true),
        ));
        
        if($validation->passed()) {
            $user = new User();
            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('username'), Input::get('password'),$remember);

            if ($login) {
                Redirect::to('index.php');
            } else {
                echo '<p>Sorry, logging in failed</p>';
            }
            
        } else {
            $h1 = new Htmlgenerator();
            foreach ($validation->errors() as $error) {
                $t2 = array();
                $t2[] .= "<h3>$error</h3>";
                $h1($t2);
                unset($t2);
            }
        }
    }
}
$h = new Htmlgenerator();
$t = array ('');

$t[] ="<div class='dark'>";
$t[] ="<h1> User Login, please enter your credentials to login.</h1>";
$t[] ="<form action ='' method='post'>";
$t[] ="<div class = 'field' >";
$t[] ="<label class='label' type='username'>Username:</label>";
//$inpname = escape(Input::get('username'));
//$t[] ="<input type='text' name='username' id='username' autocomplete='off' value={$inpname} >";
$t[] ="<input type='text' name='username' id='username' autocomplete='off' >";
$t[] ="</div>";
$t[] ="<div class = 'field' >";
$t[] ="<label class='label' type='password'>Password:</label>";
//$inppass = escape(Input::get('password'));
//$t[] ="<input type='password' name='password' id='password' value={$inppass} autocomplete='off'>";
$t[] ="<input type='password' name='password' id='password' autocomplete='off'>";
$t[] ="</div>";
$t[] ="<div class ='field'>";
$t[] ="<label for='remember'>";
$t[] ="<input type='checkbox' name='remember' id='remember'>Remember me</label>";
$t[] ="</div> ";
$tkn = Token::generate();
$t[] ="<div>";
$t[] ="<input type='hidden' name='token' value={$tkn}> ";
$t[] ="</div>";
$t[] ="<button type='submit' class='button_1'>Log In</button></form>";
$t[] ="</form>";
$t[] ="</div>";

$h($t);