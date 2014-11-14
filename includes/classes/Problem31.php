<?php
/**
 * Project Euler - Problem 31
 *
 * Coin sums
 *
 * In England the currency is made up of pound, £, and pence, p, and there are eight coins in general circulation:
 * 1p, 2p, 5p, 10p, 20p, 50p, £1 (100p) and £2 (200p).
 * It is possible to make £2 in the following way:
 * 1£1 + 150p + 220p + 15p + 12p + 31p
 * How many different ways can £2 be made using any number of coins? 
 *
 * @category ProjectEuler
 * @package Problem31
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net/problem=31
 *
 */
class Problem31 extends Problem_Abstract
{
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
        $coins = array(200,100,50, 20, 10, 5, 2, 1);
        $money = 200; // aka 2 english pounds
 
        return $this->countChange($money, $coins);
    }

    /**
     * Count how many different ways you can make change with this much money and these values of coins
     *
     * @param int $money Amount of money in cents that we will make change from
     * @param array $coins Array of coin values we can use to make change
     *
     * @return int Number of different ways we can make change
     */

    private function countChange($money, $coins) {
        // echo "money: $money, coins: ".implode(",", $coins)."\n"; // debug  
        if ($money == 0) {
            return 1;
        } elseif (!empty($coins) && $money > 0) {
            $coins_orig = $coins; // Original set of coins
            $coin_last = array_pop($coins); // Now coins has had the last (smallest) element popped off
            return $this->countChange($money - $coin_last, $coins_orig) + $this->countChange($money, $coins);
        } else {
            return 0;
        }
    }
}
