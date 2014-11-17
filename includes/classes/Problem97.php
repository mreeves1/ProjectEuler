<?php
/**
 * Project Euler - Problem 97
 *
 * Large non-Mersenne prime
 *
 * The first known prime found to exceed one million digits was discovered in 1999, and is a Mersenne prime of the form 26972593−1; it contains exactly 2,098,960 digits. Subsequently other Mersenne primes, of the form 2p−1, have been found which contain more digits.
 * However, in 2004 there was found a massive non-Mersenne prime which contains 2,357,207 digits: 28433×2^7830457+1.
 * Find the last ten digits of this prime number. 
 *
 * @category ProjectEuler
 * @package Problem97
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=97
 *
 */
class Problem97 extends Problem_Abstract
{
    /**
     * Project Euler says each problem should take no more than 1 minute. 
     * If your computer is slow make this larger.
     * @const int TIMEOUT_OVERRIDE Used with an override method to control how long it 
     * takes for the script to timeout
     */
    const TIMEOUT_OVERRIDE = 120;

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

        $this->overrideTimeoutAndMemoryLimit(self::TIMEOUT_OVERRIDE, self::MEMORY_OVERRIDE);

        if (!extension_loaded('bcmath')) {
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
        return $this->findLargeNonMersennePrimeDigits();
    }

    /**
     * Find Last 10 Digits of this Large Non Mersenne Prime.
     * It equals: 28433 × 2^7830457 + 1 
     * 
     * TODO: This takes ~90 seconds so there must be a better way. 
     * Perhaps this holds some clues:
     * @link http://stackoverflow.com/questions/7214419/how-to-find-the-units-digit-of-a-certain-power-in-a-simplest-way
     * 
     * @return string Last 10 digits of this prime
     */
    private function findLargeNonMersennePrimeDigits(){
        $a = bcpow('2','7830457');
        $b = bcmul('28433', $a);
        $c = bcadd($b, '1');

        return substr($c, -10);
    }
}
