<?php
/**
 * Project Euler - Problem 12
 *
 * Highly divisible triangular number
 *
 * Problem...
 * Long...
 * Description... or notes...
 *
 * @category ProjectEuler
 * @package Problem12
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=12
 *
 */
class Problem12 extends Problem_Abstract
{

    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow make this larger.
     * $const int PROBLEM_TIMEOUT Used with set_timeout_limit to throw a timeout if problem computation takes too long.
     */
    const PROBLEM_TIMEOUT_OVERRIDE = 600;

    /**
     * Description of input
     * @const string INPUT
     */
    // const INPUT = 5;
    // const INPUT = 50;
    // const INPUT = 250; // 2162160
    const INPUT = 500;

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
        return $this->findTriangleNumber(self::INPUT);
    }


    /**
     * Find "Something".
     *
     * @param string $number description
     *
     * @return int description
     */
    private function findTriangleNumber($divisorCount) {
        $t1 = time(true);
        $count = 0;
        $triangleIndex = 1;
        $triangleNumber = 0;
        while ($count < $divisorCount){
          $triangleNumber += $triangleIndex; 
          // echo $triangleNumber."\n"; //debug
          $count = self::countDivisors($triangleNumber);
          $triangleIndex++;

        }       
        $t2 = time(true);
        return "time elapsed: ".round(($t2 - $t1), 4)." answer: ".$triangleNumber;
    }

    private function countDivisors($number) {
        $count = 1; // this is the number itself since we only go to number/2
        $numbers = array($number);
        for ($i = 1; $i <= $number/2; $i++) { // can be optimized further?
            if ($number % $i === 0) {
                $count++;
                $numbers[] = $i;
            }    
        }
        echo $number." : ".$count."\n";
        //echo "divisors: ".implode(", ",$numbers)."\n";

        return $count;
    }

}
