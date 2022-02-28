<?php


namespace Deg540\PHPTestingBoilerplate;


class StringCalculator
{
    //Function to return unexpected operations
    //Must control empty string if it doesn't find an unexpected operation
    public function find_unexpected_operation(String $input_number_str, String $expected): String
    {
        $iterator = 0;
        while($iterator < strlen($input_number_str)){
            if ($input_number_str[$iterator] != $expected and !is_numeric($input_number_str[$iterator])){
                return "'$expected' expected but '$input_number_str[$iterator]' found at position $iterator";
            }
            $iterator++;
        }
        return "";
    }

    //Function find unexpected items that should be numbers
    //Must control empty string if it doesn't find an unexpected item
    public function find_unexpected_number(String $input_number_str): String
    {
        $iterator = 1;
        while($iterator < strlen($input_number_str)){
            if (!is_numeric($input_number_str[$iterator]) and !is_numeric($input_number_str[$iterator-1]) and $input_number_str[$iterator-1] != '-' and $input_number_str[$iterator] != '-'){
                if ($input_number_str[$iterator] == "\n") {
                    return "Number expected but '". '\n' ."' found at position $iterator";
                } else {
                    return "Number expected but '". $input_number_str[$iterator] ."' found at position $iterator";
                }
            }
            $iterator++;
        }
        return "";
    }

    public function add(String $input_number_str): String
    {
        $contacted_errors = [];

        if ($input_number_str == ""){
            return "0";

        }
        if (str_ends_with($input_number_str, ',')){
            $contacted_errors[] = "Number expected but NOT found";

        }

        $delimiter = '/[,|\n]/';

        if(str_starts_with($input_number_str,"//")){ //Case of custom delimiter
            $input_number_str = ltrim($input_number_str, '/'); //deletes the '//' of the beginning
            $separated_operations = explode("\n", $input_number_str);

            $delimiter = $separated_operations[0];
            $input_number_str = $separated_operations[1];

            $aux_contacted_error = $this->find_unexpected_operation($input_number_str, $delimiter);
            if ($aux_contacted_error != ""){ //Control empty response
                $contacted_errors[] = $aux_contacted_error;
            }

            $delimiter = '/['.$delimiter.']/'; //given preg_split format

        }

        $separated_numbers_str = preg_split($delimiter, $input_number_str);

        $aux_contacted_error = $this->find_unexpected_number($input_number_str);
        if ($aux_contacted_error != ""){ //Control empty response
            $contacted_errors[] = $aux_contacted_error;
        }

        $aux_before_number = 0;
        $negative_numbers = "";
        //sum numbers
        for($i = 0; $i < count($separated_numbers_str); $i++){
            $aux_before_number += (double) $separated_numbers_str[$i];

            //Find negative numbers
            if ((double)$separated_numbers_str[$i] < 0){
                $negative_numbers .= $separated_numbers_str[$i].", ";
            }
        }

        if($negative_numbers != ""){
            $contacted_errors[] = "Negative not allowed: " . substr($negative_numbers, 0 ,-2);
        }

        $contacted_errors_str = "";
        if(!empty($contacted_errors)){ //Must be some error
            for($i = 0; $i < count($contacted_errors); $i++){
                $contacted_errors_str .= $contacted_errors[$i] . "\n";
            }
            $input_number_str = substr($contacted_errors_str, 0 ,-1);
            return $input_number_str . '.';

        } else {
            $input_number_str = $aux_before_number;
            return $input_number_str;

        }
    }
}