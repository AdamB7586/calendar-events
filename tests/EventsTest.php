<?php

namespace Calendar\Tests;

use PHPUnit\Framework\TestCase;
use Calendar\Events;
use DBAL\Database;

class EventsTest extends TestCase{
    
    protected $dbc;
    protected $events;
    
    public function setUp() {
        $this->dbc = new Database('localhost', 'username', 'password', 'calendar_db', false, false, false, 'sqlite');
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
