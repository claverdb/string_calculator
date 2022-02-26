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

        $result = $string_calculator->add("2,3");

        $this->assertEquals("5",$result);
    }

}
