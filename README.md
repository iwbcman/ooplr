# ooplr

This is my take on Alex's tutorial series from codecourse.com.It has been somewhat modified, 
firstly I got tired of messing around with syntax bs going back and forth between php html5 and css
so I borrowed a function from stackoverflow called Htmlgenerator. I have no idea whether such is good 
practice or safe to use but with this function I can simply place all output into an array and then 
dump the array to a web page at will, allowing me to bypass 99% of syntax formatting problems due to 
the differing syntactical requirements and vagaries of html5 vs CSS and both of those vs php. Additionally 
I opted to not use Alex's suggested changepassword.php and merged changing password with updating the use profile. 
I also created a new page, called admin-stuff, where users with sufficient permissions can view all users at 
once in a table and delete, promote or demote indivudual users. My password verification uses password_verify
using the ARGON2I encryption scheme. I have attempted to tighten down all the pages so that users cannot simply
access everything via URL. If someone bothers to look at this code they will be !amazed by my superb HTML and CSS skillz.;)

All in all I found this tutorial series to be amazingly informative if albeit extremely frustrating due to incompatibilites 
arising due to using newest versios of php/mysql(current as of spring 2018). I would love to recieve any constructive feedback
particularly feedback which explains why it is bad to do something this way, or alternate suggestions for how to do
it better. 

This is the Htmlgenerator I used stripped down for simplicity and legibility, please feel free to point out why I shouldn't 
make use of such : <br>
<strong>
    <p>class Htmlgenerator { </p>
<p> public function __invoke($items) { </p>
<p>    foreach($items as $item) { </p>
<p>    echo $item; </p>
<p>    } </p>
<p>}
<p>  function __construct() { </p>
<p>    echo "<html><head><title>Major cool</title><body>"; </p>
<p>  // here you stick whatever css you need for styling </p>
<p>  } </p>
<p>  function __destruct() { </p>
<p>    echo "</body></html>"; </p>
<p>  } </p>
<p> } </p>
    </strong>
<br>
all one has to do to use this is:<br>
<p>$h = new Htmlgenerator();</p>
<p>$t = array();</p>
<p>$t[] = "write someto the page";</p>
<p>$t[] = "<strong> even html tags </strong>";</p>
<p>$t[] = "or more complicated<a href=process.php?id={$userid}>stuff</a>";</p>
<br>
once in a blue moon you might need to use the dreaded \" '" . "' \" bs but extremely rarely. 

I need to get around to properly including a licesne file but for now this code is GPL V2 or later.(that is 
unless someone from codecourse objects).

Karl Zollner
iwbcman\<a\t>gmail.com



