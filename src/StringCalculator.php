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

        } else {
            $separated_numbers_str = explode(",", $number);
            $number_to_sum1 = (int) $separated_numbers_str[0];
            $number_to_sum2 = (int) $separated_numbers_str[1];
            $number = strval($number_to_sum1+$number_to_sum2);
            return $number;
        }
    }
}