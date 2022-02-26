<?php


namespace Deg540\PHPTestingBoilerplate;


class StringCalculator
{
    public function add(String $number): String
    {
        if ($number == ""){
            return "0";

        } elseif (!str_contains($number, ",")){
            return $number;
        }
    }
}