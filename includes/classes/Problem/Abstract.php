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

abstract class Problem_Abstract
{

    abstract protected function execute();

    /**
     * Project Euler says each problem should take no more than 1 minute. If your computer is slow make this larger.
     * $const int PROBLEM_TIMEOUT Used with set_timeout_limit to throw a timeout if problem computation takes too long.
     */
    const PROBLEM_TIMEOUT = 60;
    const TIMER_STATUS_STARTED = 1;
    const TIMER_STATUS_STOPPED = 0;

    private $_timerArray = array('DEFAULT' => 0);
    private $_timerStatus = self::TIMER_STATUS_STOPPED;

    public function __construct()
    {
        set_time_limit(self::PROBLEM_TIMEOUT);
    }

    // TODO: Add timer, server and logging functionality
    protected function timerStart($timerName = 'DEFAULT')
    {

    }

    protected function timerStop($timerName = 'DEFAULT')
    {

    }

    protected function timerGet($timerName = 'DEFAULT')
    {

    }

    protected function timerGetAll()
    {

    }

    protected function getServerInfo()
    {

    }

    protected function logInfo($data)
    {

    }
}
