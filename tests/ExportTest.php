<?php

namespace Calendar\Tests;

use PHPUnit\Framework\TestCase;
use Calendar\Export;
use DBAL\Database;

class ExportTest extends TestCase
{
    
    protected $db;
    protected $export;
    
    public function setUp(): void
    {
        $this->db = new Database($GLOBALS['HOSTNAME'], $GLOBALS['USERNAME'], $GLOBALS['PASSWORD'], $GLOBALS['DATABASE']);
        $this->export = new Export($this->db);
    }
    
    public function tearDown(): void
    {
        unset($this->db);
        unset($this->export);
    }
    
    public function testExample()
    {
        $this->markTestIncomplete('This test has not yet been implemented');
    }
}
