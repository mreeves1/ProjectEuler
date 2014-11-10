<?php
/**
 * Project Euler - Problem 42
 *
 * Coded triangle numbers
 *
 * The nth term of the sequence of triangle numbers is given by, tn = ½n(n+1); so the first ten triangle numbers are:
 * 1, 3, 6, 10, 15, 21, 28, 36, 45, 55, ...
 * By converting each letter in a word to a number corresponding to its alphabetical position and adding these values we form a word value. For example, the word value for SKY is 19 + 11 + 25 = 55 = t10. If the word value is a triangle number then we shall call the word a triangle word.
 * Using <a href="https://projecteuler.net/project/resources/p042_words.txt">words.txt</a>, a 16K text file containing nearly two-thousand common English words, how many are triangle words? 
 *
 * @category ProjectEuler
 * @package Problem42
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=42
 *
 */
class Problem42 extends Problem_Abstract
{
    /**                                                                                                                         
     * File with 2000+ comma english words (comma delimited and quoted)                                                                 
     * @const string INPUT                                                                                                      
     */                                                                                                                         
    const INPUT_FILE = 'files/problem42_words.txt';

    /**
     * Override default timeout of 60 seconds
     */
    public function __construct()
    {
        parent::__construct(); 

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
        return $this->countTriangleWords(self::INPUT_FILE);
    }

    /**
     * Count triangle words found in this word file
     *
     * @param string $input_file File with CSV delimited words
     *
     * @return int Number of triangle words found
     */
    private function countTriangleWords($input_file){
        $fh = fopen($input_file, "r");
        $words = array();

        $tri_words = array();
        $tri_word_count = 0;
        while (($row = fgetcsv($fh, 0, ",", "\"")) !== false) {
            $words = array_merge($words, $row);
        }

        // Find max length
        $max_length = 0;
        foreach ($words as $word) {
            $max_length = strlen($word) > $max_length ? strlen($word) : $max_length;
        }
        $max_value = 26 * $max_length; // longest word * max value per character (z)
        $tri_numbers = $this->getTriangleNumbers($max_value); 

        foreach ($words as $word) {
            $letters = str_split($word);
            $word_value = 0;
            foreach ($letters as $letter) {
                $word_value += $this->ltrToInt($letter);
            }
            if (in_array($word_value, $tri_numbers)) {
                $tri_word_count++;
                $tri_words[$word] = $word_value;
            }
        }
        // echo "Found Triangle Words:\n" . var_export($tri_words, true) . "\n"; // Debug

        return $tri_word_count;
    }

    private function getTriangleNumbers($upper_bound) {
        $tri_numbers = array();
        $n = 1;
        $tri_number = 1;
        while ($tri_number <= $upper_bound) {
            $tri_number = ($n / 2)*($n + 1);
            $tri_numbers[] = $tri_number;
            // echo "triangle number: ".$tri_number."\n"; // Debug
            $n++;
        }
        return $tri_numbers;
    }
 
    // returns 1 for a or A, 2 for b or B, etc.  
    private function ltrToInt($char) {
        return (ord(strtolower($char)) - 96);
    }
}
