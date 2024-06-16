<?php

namespace Service;

class FormSecurity
{

    public static function htmlSecurity(array $_POST)
    {
        foreach ($_POST as $key => $value) {
            $_POST[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
        return;
    }
}
