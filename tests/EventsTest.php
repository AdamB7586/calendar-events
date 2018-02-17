<?php

namespace Calendar\Tests;

use PHPUnit\Framework\TestCase;
use Calendar\Events;
use DBAL\Database;

class EventsTest extends TestCase{
    
    protected $dbc;
    protected $events;
    
    public function setUp() {
        $this->dbc = new Database($GLOBALS['HOSTNAME'], $GLOBALS['USERNAME'], $GLOBALS['PASSWORD'], $GLOBALS['DATABASE']);
        $this->events = new Events($this->dbc);
    }
    
    public function tearDown() {
        unset($this->dbc);
        unset($this->events);
    }
    
    public function testExample(){
        $this->markTestIncomplete('This test has not yet been implemented');
    }
    
}
