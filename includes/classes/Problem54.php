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
    // const INPUT_FILE = 'files/problem54_poker.txt';
    const INPUT_FILE = 'files/problem54_poker_test.txt';

    const POINTS_ROYAL_FLUSH = 1000;
    const POINTS_STRAIGHT_FLUSH = 900;
    const POINTS_FLUSH = 600;
    const POINTS_STRAIGHT = 500;

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
        // return $this->findPlayer1Wins(self::INPUT_FILE);
        // $p1_h1 = array('5H', '5C', '6S', '7S', 'KD');
        $p1_h1 = array('TC', 'JC', 'QC', 'KC', 'AC');
        // $p2_h1 = array('2C', '3S', '8S', '8D', 'TD');
        $p2_h1 = array('2C', '3C', '8C', '7C', 'TC');
        echo $this->scoreHand($p1_h1);
        echo $this->scoreHand($p2_h1);
        // $p1_h2 = array('5D', '8C', '9S', 'JS', 'AC');
        $p1_h2 = array('2C', '4C', '3C', '5C', '6C');
        $p2_h2 = array('3D', '5C', '7D', '8S', 'QH');
        echo $this->scoreHand($p1_h2);
        echo $this->scoreHand($p2_h2);
        // echo "regular straights";
        // var_dump($this->getStraights());
        // echo "royal straight";
        // var_dump($this->getStraights(true));

    }

    /**
     * Find "Something".
     *
     * @param string $number description
     *
     * @return int description
     */
    private function findPlayer1Wins($input_file){
        $lines = file($input_file);
        foreach ($lines as $i => $line) {
            $tmp_array = explode(" ", trim($line));
            $p1_cards = array_slice($tmp_array, 0, 5);
            sort($p1_cards);
            $p2_cards = array_slice($tmp_array, 5, 5);
            sort($p2_cards);
            echo "player 1 cards: \n";
            // var_dump($p1_cards); // debug
            echo "player 2 cards: \n";
            // var_dump($p2_cards); // debug

            // return;
        }
    }

    private function scoreHand($hand) {
        var_dump($hand);
        $score = 0;
        // Royal Flush
        $suits = array();
        $values = array();
        foreach ($hand as $card) {
            $suit = substr($card, -1);
            $val = substr($card, 0, -1);
            $suits[$suit] = isset($suits[$suit]) ? $suits[$suit] + 1 : 1;
            $values[$val] = isset($values[$val]) ? $values[$val] + 1 : 1;
        }
//        arsort($suits);
//        arsort($values);
//        var_dump($suits);
//        var_dump($values);
        $score1 = $this->scoreFlushesAndStraights($suits, $values);
        echo $score1;
        echo "\n";
    }

    private function isFlush($suits) {
        arsort($suits);
        $common_suit = array_slice($suits, 0, 1);
        return current($common_suit) == 5 ? true : false;
    }

    // generate an array of arrays of all straights
    private function getStraights($royal_only = false) {
        $val_map = array(
            1 => 'A', // not explicitly stated in problem but common in cards
            10 => 'T',
            11 => 'J',
            12 => 'Q',
            13 => 'K',
            14 => 'A'
        );
        $straights = [];
        $i_min = $royal_only === true ? 10 : 1;
        for ($i = 10; $i >= $i_min; $i--) {
            $tmp = array();
            for ($j = $i; $j <= $i + 4; $j++) {
                $tmp[] = isset($val_map[$j]) ? $val_map[$j] : $j;
            }
            $straights[] = $tmp;
        }
        return $straights;
    }

    private function isRegularStraight($values) {
        $straights = $this->getStraights();
        return $this->isStraight($values, $straights);
    }

    private function isRoyalStraight($values) {
        $straights = $this->getStraights(true);
        return $this->isStraight($values, $straights);
    }

    private function isStraight($values, $straights) {
        if (count($values) !== 5) { return false; }
        foreach ($straights as $s) {
            $found = true;
            foreach ($s as $card) {
                if (!isset($values[$card])) {
                    $found = false;
                    break;
                }
            }
            if ($found = true) {return true;}
        }
        return false;
    }

    private function scoreFlushesAndStraights($suits, $values) {
        $is_flush = $this->isFlush($suits);
        $is_reg_straight = $this->isRegularStraight($values);
        $is_royal_straight = $this->isRoyalStraight($values);

        echo "Flush: $is_flush\n";
        echo "Regular Straight: $is_reg_straight\n";
        echo "Royal Straight: $is_royal_straight\n";
        // TODO:

    }

    private function scoreFlushesAndStraightsOld($suits, $values) {
      $straight_values = array('Q', 'K', 'J', 'A', 10, 9, 8, 7, 6, 5, 3, 2);
      $royal_flush_values = array(10, 'Q', 'K', 'J', 'A');
 
      // Test Flushes
      $common_suit = array_slice($suits, 0, 1);
      echo 'suits most common: '.key($common_suit)."\n";
      if (current($common_suit) == 5) {
          echo '$royal_flush_values'."\n";
          var_export($royal_flush_values);
          $akv = array_keys($values);
          rsort($akv);
          echo 'array_keys($values)'."\n";
          var_export($akv);
          if ($akv == $royal_flush_values) {
              return self::POINTS_ROYAL_FLUSH;
          }
          else {
              for ($i = 0; $i <= 7; $i++) {
                  if (array_keys($values) == array_slice($straight_values, $i, 5)) {
                      return self::POINTS_STRAIGHT_FLUSH;
                  }
              }
              return self::POINTS_FLUSH; // TODO: Calculate tie breakers
          }
/* 
          $found_royal_flush = true;
          foreach($royal_flush_values as $rfv) {
              if (!isset($values[$rfv])) {
                  $found_royal_flush = false;
                  break;
              }
          }
          if ($found_royal_flush) { return POINTS_ROYAL_FLUSH; }
*/

      }
    }
}
