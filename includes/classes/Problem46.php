<?php
/**
 * Project Euler - Problem 46
 *
 * Goldbach's other conjecture
 *
 * It was proposed by Christian Goldbach that every odd composite number can be written as the sum of a prime and twice a square.
 * 9 = 7 + 2×12
 * 15 = 7 + 2×22
 * 21 = 3 + 2×32
 * 25 = 7 + 2×32
 * 27 = 19 + 2×22
 * 33 = 31 + 2×12
 *
 * It turns out that the conjecture was false.
 * What is the smallest odd composite that cannot be written as the sum of a prime and twice a square? 
 *
 * @category ProjectEuler
 * @package Problem46
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=46
 *
 */
class Problem46 extends Problem_Abstract
{
    /**
     * Description of input
     * @const string INPUT
     */
    const UPPER_BOUND = 100000;

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 
    }

    /**
     * Wrapper method to output our answer with the appropriate input variables
     *
     * @return int
     */
    public function execute()
    {
        return $this->testGoldbachsOtherConjecture(self::UPPER_BOUND);
    }

    /**
     * Test Goldbach's other conjecture where we are testing all numbers from 3 to $upper_bound
     * to find a number x where x != (prime # + 2 * y^2) where y is an integer and x is not itself prime 
     *
     * @param string $upper_bound Final number to test
     *
     * @return int The first number which does not fit these constraints
     */
    private function testGoldbachsOtherConjecture($upper_bound){
        $answer = 0;
        for ($i = 3; $i < $upper_bound; $i = $i+2) {        
            if (! $this->isPrime($i)) {
                // echo "\nTesting $i to see if it fits Goldbach's other conjecture\n"; // debug
                $found = false;
                for ($p = 3; $p < $i; $p = $p+2) {   
                    if (! $this->isPrime($p)) { continue; }
                    $tw_sq = $i - $p;
                    if ($tw_sq < 2) { break; }
                    $sq = $tw_sq / 2;
                    // echo "prime is $p, sqr_rt is ".sqrt($sq)."\n"; // debug
                    if (($sq == floor($sq)) && (sqrt($sq) == floor(sqrt($sq)))) {
                        // echo "For $i, prime is $p and square root is $sq\n"; // debug
                        $found = true;
                        break;
                    } 
                }
                if (!$found) {
                    $answer = $i;
                    // echo "$i is an odd composite that does not fit the conjecture\n"; // debug
                    break;
                }
            }
        }
        return ($answer > 0) ? $answer : "not found";
    }

    /**
     * Test for Prime-ness
     *
     * @param string $n Number to test for primality
     *
     * @return boolean Is number prime?
     */
    private function isPrime($n) {
        static $primes = array(2, 3);

        if ($n === 1) {
            return false;
        } elseif ($n <= 3) {
            return true;
        } elseif ($n % 2 == 0 || $n % 3 == 0) {
            return false;
        } else {
            foreach ($primes as $prime) { // Use sieve
                if ($n > $prime && $n % $prime == 0) {
                    return false;
                }
            }
            // TODO: Come back and understand this prime test algo better
            for ($i = 5; $i <= sqrt($n) + 1; $i += 6) {
                if ($n % $i == 0 || $n % ($i + 2) == 0) {
                    return false;
                }
            }
            // Store in sieve
            if ($n < 300 && !in_array($n, $primes)) {
                $primes[] = $n;
            }
            return true;
        }
    }


}
