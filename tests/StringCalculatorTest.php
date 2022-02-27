<?php

namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\StringCalculator;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    /**
     * @test
     */
    public function should_respond_zero_of_empty_string()
    {
        $string_calculator = new StringCalculator();

        $result = $string_calculator->add("");

        $this->assertEquals("0", $result);
    }

    /**
     * @test
     */
    public function should_respond_same_number_of_single_number_string()
    {
        $string_calculator = new StringCalculator();

        $result = $string_calculator->add("1");

        $this->assertEquals("1", $result);
    }

    /**
     * @test
     */
    public function should_add_two_numbers_of_one_string_separated_by_comma()
    {
        $string_calculator = new StringCalculator();

        $result_sum = $string_calculator->add("2,3");

        $this->assertEquals("5",$result_sum);
    }

    /**
     * @test
     */
    public function should_add_many_whole_numbers_of_one_string_separated_by_comma()
    {
        $string_calculator = new StringCalculator();

        $result_sum = $string_calculator->add("1,2,3,4,5");

        $this->assertEquals("15", $result_sum);
    }

    /**
     * @test
     */
    public function should_add_many_real_numbers_of_one_string_separated_by_comma()
    {
        $string_calculator = new StringCalculator();

        $result_sum = $string_calculator->add("1,2,3,4,5.5");

        $this->assertEquals("15.5", $result_sum);
    }

    /**
     * @test
     */
    public function should_add_many_real_numbers_of_one_string_separated_by_comma_or_line_jump()
    {
        $string_calculator = new StringCalculator();

        $result_sum = $string_calculator->add("1,2,3,4\n5.5");

        $this->assertEquals("15.5", $result_sum);
    }

    /**
     * @test
     */
    public function should_response_error_given_string_of_real_numbers_separated_by_comma_and_line_jump_together()
    {
        $string_calculator = new StringCalculator();

        $result_error = $string_calculator->add("1,2,3,4,\n5.5");

        $this->assertEquals("Number expected but ".'\n'." found at position 8",$result_error);
    }

    /**
     * @test
     */
    public function should_response_error_given_string_of_real_numbers_finished_by_comma()
    {
        $string_calculator = new StringCalculator();

        $result_error = $string_calculator->add("1,2,3,4,5.5,");

        $this->assertEquals("Number expected but NOT found",$result_error);
    }
}
