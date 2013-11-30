<?php
/**
 * Project Euler - Problem 14
 *
 * Longest Collatz sequence
 *
 * The following iterative sequence is defined for the set of positive integers:
 * 
 * n → n/2 (n is even)
 * n → 3n + 1 (n is odd)
 * 
 * Using the rule above and starting with 13, we generate the following sequence:
 * 
 * 13 → 40 → 20 → 10 → 5 → 16 → 8 → 4 → 2 → 1
 * It can be seen that this sequence (starting at 13 and finishing at 1) contains 10 terms.
 * Although it has not been proved yet (Collatz Problem), it is thought that all starting numbers finish at 1.
 * 
 * Which starting number, under one million, produces the longest chain?
 * 
 * NOTE: Once the chain starts the terms are allowed to go above one million.
 * 
 * @category ProjectEuler
 * @package Problem14
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=14
 *
 */
class Problem14 extends Problem_Abstract
{

    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow make this larger.
     * $const int PROBLEM_TIMEOUT Used with set_timeout_limit to throw a timeout if problem computation takes too long.
     */
    const PROBLEM_TIMEOUT_OVERRIDE = 90;

    /**
     * Description of input
     * @const int INPUT
     */
    const INPUT = 999999;
    // const INPUT = 13;

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
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
        return $this->findLongestCollatzSequence(self::INPUT);
    }


    /**
     * Find Longest Collatz Sequence which starts under the Upper Limit.
     *
     * @param int $upperLimit Upper bound number we test
     *
     * @return int Number with longest collatz sequence
     */
    private function findLongestCollatzSequence($upperLimit){
        $maxNumber = 0;
        $maxChainLength = 0;
        for ($i = $upperLimit; $i > 0; $i--) {
            $chainLength = $this->findNextCollatzItem($i, 0);
            if ($chainLength > $maxChainLength) {
                $maxChainLength = $chainLength;
                // echo "\ncl is now".$chainLength." and maxNumber is now $i"; // debug
                $maxNumber = $i;
            }
        }
        return $maxNumber;
    }

    private function findNextCollatzItem($n, $chainLength) {
      $chainLength++;
      if ($n === 1) {
          return $chainLength;
      }
      elseif ($n % 2 === 0) {
          return $this->findNextCollatzItem($n / 2, $chainLength);
      }
      else {
          return $this->findNextCollatzItem((3*$n + 1), $chainLength);
      }
    }
}
