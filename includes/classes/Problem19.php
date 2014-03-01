<?php
/**
 * Project Euler - Problem 19
 *
 * Counting Sundays
 *
 * You are given the following information, but you may prefer to do some research for yourself.
 * 1 Jan 1900 was a Monday.
 * Thirty days has September,
 * April, June and November.
 * All the rest have thirty-one,
 * Saving February alone,
 * Which has twenty-eight, rain or shine.
 * And on leap years, twenty-nine.
 * A leap year occurs on any year evenly divisible by 4, but not on a century unless it is divisible by 400.
 * How many Sundays fell on the first of the month during the twentieth century (1 Jan 1901 to 31 Dec 2000)? 
 *
 * @category ProjectEuler
 * @package Problem19
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=19
 *
 */
class Problem19 extends Problem_Abstract
{

    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow make this larger.
     * $const int PROBLEM_TIMEOUT Used with set_timeout_limit to throw a timeout if problem computation takes too long.
     */
    const PROBLEM_TIMEOUT_OVERRIDE = 60;

    /**
     * Start Year
     * @const int INPUT_START
     */
    const INPUT_START = 1901;

    /**
     * End Year
     * @const int INPUT_END
     */
    const INPUT_END = 2000;

    private $monthsMap = array(
                              "jan" => 31,
                              "feb" => 28,
                              "mar" => 31,
                              "apr" => 30,
                              "may" => 31,
                              "jun" => 30,
                              "jul" => 31,
                              "aug" => 31,
                              "sep" => 30,
                              "oct" => 31,
                              "nov" => 30,
                              "dec" => 31
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
        return $this->countSundaysInRange(self::INPUT_START, self::INPUT_END);
    }

    /**
     * Find Number of Sundays in a range of years.
     *
     * @param int $yearStart starting year in range
     * @param int $yearEnd ending year in range
     *
     * @return int description
     */
    private function countSundaysinRange($yearStart, $yearEnd)
    {
        $sundayCount = 0;
        // cheat on init conditions
        // per rules 1900 has 365 days (leap year century not divisible by 400)
        // 52 * 7 = 364, 365 - 364 = 1 left over day, so 
        $leftOverDays = ($yearStart == 1901) ? 1 : die("Unknown leftover day count");
        $sundayCount = $this->countSundays($yearStart, $yearEnd, 0, $leftOverDays); // initial conditions
        return $sundayCount;
    }

    private function countSundays($currentYear, $yearEnd, $sundayCount, $leftOverDays)
    {
        foreach ($this->monthsMap as $month => $days) {
            if ($month == 'feb' && $currentYear % 400 == 0) {
                $days++;
            } elseif ($month == 'feb' && $currentYear % 100 != 0 && $currentYear % 4 == 0) {
                $days++;
            } else {
                // not leap year
            }    
            echo $month.", ".$currentYear." has ".$days." days"; // debug
            if ($leftOverDays == 6) {
                $sundayCount++;
                echo " Sunday found on the first!\n"; // debug
            } else {
                echo "\n";
            }
            $totalDays = $days + $leftOverDays;
            $weekCount = floor($totalDays/7);
            $leftOverDays = $totalDays - ($weekCount * 7);
        }

        $newCurrentYear = $currentYear + 1;
        if ($currentYear == $yearEnd) {
            return $sundayCount;
        } else {
            return $this->countSundays($newCurrentYear, $yearEnd, $sundayCount, $leftOverDays); 
        }
    }
}
