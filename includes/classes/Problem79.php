<?php
/**
 * Project Euler - Problem 79
 *
 * Passcode derivation
 *
 * A common security method used for online banking is to ask the user for three random characters from a passcode. For example, if the passcode was 531278, they may ask for the 2nd, 3rd, and 5th characters; the expected reply would be: 317.
 * The text file, keylog.txt, contains fifty successful login attempts.
 * Given that the three characters are always asked for in order, analyse the file so as to determine the shortest possible secret passcode of unknown length. 
 *
 * @category ProjectEuler
 * @package Problem79
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=79
 *
 */
class Problem79 extends Problem_Abstract
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
     * File with 5000+ first names (comma delimited and quoted)
     * @const string INPUT
     */
    const INPUT_FILE = 'files/problem79_keylog.txt';

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 

        // $this->overrideTimeoutAndMemoryLimit(self::TIMEOUT_OVERRIDE, self::MEMORY_OVERRIDE);

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
        return $this->findSomething(self::INPUT_FILE);
    }

    /**
     * Find "Something".
     *
     * @param string $number description
     *
     * @return int description
     */
    private function findSomething($input_file) 
    {                            
        $lines = file($input_file);
        $lines = array_map("trim", $lines);
        $lines = array_map("intval", $lines);
        $lines = array_unique($lines);
        sort($lines);
        echo var_export($lines, true);                                    
        return false;
    }
}
