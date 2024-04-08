<?php
    function noSpecials($input, $maxLength) {
        if ($input === null) {
            return false;
        }
        if (strlen($input) > $maxLength) {
            return false;
        }
        $specialCharsRegex = '/[!@#$%^&*()_+\-=\[\]{};\'":\\\\|,.<>\/?]/';
        if (preg_match($specialCharsRegex, $input)) {
            return false;
        }
        return true;
    }
    function numberOnly($input, $maxLength) {
        if($input === null) {
            return false;
        }
        if(strlen($input) > $maxLength) {
            return false;
        }
        return preg_match('/^[0-9]+$/', $input);
    }
    function isValidDate($input) {
        return preg_match('/^(0[1-9]|1[0-2])\/[0-9]{2}$/', $input);
    }