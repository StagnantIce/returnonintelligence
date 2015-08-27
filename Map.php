<?php

class Map {

	private $left = 0;
	private $bottom = 0;
	private $right = 0;
	private $top = 0;

	public function __construct($top, $right, $bottom=0, $left=0) {
		$this->left = intval($left);
		$this->right = intval($right);
		$this->bottom = intval($bottom);
		$this->top = intval($top);
		if (!$this->isValid()) {
			throw new Exception("Error map");
		}
	}

	public function isValid() {
		if ($this->top <= $this->bottom || $this->right <= $this->left) {
			return false;
		}
		return true;
	}

	public function isValidPosition($x, $y) {
		if ($x < $this->left || $x > $this->right || $y < $this->bottom || $y > $this->top) {
			throw new Exception("Error moving $x $y ");
		}
		return true;
	}

	public function buildRoute(Position $position, Route $route) {
		$i = 0;
		while ($this->isValidPosition($position->x, $position->y)) {
			if (!isset($route[$i])) {
				break;
			}
			switch($route[$i]) {
				case 'R':
					$position->right();
				break;
				case 'L':
					$position->left();
				break;
				case 'M':
					$position->move();
				break;
			}
			$i += 1;
		}
	}
}