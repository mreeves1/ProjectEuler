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
 * TIL: array_shift does not work well with array_unshift
 *      also array_slice needs to have the preserve keys variable set to true in 
 *      most cases... 
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
     * File with a player 1 and 2 hand on each line in format:
     * values: 2, 3, 4, 5, 6, 7, 8, 9, T (for 10), J, Q, K, A
     * suits: C, D, H, S
     * example: 8C TS KC 9H 4S 7D 2S 5D 3S AC
     * which is: 8 of clubs, 10 of spades, etc. for player 1 and
     *           7 of diamonds, 2 of spades, etc. for player 2
     * @const string INPUT_FILE
     */
    const INPUT_FILE = 'files/problem54_poker.txt';
    // const INPUT_FILE = 'files/problem54_poker_test.txt'; // Test input: Should return 3

    const POINTS_ROYAL_FLUSH = 1000;
    const POINTS_STRAIGHT_FLUSH = 900;
    const POINTS_FOUR_KIND = 800;
    const POINTS_FULL_HOUSE = 700;
    const POINTS_FLUSH = 600;
    const POINTS_STRAIGHT = 500;
    const POINTS_THREE_KIND = 400;
    const POINTS_TWO_PAIRS = 300;
    const POINTS_TWO_KIND = 200;
    const POINTS_HIGH_CARD = 100;

    private $score_map = array('T' => 10, 'J' => 11, 'Q' => 12, 'K' => 13, 'A' => 14);

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
        return $this->countPlayer1Wins(self::INPUT_FILE);
    }

    /**
     * Count Player 1 Wins.
     *
     * @param string $input_file File with card hands stores on each line
     *
     * @return int description
     */
    private function countPlayer1Wins($input_file){
        $p1_wins = 0;
        $lines = file($input_file);

        foreach ($lines as $i => $line) {
            $tmp_array = explode(" ", trim($line));
            $p1_cards = array_slice($tmp_array, 0, 5);
            sort($p1_cards);
            $p2_cards = array_slice($tmp_array, 5, 5);
            sort($p2_cards);

            $p1_score = $this->scoreHand($p1_cards);
            $p2_score = $this->scoreHand($p2_cards);
            $p1_wins += $p1_score > $p2_score ? 1 : 0;

            /* // debug
            echo "player 1 scored $p1_score with ".implode(', ', $p1_cards)."\n";
            echo "player 2 scored $p2_score with ".implode(', ', $p2_cards)."\n";
            echo $p1_score > $p2_score ? "player 1 won\n" : "player 2 won\n";
            echo "\n";
            */
        }
        return $p1_wins;
    }

    private function scoreHand($hand) {
        $score = 0;
        $suits = array();
        $values = array();
        foreach ($hand as $card) {
            list($val, $suit) = str_split($card);
            $suits[$suit] = isset($suits[$suit]) ? $suits[$suit] + 1 : 1;
            $values[$val] = isset($values[$val]) ? $values[$val] + 1 : 1;
        }
        arsort($values); // important because we want most common at the top!
        $score = $this->scoreFlushesAndStraights($suits, $values);
        if (!$score) {
            $score = $this->scoreMultiples($values);
        }
        return $score;
    }

    private function isFlush($suits) {
        arsort($suits);
        $common_suit = array_slice($suits, 0, 1);
        return current($common_suit) == 5 ? true : false;
    }

    // generate an array of arrays of straights
    private function getStraights($regular = true, $royal = true) {
        $val_map = array(
            1 => 'A', // not explicitly stated in problem but common in cards
            10 => 'T',
            11 => 'J',
            12 => 'Q',
            13 => 'K',
            14 => 'A'
        );
        $straights = [];
        for ($i = 10; $i >= 1; $i--) {
            $tmp = array();
            for ($j = $i; $j <= $i + 4; $j++) {
                $tmp[] = isset($val_map[$j]) ? $val_map[$j] : $j;
            }
            $straights[] = $tmp;
        }
        if ($regular && $royal) { // all straights
          return $straights;
        } else {
            $royal_straight = array_shift($straights);
            return $royal ? array($royal_straight) : $straights;
        }
    }

    private function isRegularStraight($values) {
        $straights = $this->getStraights(true, false);
        return $this->isStraight($values, $straights);
    }

    private function isRoyalStraight($values) {
        $straights = $this->getStraights(false, true);
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
            if ($found) {return true;}
        }
        return false;
    }

    private function scoreFlushesAndStraights($suits, $values) {
        $is_flush = $this->isFlush($suits);
        $is_reg_straight = $this->isRegularStraight($values);
        $is_royal_straight = $this->isRoyalStraight($values);

        if ($is_flush && $is_royal_straight) {
            return self::POINTS_ROYAL_FLUSH;
        } elseif ($is_reg_straight) {
            return self::POINTS_STRAIGHT + $this->scoreHighCard($values);
        } elseif ($is_flush) {
            return self::POINTS_FLUSH + $this->scoreHighCard($values);
        } else {
            return 0;
        }
    }

    // WARNING! Flushes and Straights need to be tested first!
    private function scoreMultiples($values) {
        $card1_count = current(array_slice($values, 0, 1, true));
        $card2_count = count($values) > 1 ? current(array_slice($values, 1, 1, true)) : 0;
        $card3_count = count($values) > 2 ? current(array_slice($values, 2, 1, true)) : 0;

        if ($card1_count == 4) {
            return self::POINTS_FOUR_KIND + $this->scoreHighCard(array_slice($values, 0, 1, true));
        } elseif ($card1_count == 3 && $card2_count == 2) { // full house
            return self::POINTS_FULL_HOUSE + $this->scoreHighCard(array_slice($values, 0, 1, true));
        } elseif ($card1_count == 3) {
            return self::POINTS_THREE_KIND + $this->scoreHighCard(array_slice($values, 0, 1, true));
        } elseif ($card1_count == 2 && $card2_count == 2) {
            $card1 = array_slice($values, 0, 1, true);
            $card1_value = $this->scoreCard(key($card1));
            $card2 = array_slice($values, 1, 1, true);
            $card2_value = $this->scoreCard(key($card2));
            $card3 = array_slice($values, 2, 1, true);
            $card3_value = $this->scoreCard(key($card3));
            // Tie breaker logic:
            // Make sure a hand like AA,22 beats KK,QQ & AA,KK,2 beats AA,QQ,J
            // Scale lower pair to 1/100th of value so A = 14 & is scaled to .14
            $score = self::POINTS_TWO_PAIRS; // base value
            if ($card1_value > $card2_value) {
                $score += $card1_value > $card2_value ? $card1_value + ($card2_value * .01) : $card2_value + ($card1_value * .01);
            }
            $score += ($card3_value * .001);
            return $score;
        } elseif ($card1_count == 2) {
            $card1 = array_slice($values, 0, 1, true);
            $card1_value = $this->scoreCard(key($card1));
            $card2 = array_slice($values, 1, 1, true);
            $card2_value = $this->scoreCard(key($card2));
            return self::POINTS_TWO_KIND + $card1_value + ($card2_value * .01);
        } else {
            return self::POINTS_HIGH_CARD + $this->scoreHighCard($values);
        }
    }

    private function scoreCard($card) {
        if (isset($this->score_map[$card])) {
            $score = $this->score_map[$card];
        } else {
            $score = $card;
        }
        return $score;
    }

    private function scoreHighCard($values) {
        $max_score = 0;
        foreach($values as $card => $count) {
            $value = $this->scoreCard($card);
            $max_score = $value > $max_score ? $value : $max_score;
        }
        return $max_score;
    }
}
