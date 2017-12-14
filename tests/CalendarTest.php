<?php

namespace Calendar\Tests;

use PHPUnit\Framework\TestCase;
use Calendar\Calendar;
use DBAL\Database;

class CalendarTest extends TestCase{
    
    protected $dbc;
    protected $calendar;
    
    public function setUp() {
        $this->dbc = new Database('localhost', 'username', 'password', 'calendar_db', false, false, false, 'sqlite');
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