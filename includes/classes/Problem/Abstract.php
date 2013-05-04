<?php
/**
 * Abstract Base Class for Problems
 *
 * @category ProjectEuler
 * @package Problem
 * @author Michael Reeves <mike.reeves@gmail.com>
 * @link http://projecteuler.net
 *
 */

abstract class Problem_Abstract {

    abstract protected function execute();

    private $_timerArray = array('DEFAULT' => 0);

    protected function timerStart($timerName = 'DEFAULT'){

    }

    protected function timerStop($timerName = 'DEFAULT'){

    }

    protected function timerGet($timerName = 'DEFAULT'){

    }

    protected function timerGetAll(){

    }

    protected function getServerInfo(){

    }

    protected function logInfo($data){

    }
}