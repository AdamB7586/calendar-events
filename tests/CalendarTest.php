<?php

namespace Calendar\Tests;

use PHPUnit\Framework\TestCase;
use Calendar\Calendar;
use DBAL\Database;

class CalendarTest extends TestCase
{
    
    protected $db;
    protected $calendar;
    
    public function setUp(): void
    {
        $this->db = new Database($GLOBALS['HOSTNAME'], $GLOBALS['USERNAME'], $GLOBALS['PASSWORD'], $GLOBALS['DATABASE']);
        $this->calendar = new Calendar($this->db);
    }
    
    public function tearDown(): void
    {
        unset($this->db);
        unset($this->calendar);
    }
    
    /**
     * @covers Calendar\Calendar::hoursDropdown
     * @covers Calendar\Calendar::minutesDropdown
     */
    public function testExample()
    {
        $hoursDD = $this->calendar->hoursDropdown('hours', 16, 24, 6);
        $this->assertStringStartsWith('<select', $hoursDD);
        
        $minutesDD = $this->calendar->minutesDropdown('minutes', 15);
        $this->assertStringStartsWith('<select', $minutesDD);
    }
}
