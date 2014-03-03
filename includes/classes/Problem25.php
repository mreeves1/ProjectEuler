<?php
/**
 * Project Euler - Problem 25
 *
 * 1000-digit Fibonacci number
 *
 * The Fibonacci sequence is defined by the recurrence relation:
 * Fn = Fn1 + Fn2, where F1 = 1 and F2 = 1.
 * Hence the first 12 terms will be:
 * F1 = 1
 * F2 = 1
 * F3 = 2
 * F4 = 3
 * F5 = 5
 * F6 = 8
 * F7 = 13
 * F8 = 21
 * F9 = 34
 * F10 = 55
 * F11 = 89
 * F12 = 144
 * The 12th term, F12, is the first term to contain three digits.
 * What is the first term in the Fibonacci sequence to contain 1000 digits? 
 *
 * @category ProjectEuler
 * @package Problem25
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=25
 *
 */
class Problem25 extends Problem_Abstract
{

    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow make this larger.
     * $const int PROBLEM_TIMEOUT Used with set_timeout_limit to throw a timeout if problem computation takes too long.
     */
    const PROBLEM_TIMEOUT_OVERRIDE = 60;

    /**
     * Description of input
     * @const int INPUT
     */
    // const INPUT = 3; // Test value - should return 144
    const INPUT = 1000; // Problem value

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 
        set_time_limit(self::PROBLEM_TIMEOUT_OVERRIDE);
        if (!extension_loaded('bcmath')) {
            // Placeholder for any extensions required for this problem's code
            die('BCMath extension required. See http://www.php.net/manual/en/book.bc.php .');
        }
    }

    /**
     * Wrapper method to output our answer with the appropriate input variables
     *
     * @return int
     */
    public function execute()
    {
        return $this->findFibNumberWrapper(self::INPUT);
    }

    /**
     * Find nth term in the Fibonacci Sequence with $digits digits.
     *
     * @param string $digits Number of digits we want our Fibonacci Sequence number to have
     *
     * @return int Nth term in sequence 
     */
    private function findFibNumberWrapper($digits){

        return $this->findFibNumber(1, 1, $digits); // seed value for calculating Fib Sequence where n1 + n2 = n3
    }

    /**
     * Recursice method to find nth term in the Fibonacci Sequence with $digits digits
     * 
     * @param string $n1 First Fib Number
     *
     * @param string $n2 Second Fib Number
     *
     * @param string $digits Number of digits we want our Fib number to have
     *
     * @return int Number of term with $digits digits 
     *
     */ 
    private function findFibNumber($n1, $n2, $digits) {
        static $term = 3; // initial value when $n1 = 1 and $n2 = 1
        $n3 = bcadd($n1, $n2);
        // echo "$n1 + $n2 = $n3\n"; //debug
        if (strlen($n3) == $digits) {
            // echo "$n1\n+\n$n2\n=\n$n3\n"; //debug
            return $term;
        } else {
            $term++;
            return $this->findFibNumber($n2, $n3, $digits);
        }
    }
}
