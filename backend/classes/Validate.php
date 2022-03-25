<?php

class Validate
{
    public static function escape($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlentities($input, ENT_QUOTES);
        return $input;
    }

    public static function filterEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}