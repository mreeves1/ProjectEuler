<?php
/**
 * Project Euler - Problem 17
 *
 * Number letter counts
 *
 * If the numbers 1 to 5 are written out in words: one, two, three, four, five, then there are 3 + 3 + 5 + 4 + 4 = 19 letters used in total.
 * If all the numbers from 1 to 1000 (one thousand) inclusive were written out in words, how many letters would be used? 
 * NOTE: Do not count spaces or hyphens. For example, 342 (three hundred and forty-two) contains 23 letters and 115 (one hundred and fifteen) contains 20 letters. 
 * The use of "and" when writing out numbers is in compliance with British usage. 
 *
 * @category ProjectEuler
 * @package Problem17
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=17
 *
 */
class Problem17 extends Problem_Abstract
{

    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow make this larger.
     * $const int PROBLEM_TIMEOUT Used with set_timeout_limit to throw a timeout if problem computation takes too long.
     */
    const PROBLEM_TIMEOUT_OVERRIDE = 60;

    /**
     * Description of input
     * @const string INPUT
     */
    const INPUT = 5; // Test value, should return 19
    // const INPUT = 1000;
  
    private $_valueWordMap = array(
                          1 => "one",
                          2 => "two",
                          3 => "three",
                          4 => "four",
                          5 => "five",
                          6 => "six",
                          7 => "seven",
                          8 => "eight",
                          9 => "nine",
                          10 => "ten",
                          11 => "eleven",
                          12 => "twelve",
                          13 => "thirteen",
                          14 => "fourteen",
                          15 => "fifteen",
                          16 => "sixteen",
                          17 => "seventeen",
                          18 => "eighteen",
                          19 => "nineteen",
                          20 => "twenty",
                          30 => "thirty",
                          40 => "forty",
                          50 => "fifty",
                          60 => "sixty",
                          70 => "seventy",
                          80 => "eigthy",
                          90 => "ninety",
                          100 => "hundred",
                          1000 => "thousand",
                    );

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 
        set_time_limit(self::PROBLEM_TIMEOUT_OVERRIDE);
        if (!extension_loaded('bcmath')) {
            // Placeholder for any extensions required for this problem's code
            // die('BCMath extension required. See http://www.php.net/manual/en/book.bc.php .');
        }
    }

    /**
     * Wrapper method to output our answer with the appropriate input variables
     *
     * @return int
     */
    public function execute()
    {
        return $this->findNumberLetterCountSum(self::INPUT);
    }

    /**
     * Find Number Letter Count Sum from 1 to $upperBound.
     *
     * @param string $upperBound largest number we sum to
     *
     * @return int Total count of all letters of all words of all numbers summed
     */
    private function findNumberLetterCountSum($upperBound)
    {
        $sum = 0;
        for($i = 1; $i <= $upperBound; $i++) {
            $sum += $this->findNumberLetterCount($i);
        }
        return $sum;
    }

    private function findNumberLetterCount($number)
    {
        $letterCount = 0;
        if (isset($this->_valueWordMap[$number])) {
            $letterCount += $this->stripCount($this->_valueWordMap[$number]);
        }
        return $letterCount;
    }

    private function stripCount($input)
    {
        $find = array(" ", "-");
        $replace = "";
        $stripped = str_replace($find, $replace, $input);
        return strlen($stripped);
    }
}
