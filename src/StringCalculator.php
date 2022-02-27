<?php


namespace Deg540\PHPTestingBoilerplate;


class StringCalculator
{
    public function add(String $number): String
    {
        if ($number == ""){
            return "0";

        } elseif (str_ends_with($number, ',')){
            return "Number expected but NOT found";

        } elseif (str_contains($number, ",\n") || str_contains($number, "\n,")) {
            if($pos = strpos($number, ",\n")){
                $pos++;
                return "Number expected but ".'\n'." found at position $pos";

            } elseif ($pos = strpos($number, "\n,")) {
                $pos++;
                return "Number expected but ".','." found at position $pos";

            } else{
                return "Not found";

            }
        } else {
            if(str_starts_with($number,"//")){
                $number = ltrim($number, '/');
                $separated_operations = explode("\n", $number);
                $separated_numbers_str = explode($separated_operations[0], $separated_operations[1]);

            } else {
                $separated_numbers_str = preg_split('/[,|\n]/', $number);

            }
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