<?php
/**
 * Project Euler - Problem 54
 *
 * Poker hands
 *
 * In the card game poker, a hand consists of five cards and are ranked, from lowest to highest, in the following way:
 * High Card: Highest value card.
 * One Pair: Two cards of the same value.
 * Two Pairs: Two different pairs.
 * Three of a Kind: Three cards of the same value.
 * Straight: All cards are consecutive values.
 * Flush: All cards of the same suit.
 * Full House: Three of a kind and a pair.
 * Four of a Kind: Four cards of the same value.
 * Straight Flush: All cards are consecutive values of same suit.
 * Royal Flush: Ten, Jack, Queen, King, Ace, in same suit.
 * The cards are valued in the order:2, 3, 4, 5, 6, 7, 8, 9, 10, Jack, Queen, King, Ace.
 *
 * If two players have the same ranked hands then the rank made up of the highest value wins; for example, a pair of eights beats a pair of fives (see example 1 below). But if two ranks tie, for example, both players have a pair of queens, then highest cards in each hand are compared (see example 4 below); if the highest cards tie then the next highest cards are compared, and so on.
 * Consider the following five hands dealt to two players:
 * 
 * Hand  Player 1                                     Player 2                                    Winner
 * 1     5H 5C 6S 7S KD Pair of Fives                 2C 3S 8S 8D TD Pair of Eights               Player 2
 * 2     5D 8C 9S JS AC Highest card Ace              2C 5C 7D 8S QH Highest card Queen           Player 1
 * 3     2D 9C AS AH AC Three Aces                    3D 6D 7D TD QD Flush w/ Diamonds            Player 2
 * 4     4D 6S 9H QH QC Pair of Queens, High card 9   3D 6D 7H QD QS Pair of Queens, High card 7  Player 1
 * 5     2H 2D 4C 4D 4S Full House w/ Three Fours     3C 3D 3S 9S 9D Full House w/ Three Threes   Player 1
 * 
 * The file, poker.txt, contains one-thousand random hands dealt to two players. Each line of the file contains ten cards (separated by a single space): the first five are Player 1's cards and the last five are Player 2's cards. You can assume that all hands are valid (no invalid characters or repeated cards), each player's hand is in no specific order, and in each hand there is a clear winner.

 * How many hands does Player 1 win? 
 *
 * @category ProjectEuler
 * @package Problem54
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=54
 *
 */
class Problem54 extends Problem_Abstract
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
     * Description of input
     * @const string INPUT
     */
    const INPUT = '';

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
        return $this->findSomething(self::INPUT);
    }

    /**
     * Find "Something".
     *
     * @param string $number description
     *
     * @return int description
     */
    private function findSomething($number){

        return;
    }
}
