<?php

namespace Calendar\Tests;

use PHPUnit\Framework\TestCase;
use Calendar\Export;
use DBAL\Database;

class ExportTest extends TestCase{
    
    protected $dbc;
    protected $export;
    
    public function setUp() {
        $this->dbc = new Database($GLOBALS['HOSTNAME'], $GLOBALS['USERNAME'], $GLOBALS['PASSWORD'], $GLOBALS['DATABASE']);
        $this->export = new Export($this->dbc);
    }
    
    public function tearDown() {
        unset($this->dbc);
        unset($this->export);
    }
    
    public function testExample(){
        $this->markTestIncomplete('This test has not yet been implemented');
    }
    
}
