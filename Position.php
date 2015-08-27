<?php

class Position {

	public $x;
	public $y;
	public $compass;
	public static $compasses = array('N', 'E', 'S', 'W');

	public function __construct($x=0, $y=0, $compass='N') {
		$this->x = intval($x);
		$this->y = intval($y);
		$this->compass = $compass;

		if (!$this->isValid()) {
			throw new Exception("Error position");
		}
	}

	public static function fromArray(Array $position) {
		if (count($position) !== 3) {
			throw new Exception("Expect 3 coordinates");
		}
		return new self($position[0], $position[1], $position[2]);
	}

	public function isValid() {
		if (!in_array($this->compass, self::$compasses)) {
			return false;
		}
		return true;
	}

	public function right() {
		$next = false;
		foreach(self::$compasses as $letter) {
			if ($this->compass == $letter) {
				$next = current(self::$compasses);
			}
		}
		$this->compass = $next ? $next: self::$compasses[0];
	}

	public function left() {
		$prev = false;
		foreach(self::$compasses as $letter) {
			if ($this->compass == $letter) {
				break;
			}
			$prev = $letter;
		}
		$this->compass = $prev ? $prev : self::$compasses[count(self::$compasses) - 1];
	}

	public function move() {
		switch($this->compass) {
			case 'N':
				$this->y += 1;
			break;
			case 'S':
				$this->y -= 1;
			break;
			case 'W':
				$this->x -= 1;
			break;
			case 'E':
				$this->x += 1;
			break;
		}
	}

	public function __toString() {
		return "{$this->x} {$this->y} {$this->compass}\n";
	}
}