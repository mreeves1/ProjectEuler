<?php
/**
 * Project Euler - Problem 49
 *
 * Prime permutations
 *
 * The arithmetic sequence, 1487, 4817, 8147, in which each of the terms increases by 3330, is unusual in two ways:
 * (i) each of the three terms are prime
 * (ii) each of the 4-digit numbers are permutations of one another
 *
 * There are no arithmetic sequences made up of three 1-, 2-, or 3-digit primes, exhibiting this property,
 * but there is one other 4-digit increasing sequence.
 * What 12-digit number do you form by concatenating the three terms in this sequence?
 *
 * @category ProjectEuler
 * @package Problem49
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=49
 *
 */
class Problem49 extends Problem_Abstract
{
    /**
     * Project Euler says each problem should take no more than 1 minute.
     * If your computer is slow make this larger.
     * @const int TIMEOUT_OVERRIDE Used with an override method to control how long it
     * takes for the script to timeout
     */
    const TIMEOUT_OVERRIDE = 60;

    /**
     * Project Euler is silent on space complexity. PHP uses a LOT of memory for arrays.
     * Something like 20x what you would expect.
     * @const int MEMORY_OVERRIDE Used with an override method to control how much memory
     * the script is allowed to consume.
     */
    const MEMORY_OVERRIDE = '64M';

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
        return $this->concatPrimePermutations();
    }

    /**
     * Find and concatenate prime permutations that are equidistant from each other as described above.
     *
     * @return string 3 * 4 digit numbers concatenated into a 12 character string
     */
    private function concatPrimePermutations(){
        // The constraints are unusually specific so let's not waste time trying to make this more general

        // Step 1: Find primes with 4 digits
        $i_min = 1000;
        $i_max = 9999;
        $primes = [];
        for ($i = $i_min; $i <= $i_max; $i++) {
            if ($this->isPrime($i)) {
                $primes[] = $i;
            }
        }
        // echo var_export($primes, true); // debug

        // Step 2: Find permutations that are prime. e.g. 1487, 4817, 8147 possess the same digits rearranged
        $perms_map = [];
        foreach ($primes as $p) {
            // find key which is digits in order - this key is NOT necessarily prime
            $digits = str_split($p);
            sort($digits);
            $key = implode('', $digits);
            if (isset($perms_map[$key])) {
                $items = $perms_map[$key];
                $items[] = $p;
                $perms_map[$key] = $items;
            } else {
                $perms_map[$key] = array($p);
            }
        }
        // echo var_export($perms_map, true); // debug

        // Step 3: Now pass this array to a method that can determine if there are three elements that are equidistant
        foreach ($perms_map as $key=>$seq) {
            $test = $this->findEquidistantTriplets($seq);
            $known = array(1487, 4817, 8147);
            if ($test && $test != $known) {
                return (string) implode('', $test);
            }
        }
    }

    /**
     * Given an array $a find if there are three numbers $a which are the same distance from one another
     *
     * @param array $a Input array of numbers
     * @return array|bool
     */
    private function findEquidistantTriplets($a) {
        $max = count($a);
        if ($max < 3) { return false; }

        for ($i = 0; $i < $max - 2; $i++) {
            for ($j = $i + 1; $j < $max - 1; $j++) {
                $delta1 = $a[$j] - $a[$i];
                for ($k = $j + 1; $k < $max; $k++) {
                    $delta2 = $a[$k] - $a[$j];
                    if ($delta1 === $delta2) {
                        $answer = array($a[$i], $a[$j], $a[$k]);
                        // echo 'sequence found: '.var_export($answer, true)."\n"; // debug
                        return $answer;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Test for Prime-ness (cribbed from problem 50)
     *
     * @param string $n Number to test for primality
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
