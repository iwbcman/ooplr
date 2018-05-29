<?php
//background:#1F8DD6; some kind of blue
class Htmlgenerator {
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
