<?php
class Redirect {
    public static function to($location = null ) {
        if($location) {
            if (is_numeric($location)) {
                switch($location) {
                    case 404:
                        header('HTTP/1.0 404 Not found');
                        include 'includes/errors/404.php';
                        exit();
                        break;
                
                    case 403:
                      header('HTTP/1.0 403 Access Forbidden');
                       include 'includes/errors/403.php';
                       exit();
                       break;
                    
                    case 406:
                        header('HTTP/1.0 403 Not found');
                        include 'includes/errors/406.php';
                        exit();
                        break;
                }
            }
            header('Location: ' . $location);
            exit();
        }
    }
}