<?php

class Route implements ArrayAccess {

	public static $commands = array('R', 'L', 'M');
	private $route = '';

	public function __construct($route) {
		if (!is_string($route) && str_replace(self::$commands, '', $route) !== '') {
			throw new Exception("Error route");
		}
		$this->route = str_split($route);
	}

    //  ArrayAccess interface
    public function offsetExists ($offset) {
        return array_key_exists($offset, $this->route);
    }

    public function offsetGet ($offset) {
        return $this->route[$offset];
    }

    public function offsetSet ($offset, $value) {
        $this->route[$offset] = $value;
    }

    public function offsetUnset ($offset) {
        unset($this->route[$offset]);
    }
}