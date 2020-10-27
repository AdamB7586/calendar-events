<?php

namespace Calendar\Tests;

use PHPUnit\Framework\TestCase;
use Calendar\Events;
use DBAL\Database;

class EventsTest extends TestCase
{
    
    protected $db;
    protected $events;
    
    public function setUp(): void
    {
        $this->db = new Database($GLOBALS['HOSTNAME'], $GLOBALS['USERNAME'], $GLOBALS['PASSWORD'], $GLOBALS['DATABASE']);
        $this->events = new Events($this->db);
    }
    
    public function tearDown(): void
    {
        unset($this->db);
        unset($this->events);
    }
    
    public function testExample()
    {
        $this->markTestIncomplete('This test has not yet been implemented');
    }
}
