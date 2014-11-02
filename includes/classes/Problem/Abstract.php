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

    private $t1;
    private $t2;

    private $_timerArray = array('DEFAULT' => 0);
    private $_timerStatus = array('DEFAULT' => self::TIMER_STATUS_STOPPED);

    public function __construct()
    {
        $this->t1 = microtime(true);
        set_time_limit(self::PROBLEM_TIMEOUT);
    }

    public function __destruct()
    {
        $this->t2 = microtime(true);
        $totalTime = $this->t2 - $this->t1;
        echo "Took ".round($totalTime, 4)." seconds<br/>\n";
        echo "Used ".round((memory_get_peak_usage()/(pow(1024,2))),2)." megabytes of memory<br/>\n";
    }

    protected function overrideTimeoutAndMemoryLimit($time, $memory = '64M') {
        set_time_limit($time);
        ini_set('memory_limit', $memory);
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
        // also things like: memory_get_peak_usage
        // some ideas:
        // http://serverfault.com/questions/112542/how-can-i-get-processor-ram-disk-specs-from-the-linux-command-line
    }

    protected function logInfo($data)
    {

    }
}
