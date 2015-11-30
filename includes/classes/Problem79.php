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
    }

    /**
     * Wrapper method to output our answer with the appropriate input variables
     *
     * @return int
     */
    public function execute()
    {
        return $this->findPasscodeDerivation(self::INPUT_FILE);
    }

    /**
     * Find Passcode Derivation.
     *
     * @param string $input_file File with keylog records
     *
     * @return string Calculated password
     */
    private function findPasscodeDerivation($input_file)
    {                            
        $lines = file($input_file);
        $node_map = [];
        $chars = [];
        foreach ($lines as $l) {
            list($a, $b, $c) = str_split(trim($l));
            if (!in_array($a, $chars)) {$chars[] = $a;}
            if (!in_array($b, $chars)) {$chars[] = $b;}
            if (!in_array($c, $chars)) {$chars[] = $c;}
            if (!isset($node_map[$a]) || !in_array($b, $node_map[$a])) {
                $node_map[$a][] = $b;
            }
            if (!isset($node_map[$b]) || !in_array($c, $node_map[$b])) {
                $node_map[$b][] = $c;
            }
        }

        foreach ($chars as $char) {
            $answer = $this->createString($char, $char, $node_map);
            if ($answer) {
                return $answer;
            }
        }
    }

    private function createString($total, $last, $map) {
        if (strlen($total) == 8) { // TODO: 8 is the number of unique digits in the node map
            return $total;
        }
        $current = isset($map[$last]) ? $map[$last] : array();
        // echo "\nTrying total: $total, last: $last, curr: ".implode(', ', $current)."\n"; // debug
        foreach($current as $m) {
            $new_total = (string) $total.$m;
            $answer = $this->createString($new_total, $m, $map);
            if ($answer) {
                return $answer;
            }
        }
    }
}
