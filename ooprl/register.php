<?php
require_once 'core/init.php';
$h = new Htmlgenerator(array('title' => 'Register New User', 'csshref' => 'css/style.css'));
//var_dump_pre(Token::check(Input::get('token')));

if(Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
                'name' => array (
                        'disp_text' => 'Your Name(First Last)',
                        'required' => true,
                        'min' => 2,
                        'max' => 50
                ),
                'username' => array (
                        'disp_text'	=> 'Username',
                        'required' => true,
                        'min' => 2,
                        'max' => 20,
                        'unique'=> 'users'
                ),
                'password' => array (
                        'disp_text'	=> 'Password',
                        'required' => true,
                        'min' => 6
                ),
                'reenter-password' => array (
                        'disp_text'	=> 'Reeneter-Password',
                        'required' => true,
                        'matches' => 'password'
                )
        ));

        if($validation->passed()) {
            $user = new User();
            $now = new DateTime(null, new DateTimeZone('America/New_York'));
            $date = $now->format('Y-m-d h:i:s');
            try {
                $user->create(array(
                        'username' => Input::get('username'),
                        'password' => Hash::make(Input::get('password')),
                        'name' => Input::get('name'),
                        'joined' => $date,
                        'groupid' => '1'
                ));
                Session::flash('home', 'You have been registered and can now log in!');
                Redirect::to('index.php');
            } catch (Exception $e) {
                die($e->getMessage());
            }
          
            } else {
            //$h1 = new Htmlgenerator();
            
            foreach ($validation->errors() as $error) {
                    $t2 = array();
                    $t2[] .= "<h3>$error</h3>";
                    $h1($t2);
                    unset($t2);
            }
        }
    }
}

//$h = new Htmlgenerator();
$t = array();
$t[] = "<h1>User Registration</h1>";
$t[] = "<form  action='' method ='post'>";
$t[] = "<div class='dark'>";
$t[] = "<div class='field'>";
$t[] = "<label for='name'>Enter your Name</label>";
//$nm = escape (Input::get('name'));
$t[] = "<input class='text' type='text' name='name' id='name' autocomplete='off' value='' >";
$t[] = "</div>";
$t[] = "<div class='field'>";
$t[] = "<label for='username' >Enter your Username</label>";
//$unm = escape(Input::get('username'));
$t[] = "<input class='text' type='text' name='username' id='username' autocomplete='off' value='' >";
$t[] = "</div>";
$t[] = "<div class='field'>";
$t[] = "<label for='password'>Choose a Password</label>";
$t[] = "<input class='password' type='password' name='password' id='password' value='' autocomplete='off'>";
$t[] = "</div>";
$t[] = "<div class='field'>";
$t[] = "<label for='password_again'>Enter password again</label>";
$t[] = "<input class='password' type='password' name='reenter-password' id='reenter-password' value='' autocomplete='off'>";
$t[] = "</div>";
$t[] = "<div>";
$tkgen = Token::generate();
$t[] = "<input type='hidden' name='token' value={$tkgen}>";
$t[] = "</div>";
$t[] = "<div>";
$t[] = "<button type='submit' class='button_1'>Register</button>";
$t[] = "</div>";
$t[] = "</div>";
$t[] = "</form>";
$h($t);