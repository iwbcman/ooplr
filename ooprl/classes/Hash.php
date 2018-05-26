<?php
class Hash {
    public static function make($string) {
        return password_hash($string, PASSWORD_ARGON2I);
    }
    public static function unique(){
        return self::make(uniqid());
    }
}