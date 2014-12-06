<?php
/**
 * Project Euler - Problem 99
 *
 * Largest exponential
 *
 * Comparing two numbers written in index form like 2^11 and 3^7 is not difficult, as any calculator would confirm that 2^11 = 2048 < 3^7 = 2187.
 * However, confirming that 632382^518061 > 519432^525806 would be much more difficult, as both numbers contain over three million digits.
 * Using <a href="https://projecteuler.net/project/resources/p099_base_exp.txt">base_exp.txt</a>, a 22K text file containing one thousand lines with a base/exponent pair on each line, determine which line number has the greatest numerical value.
 *
 * NOTE: The first two lines in the file represent the numbers in the example given above. 
 *
 * @category ProjectEuler
 * @package Problem99
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=99
 *
 */
class Problem99 extends Problem_Abstract
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
     * File with 1000 lines, each in the form x, y
     * @const string INPUT_FILE
     */
    const INPUT_FILE = 'files/problem99_base_exp.txt';

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
        return $this->findLineWithLargestValue(self::INPUT_FILE);
    }

    /**
     * Find the line in the csv input value with the largest value 
     * where a large number x raised to a large number y
     * 
     * All credit goes to this guy: http://math.stackexchange.com/a/8310/141387
     * So comparing a^b to c^d can also works by comparing (b * log a) to (d * log c)
     * I should have remembered that logarithms are sort of the inverse of powers
     * TODO: review logarithms :-/ 
     *
     * @param string $input_file csv filename with x and y values 
     *
     * @return int The line with the largest calculated value
     */
    private function findLineWithLargestValue($input_file)
    {
        $fh = fopen($input_file, "r");
        $line = 1;
        $max_val = 0;
        $max_line = 0;
        while (($row = fgetcsv($fh, 0, ",", "'")) !== false) {
            list($x, $y) = $row;
            // echo "test $x^$y\n"; // debug
            $test_val = $y * log($x);
            // echo "test_val: $test_val\n"; // debug
            if (bccomp($test_val, $max_val) > 0) {
                $max_val = $test_val;
                $max_line = $line;
            }
            $line++;
        }
        return $max_line;
    }
}
