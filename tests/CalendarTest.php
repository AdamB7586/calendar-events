<?php

namespace Calendar\Tests;

use PHPUnit\Framework\TestCase;
use Calendar\Calendar;
use DBAL\Database;

class CalendarTest extends TestCase{
    
    protected $dbc;
    protected $calendar;
    
    public function setUp() {
        $this->dbc = new Database($GLOBALS['HOSTNAME'], $GLOBALS['USERNAME'], $GLOBALS['PASSWORD'], $GLOBALS['DATABASE']);
        $this->calendar = new Calendar($this->dbc);
    }
    
    public function tearDown() {
        unset($this->dbc);
        unset($this->calendar);
    }
    
    public function testExample(){
        $this->markTestIncomplete('This test has not yet been implemented');
    }
    
}