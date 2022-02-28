<?php

namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\StringCalculator;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase //Read README.md before execute
{
    private StringCalculator $string_calculator;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->string_calculator = new StringCalculator();
    }

    /**
     * @test
     */
    public function should_respond_zero_of_empty_string()
    {
        $result = $this->string_calculator->add("");

        $this->assertEquals("0", $result);
    }

    /**
     * @test
     */
    public function should_respond_same_number_of_single_number_string()
    {
        $result = $this->string_calculator->add("1");

        $this->assertEquals("1", $result);
    }

    /**
     * @test
     */
    public function should_add_two_numbers_of_one_string_separated_by_comma()
    {
        $result_sum = $this->string_calculator->add("2,3");

        $this->assertEquals("5",$result_sum);
    }

    /**
     * @test
     */
    public function should_add_many_whole_numbers_of_one_string_separated_by_comma()
    {
        $result_sum = $this->string_calculator->add("1,2,3,4,5");

        $this->assertEquals("15", $result_sum);
    }

    /**
     * @test
     */
    public function should_add_many_real_numbers_of_one_string_separated_by_comma()
    {
        $result_sum = $this->string_calculator->add("1,2,3,4,5.5");

        $this->assertEquals("15.5", $result_sum);
    }

    /**
     * @test
     */
    public function should_add_many_real_numbers_of_one_string_separated_by_comma_or_line_jump()
    {
        $result_sum = $this->string_calculator->add("1,2,3,4\n5.5");

        $this->assertEquals("15.5", $result_sum);
    }

    /**
     * @test
     */
    public function should_response_error_given_string_of_real_numbers_separated_by_comma_and_line_jump_together()
    {
        $result_error = $this->string_calculator->add("1,2,3,4,\n5.5");

        $this->assertEquals("Number expected but '".'\n'."' found at position 8.",$result_error);
    }

    /**
     * @test
     */
    public function should_response_error_given_string_of_real_numbers_finished_by_comma()
    {
        $result_error = $this->string_calculator->add("1,2,3,4,5.5,");

        $this->assertEquals("Number expected but NOT found.",$result_error);
    }

    /**
     * @test
     */
    public function should_add_two_real_numbers_of_one_string_separated_by_given_delimiter()
    {
        $result_sum = $this->string_calculator->add("//;\n1;2");

        $this->assertEquals("3",$result_sum);
    }

    /**
     * @test
     */
    public function should_add_many_real_numbers_of_one_string_separated_by_given_delimiter()
    {
        $result_sum = $this->string_calculator->add("//|\n1|2|3");

        $this->assertEquals("6",$result_sum);
    }

    /**
     * @test
     */
    public function should_response_error_given_string_with_delimiter_and_used_different_delimiter()
    {

        $result_error = $this->string_calculator->add("//|\n1|2,3");

        $this->assertEquals("'|' expected but ',' found at position 3.", $result_error);
    }

    /**
     * @test
     */
    public function should_response_error_given_string_with_one_negative_number()
    {
        $result_error = $this->string_calculator->add("-1,2");

        $this->assertEquals("Negative not allowed: -1.", $result_error);
    }

    /**
     * @test
     */
    public function should_response_error_given_string_with_negative_numbers()
    {
        $result_error = $this->string_calculator->add("2,-4,-5");

        $this->assertEquals("Negative not allowed: -4, -5.", $result_error);
    }

    /**
     * @test
     */
    public function should_response_multiple_errors_given_string_with_multiple_different_errors()
    {
        $result_multiple_errors = $this->string_calculator->add("-1,,2");

        $this->assertEquals("Number expected but ',' found at position 3\nNegative not allowed: -1.", $result_multiple_errors);
    }
}
