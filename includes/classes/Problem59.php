<?php
/**
 * Project Euler - Problem 59
 *
 * XOR decryption
 *
 * Each character on a computer is assigned a unique code and the preferred standard is ASCII (American Standard Code for Information Interchange). For example, uppercase A = 65, asterisk (*) = 42, and lowercase k = 107.
 * A modern encryption method is to take a text file, convert the bytes to ASCII, then XOR each byte with a given value, taken from a secret key. The advantage with the XOR function is that using the same encryption key on the cipher text, restores the plain text; for example, 65 XOR 42 = 107, then 107 XOR 42 = 65.
 * For unbreakable encryption, the key is the same length as the plain text message, and the key is made up of random bytes. The user would keep the encrypted message and the encryption key in different locations, and without both "halves", it is impossible to decrypt the message.
 * Unfortunately, this method is impractical for most users, so the modified method is to use a password as a key. If the password is shorter than the message, which is likely, the key is repeated cyclically throughout the message. The balance for this method is using a sufficiently long password key for security, but short enough to be memorable.
 * Your task has been made easy, as the encryption key consists of three lower case characters. Using cipher.txt (right click and 'Save Link/Target As...'), a file containing the encrypted ASCII codes, and the knowledge that the plain text must contain common English words, decrypt the message and find the sum of the ASCII values in the original text. 
 *
 * @category ProjectEuler
 * @package Problem59
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=59
 *
 */
class Problem59 extends Problem_Abstract
{
    const MEMORY_OVERRIDE = '64M';

    /**
     * File with encrypted ascii char values
     * @const string INPUT_FILE
     */
    const INPUT_FILE = 'files/problem59_cipher.txt';

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
        return $this->findXorDecryptionValue(self::INPUT_FILE);
    }

    /**
     * Find XOR decryption summed value of the input file.
     *
     * @param string $input_file A file with encrypted ascii values
     *
     * @return int description
     */
    private function findXorDecryptionValue($input_file){
        $input = file($input_file);
        $letters = explode(',', trim($input[0]));
        // echo "There are ".count($letters)." letters<br>\n";
        // echo var_export($letters, true);

        $ascii_map = [];
        for ($i = 0; $i <= 127; $i++) {
            $ascii_map[$i] = chr($i);
            // echo "$i: ".chr($i)."\n"; // debug
        }
        // echo "ascii map:\n".var_export($ascii_map, true); // debug

        $corpus = array();
        $i = 1;
        foreach ($letters as $l) {
            $corpus[$i][] = $l;
            $i = $i === 3 ? 1 : $i + 1;
        }
        // echo var_export($corpus, true); // debug
        $common = [];


        for ($i = 1; $i <= 3; $i++) {
            $common[$i] = []; // init
            foreach ($corpus[$i] as $k => $num) {
                $num = (string) $num;
                // echo "corpus - $i - $num <br>\n"; // debug
                $common[$i][$num] = isset($common[$i][$num]) ? $common[$i][$num] + 1 : 1;
            }
            /*
            echo "common 1:<br>\n";
            echo var_export($common, true);
            arsort($common[$i]);
            echo "common 2:<br>\n";
            echo var_export($common, true);
            // echo "corpus #$i<br>\n";
            foreach ($common[$i] as $code => $count) {
                // echo $ascii_map[$code] . " has $count instances<br>\n";
            }
            */
        }
        /*
         * HACK: I tried frequency analysis to deduce the code word.
         * This occurred by assuming most likely char is a space.
         * Most frequent chars per corpus were G(71), O(79), D(68) which when XORed
         * with a space (32) tells me the code word is "god".
         */
        $password = 'god';
        $password_chars = str_split($password);
        $deciphered_letter = '';
        $deciphered_sum = 0;
        $j = 0;
        foreach ($letters as $l) {
            $deciphered_value = $l ^ ord($password_chars[$j]);
            $deciphered_char = $ascii_map[$deciphered_value];
            $deciphered_sum += $deciphered_value;
            $deciphered_letter .= $deciphered_char;

            $j = $j === 2 ? 0 : $j + 1;
        }

        return $deciphered_sum;
    }
}
