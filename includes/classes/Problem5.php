<?php
/**
 * Project Euler - Problem 5
 *
 * Smallest Multiple
 *
 * 2520 is the smallest number that can be divided by each of the numbers from 1 to 10 without any remainder.
 * What is the smallest positive number that is evenly divisible by all of the numbers from 1 to 20?
 *
 * @category ProjectEuler
 * @package Problem5
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=5
 *
 */
class Problem5 extends Problem_Abstract
{
    /**
     * Smallest number to test
     * @const int INPUT
     */
    const LOWER_BOUND = 1;

    /**
     * Largest number to test
     * @const int INPUT
     */
    const UPPER_BOUND = 20;

    private $_primes = array(); // initialize with no items?

    /**
     * Wrapper method to output our answer with the appropriate input variables
     *
     * @return int
     */
    public function execute()
    {
        return $this->findSmallestMultiple(self::LOWER_BOUND, self::UPPER_BOUND);
    }

    /**
     * Find if a number is prime. Critical that the method that calls this function iterates UPWARDS as
     * it tests larger primes by seeing if they are evenly divisible by smaller primes
     *
     * @param string $number number to test if it's prime
     * @param array $primes array of primes
     *
     * @return bool is this number prime?
     */
    function isPrime($number, $primes){
        if ($number == 1){
            return false;
        }
        elseif ($number == 2){
            return true;
        }
        foreach($primes as $prime){
            if ($number % $prime === 0){
                return false;
            }
            if ($prime > sqrt($number)){ // this makes algo ~15% faster vs. >= number/2
                break;
            }
        }
        return true;
    }

    /**
     * Find smallest number that can be divided by each of the numbers from $lowerBound to $upperBound.
     *
     * @param int $lowerBound smallest number to test
     * @param int $upperBound largest number to test
     *
     * @return int smallest multiple
     */
    private function findSmallestMultiple($lowerBound, $upperBound){
        /*
         * The solution to this problem involves finding the largest prime factors of each number.
         * For example, for 2520 (smallest multiple of the numbers from 1 to 10) you need to find the prime factors
         * of 1 to 10. So for 2, 2; for 3, 3; for 4, 2^2, for 5, 5, for 6, 2 and 3, etc.
         * You need to then sum up all those max prime factors and get their product to find the smallest multiple
         */

        // Find primes in this range
        for ($i = $lowerBound; $i <= $upperBound; $i++){
            if ($this->isPrime($i, $this->_primes)) {
                $this->_primes[] = $i;
            }
        }

        // Store prime and the max power it is raised to. Ie for numbers 1 to 10, 8 has the largest power of 2, 2^3.
        $primeFactorsMax = array();

        for ($i = $lowerBound; $i <= $upperBound; $i++){
            $number = $i;
            $primeFactors = array();
            for ($j = 0; $j < count($this->_primes); $j++) {
                $prime = $this->_primes[$j];
                if ($number % $prime === 0){
                    $number = $number / $prime;
                    $primeFactors[$prime] = isset($primeFactors[$prime]) ? ($primeFactors[$prime] + 1) : 1;
                    $j--; // rewind counter because a number can have duplicate prime factors. Ie 4 = 2^2.
                }
                if ($number === 1 ){
                    break;
                }
            }

            // find max prime factors
            foreach ($primeFactors as $num => $pow) {
                if (!isset($primeFactorsMax[$num]) || $primeFactorsMax[$num] < $pow){
                    $primeFactorsMax[$num] = $pow;
                }
            }

        }

        // echo '<pre><b>Max Prime Factors:</b> '.var_export($primeFactorsMax, true).'</pre>'; //debug
        // Find smallest multiple of numbers in input range
        $answer = 1;
        foreach ($primeFactorsMax as $num => $pow){
            $answer *= pow($num, $pow);
        }

        return $answer;
    }
}
