<?php
/**
 * Project Euler - Problem 43
 *
 * Sub-string divisibility
 *
 * The number, 1406357289, is a 0 to 9 pandigital number because it is made up of each of the digits 0 to 9 in some order, but it also has a rather interesting sub-string divisibility property.

 * Let d1 be the 1st digit, d2 be the 2nd digit, and so on. In this way, we note the following:

 * d<sub>2</sub>d<sub>3</sub>d<sub>4</sub> = 406 is divisible by 2

 * d<sub>3</sub>d<sub>4</sub>d<sub>5</sub> = 063 is divisible by 3

 * d<sub>4</sub>d<sub>5</sub>d<sub>6</sub> = 635 is divisible by 5

 * d<sub>5</sub>d<sub>6</sub>d<sub>7</sub> = 357 is divisible by 7

 * d<sub>6</sub>d<sub>7</sub>d<sub>8</sub> = 572 is divisible by 11

 * d<sub>7</sub>d<sub>8</sub>d<sub>9</sub> = 728 is divisible by 13

 * d<sub>8</sub>d<sub>9</sub>d<sub>10</sub> = 289 is divisible by 17

 * Find the sum of all 0 to 9 pandigital numbers with this property.
 *
 * @category ProjectEuler
 * @package Problem43
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=43
 *
 */
class Problem43 extends Problem_Abstract
{
    private $possibles;

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
        return $this->findSubStringDivisiblePandigitalNumbers();
    }

    /**
     * Figure out all the permuations any given set of 3 digits could be
     * and build up the possible strings from there instead of testing a
     * huge number space to see if the number conforms.
     */
    private function getPermutations()
    {
        $divisors = array(2, 3, 5, 7, 11, 13, 17);
        $perms = [];
        foreach ($divisors as $d) {
            $tmp = [];
            for ($i = 12; $i <= 987; $i++) {
                if ($i % $d === 0) {
                    $tmp[] = str_pad($i, 3, "0", STR_PAD_LEFT);
                }
            }
            $perms[] = $tmp;
            /* // debug
            echo "$d has ".count($tmp)." permutations:\n";
            echo implode(",",$tmp)."\n";
            */
        }
        return $perms;
    }

    private function findSubStringDivisiblePandigitalNumbers()
    {
        $perms = $this->getPermutations();
        $perm = $perms[0];
        // initial conditions
        foreach ($perm as $p) {
            $this->buildNumbers($p, array_slice($perms, 1)); 
        }

        $answers = [];
        $sum = 0;
        for ($i = 1; $i <= 9; $i++) {
            foreach ($this->possibles as $p) {
                if ($this->isPandigital((string) $i.$p)) {
                    $answer = $i.$p;
                    // echo "Answer found! $answer \n"; // debug
                    $sum += (int) $answer;
                    $answers[] = $answer;
                }
            }
        }
        return $sum;
    }

    /**
     * Brute force failed miserably... So instead let's build from what we know
     * Narrow down our options by making sure the last 2 digits of a
     * permutation "level" meet those of the next "level"
     *
     * Obviously this has to be a recursive function where we keep building up
     * a valid "start" of the string with a shorter set of "permutation levelsi"
     * Also spent *WAY* too much time figuring out how to build up "possibles"
     * before I just decided to use a private variable to append to. Derp.
     */
    private function buildNumbers($start, $perms) {
        $possibles = [];
        $new_perm = $perms[0];

        foreach ($new_perm as $p) {
            if (substr($start, -2) == substr($p, 0, 2)) {
                $new_start = (string) $start.substr($p, -1);
                if (count($perms) == 1) {
                     // echo "Added a possible:".$new_start."\n"; // debug
                     $this->possibles[] = $new_start;
                } else {
                     $this->buildNumbers($new_start, array_slice($perms, 1));
                }
            }
        }
    }

    /**
     * Test for pandigital-ness
     * e.g. when a numbers digits are ordered they go from 0 to n where n is
     * the number of digits in the number
     *
     * @param string $n Number to check
     *
     * @return boolean Is number pandigital?
     */
    private function isPandigital($n)
    {
        $digits = str_split($n);
        rsort($digits);
        $digits_str = implode("", $digits);
        $test_full = "9876543210";
        $test_str = substr($test_full, 0, strlen($digits_str));
        return (strcmp($test_str, $digits_str) === 0);
    }
}
