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
            $separated_numbers_str = preg_split('/[,|\n]/', $number);

            $number_of_separated_numbers = count($separated_numbers_str);

            $aux_before_number = 0;
            for($i = 0; $i < $number_of_separated_numbers; $i++){
                $aux_before_number += (double) $separated_numbers_str[$i];
            }

            $number = $aux_before_number;
            return $number;
        }
    }
}