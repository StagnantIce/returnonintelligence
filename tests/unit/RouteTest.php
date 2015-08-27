<?php

require_once __DIR__ . '/../../config.php';

class AftTest extends PHPUnit_Framework_TestCase {

    protected function setUp() {
        $this->assertQualityStart();
    }

    protected function tearDown()
    {
        $this->assertQualityEnd();
    }

    public function testPosition() {
        $point = array(0,0,'N');
        $p = Position::fromArray($point);
        $compasses = array('E', 'S', 'W', 'N');
        foreach($compasses as $letter) {
            $p->right();
            $this->assertEquals($p->compass, $letter);
        }
        $compasses = array('W', 'S', 'E', 'N');
        foreach($compasses as $letter) {
            $p->left();
            $this->assertEquals($p->compass, $letter);
        }
        $compasses = array('E', 'S', 'W', 'N');
        foreach($compasses as $letter) {
            $p->right();
            $x = $p->x;
            $y = $p->y;
            $p->move();
            switch($p->compass) {
                case 'N':
                    $this->assertEquals($y + 1, $p->y);
                break;
                case 'W':
                    $this->assertEquals($x - 1, $p->x);
                break;
                case 'S':
                    $this->assertEquals($y - 1, $p->y);
                break;
                case 'E':
                    $this->assertEquals($x + 1, $p->x);
                break;
            }
        }
    }

    public function assertQualityStart($time_limit = 0.05, $memory_limit = 200) {
        $this->memory_limit = $memory_limit;
        $this->time_limit = $time_limit;
        $this->memory = memory_get_usage();
        $this->time = microtime();
    }

    public function assertQualityEnd() {
        $memory = (memory_get_usage() - $this->memory) / 1024;
        $time = microtime() - $this->time;
        $this->assertTrue( $memory < $this->memory_limit, "Memory usage more {$this->memory_limit} Кб: " . $memory );
        $this->assertTrue( $time < $this->time_limit, "Time usage, more {$this->time_limit} sec: " . $time );
    }
}