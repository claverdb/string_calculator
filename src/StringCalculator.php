<?php


namespace Deg540\PHPTestingBoilerplate;


class StringCalculator
{
    //Function to return unexpected operations errors
    //Must be controlled empty string if it doesn't find an unexpected operation
    private function find_unexpected_operation(String $input_number_str, String $expected): String
    {
        for($iterator = 0; $iterator < strlen($input_number_str); $iterator++){
            if ($input_number_str[$iterator] != $expected and !is_numeric($input_number_str[$iterator])){
                if ($input_number_str[$iterator] == "\n") {
                    return "'$expected' expected but '". '\n' ."' found at position $iterator";
                } else {
                    return "'$expected' expected but '$input_number_str[$iterator]' found at position $iterator";
                }

            }
        }
        return "";
    }

    //Function find unexpected items that should be numbers and returns the error
    //Must be controlled empty string if it doesn't find an unexpected item
    private function find_unexpected_number(String $input_number_str): String
    {
        for($iterator = 1; $iterator < strlen($input_number_str); $iterator++){
            if (!is_numeric($input_number_str[$iterator]) and !is_numeric($input_number_str[$iterator-1]) and $input_number_str[$iterator-1] != '-' and $input_number_str[$iterator] != '-'){
                if ($input_number_str[$iterator] == "\n") {
                    return "Number expected but '". '\n' ."' found at position $iterator";
                } else {
                    return "Number expected but '". $input_number_str[$iterator] ."' found at position $iterator";
                }
            }
        }
        return "";
    }

    //Function checks all the errors that are given in the array and concatenates them into the string
    //Returns ok if there aren't errors
    public function check_errors(Array $errors_list): String
    {
        $concatenated_errors_str = "";
        if(!empty($errors_list)){ //Must be some error
            for($i = 0; $i < count($errors_list); $i++){
                $concatenated_errors_str .= $errors_list[$i] . "\n";
            }
            $concatenated_errors_str = substr($concatenated_errors_str, 0 ,-1);
            return $concatenated_errors_str . '.';

        } else {
            return "ok";

        }
    }

    public function add(String $input_number_str): String
    {
        $errors_list = [];

        if ($input_number_str == ""){
            return "0";

        }

        $delimiter = '/[,|\n]/';

        if(str_starts_with($input_number_str,"//")){ //Case of custom delimiter
            $input_number_str = ltrim($input_number_str, '/'); //deletes the '//' of the beginning
            $separated_operations = explode("\n", $input_number_str, 2); //divides in two pieces

            $delimiter = $separated_operations[0];
            $input_number_str = $separated_operations[1];

            $aux_concatenated_error = $this->find_unexpected_operation($input_number_str, $delimiter);
            if ($aux_concatenated_error != ""){ //Control empty response
                $errors_list[] = $aux_concatenated_error;
            }

            $delimiter = '/['.$delimiter.']/'; //given preg_split format

        }

        $separated_numbers_str = preg_split($delimiter, $input_number_str);

        if (in_array("", $separated_numbers_str)){ //Must be two delimiters together or one at the end
            $aux_concatenated_error = $this->find_unexpected_number($input_number_str);
            if ($aux_concatenated_error != ""){ //Control empty response
                $errors_list[] = $aux_concatenated_error;
            } else { //must be the last position
                $errors_list[] = "Number expected but NOT found";
            }
        }

        $sum_number = 0;
        $negative_numbers = "";
        //sum numbers
        for($i = 0; $i < count($separated_numbers_str); $i++){
            $sum_number += (double) $separated_numbers_str[$i];

            //Find negative numbers
            if ((double)$separated_numbers_str[$i] < 0){
                $negative_numbers .= $separated_numbers_str[$i].", ";
            }
        }

        if($negative_numbers != ""){
            $errors_list[] = "Negative not allowed: " . substr($negative_numbers, 0 ,-2); //deletes the last ', '
        }

        $returned_error = $this->check_errors($errors_list);
        if ($this->check_errors($errors_list) == "ok"){
            return $sum_number;

        } else {
            return $returned_error;

        }
    }
}