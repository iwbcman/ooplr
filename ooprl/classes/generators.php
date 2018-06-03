<?php
/*class Htmlgenerator {
    public function __invoke($items) {
        foreach($items as $item) {
            echo $item;
        }
    }
    public function __construct($data = null) {
        extract($data);
        echo "<!DOCTYPE html><html><head><meta charset=utf-8><meta action=viewport width=device-width><meta name=description content=Something About This Website><title>$title</title><link rel=stylesheet type=text/css href=$csshref></head><body>";
        
    }
    function __destruct() {
        echo "</body></html>";
    }
}

Htmlgenerator is a super-function, a class used like a function, but which operates on objects instead of simple variables and and arrays
 Currently it uses three magic methods __invoke and __construct and __destruct. In more OOP oriented terms it is a first-class function or a 
 functor. The __invoke method accepts an array of text, loops  through that text and echos that text inside of the html and css code defined 
 between __construct and __destruct. This text can be a) simple text, like a string of words, simply for displaying on a web page,  b) text 
 which contains html and/or css code, allowing one to style and format web page output. HTML and CSS code passed to Htmlgenerator vis-a-vis 
 an array of text does not require any escaping, except in  rare cicumstances where differences between php echo and html text differ(ie. in 
 certain cases, for instance a variable containing a text string, only the first word in a string of words will be displayed without escaping, 
 and in such cases one must resort to escaping, but other than that instance, one can generally avoid all escaping and enclosing of values 
 associated with keys in either single or double quotes, for example in html tags like <input type=text name=textname>NAME:</input>. Which 
 vastly reduces potential sources of syntactical errors and precludes one having to stare at 50 charachters of code for hours trying to figure 
 out exactly which rule require escaping or enclosing is needed to properply render said content or elements to a web page, c) text consisting 
 of variable names to be dynamically resolved when encountered, ie. $text. The __construct magic method contains the begginging html tags, 
 everything up to <body> of a prototypal webpage, ie. a template. The __destruct magic methods contains the closing element tags for those 
 defined in  __construct. Additionally the __construct method accepts an array of key value pairs which currently assign a page title and 
 require a specific css stylesheet for use on the newly dynamically generate webpage. The usage of this functor is straighforward: create two
 arrays, one empty and one containging the title and to-reference css stylesheet(ie. $text = array(); $titlestyle = array('title' => 'Home', 
 'csshref' => 'css/home.css');  )  then create a new instance of Htmlgenerator(ie. $generate = new Htmlgeneraotr($titlestyle); ) and then 
 invoke the new object(ie. $generate($text); ) . To add text to be displayed simply use $text[]= "whatever <strong> $variable </strong> you
 want"; . Of course you can simply create as many $text[] statements as you want, each will be concatenated onto the last and only when done 
 do you invoke the object Htmlgenerator. as a footnote the $title vriable is dynamically created by the extract function called in the _constuct 
 method. Subsequnet invokations of Htmlgenerator can override the stylesheet called in previous invocations but title will remain the same,
 hence thereis no need to pass array for title and css href in following onvocations(the code checks to make sure an array has been passed
 and if no array has been passed the same html is genrated sans setting title and css href. 
 
 
 
 
 
 
 
 