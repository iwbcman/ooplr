<?php
require_once 'core/init.php';
$user = new User();
if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}
if (Input::exists()) {
    if(Input::get('cancel')) {
    Redirect::to('index.php');
    }
    if (Token::check(Input::get('token'))) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
            'name' => array (
                    'disp_text' => 'Your Name(First Last)',
                    'required' => true,
                    'min' => 2,
                    'max' => 50
            ),
            'current-password' => array (
                    'disp_text'	=> 'current password',
                    'required' => true,
                    'min' => 6
                    
            ),
            'new-password' => array (
                    'disp_text'	=> 'new password',
                    'required' => true,
                    'min' => 6
            ),
            'reenter-password' => array (
                    'disp_text'	=> 'reeneter new password',
                    'required' => true,
                    'matches' => 'new-password'
            )
    ));
    if($validation->passed()) {
        $h1 = new Htmlgenerator();
        $t1 = array();
        $user = new User();
      try {
          $user->update(array(
                    'password' => Hash::make(Input::get('new-password')),
                    'name' => Input::get('name')
                    ));
 
            Session::flash('home', 'You have updated your profile.');
            Redirect::to('profile.php');
        } catch (Exception $e) {
            die($e->getMessage());
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
$t = array();
$data = $user->data();
$cnm = $data->name;
$tkgen = Token::generate();
$t[] = "<h1>Update "  . escape($data->username) . '\'s' ." profile</h1>";
$t[] = "<h3>In order to update your profile, enter your new information and </h3>";
$t[] = "<h3>then press the Update button.</h3>";
$t[] = "<h3>Press Cancel Button to exit at any time without making any changes.</h3>";
$t[] = "<form  action='' method ='post'>";
$t[] = "<div class='dark'>";
$t[] = "<div class='field'>";
$t[] = "<label for='name'>Change your Name</label>";
$t[] = "<input class=\"text\" type=\"text\" name=\"name\" id=\"name\" autocomplete=\"off\" value='" . escape($cnm) . "'>";
$t[] = "</div>";
$t[] = "<div class='field'>";
$t[] = "<label for='password'>Enter your current password</label>";
$t[] = "<input class='password' type='password' name='current-password' id='current-password' value='' autocomplete='off'>";
$t[] = "</div>";
$t[] = "<div class='field'>";
$t[] = "<label for='password'>Choose a new password</label>";
$t[] = "<input class='password' type='password' name='new-password' id='new-password' value='' autocomplete='off'>";
$t[] = "</div>";
$t[] = "<div class='field'>";
$t[] = "<label for='password_again'>Enter new password again</label>";
$t[] = "<input class='password' type='password' name='reenter-password' id='reenter-password' value='' autocomplete='off'>";
$t[] = "</div>";
$t[] = "<div>";
$t[] = "<input type='hidden' name='token' value={$tkgen}>";
$t[] = "</div>";
$t[] = "<div>";
$t[] = "<button type='submit' name='submit' value='submit' class='button_1'>Update</button>";
$t[] = "<button type='submit' name='cancel' value='cancel' class='button_2'>Cancel</button>";
$t[] = "</div>";
$t[] = "</div>";
$t[] = "</form>";
$h($t);