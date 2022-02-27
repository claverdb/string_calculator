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
            if(str_starts_with($number,"//")){ //Case of custom delimiter
                $number = ltrim($number, '/');
                $separated_operations = explode("\n", $number);

                for($i = 0; $i < strlen($separated_operations[1]); $i++){
                    if ($separated_operations[1][$i] != $separated_operations[0] and !is_numeric($separated_operations[1][$i])){
                        return "'$separated_operations[0]' expected but '". $separated_operations[1][$i] ."' found at position $i";

                    }
                }

                $separated_numbers_str = explode($separated_operations[0], $separated_operations[1]);

            } else { //case of line jump or comma delimiter
                $separated_numbers_str = preg_split('/[,|\n]/', $number);

            }

            $aux_before_number = 0;
            for($i = 0; $i < count($separated_numbers_str); $i++){
                $aux_before_number += (double) $separated_numbers_str[$i];

            }

            $number = $aux_before_number;
            return $number;
        }
    }
}