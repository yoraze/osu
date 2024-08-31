<?php

declare(strict_types=1);

namespace osu\types;

class OsuProperties{

	public array $properties = [];

	public function parseRow(string $data) : void{
		if(preg_match("/(.*)\\:(.*)/", $data, $matchs) > 0){
			$name = trim(ltrim($matchs[1]));
			$value = trim(ltrim($matchs[2]));
			if(is_numeric($value)){
				$value = (float) $value;
				if(round($value) === $value){
					$value = (int) $value;
				}
			}

			$this->properties[$name] = $value;
			return;
		}

		throw new \InvalidArgumentException("Invalid data provided: $data");
	}

	public function serialize() : string{
		return implode("\n", array_map(
			fn(string $key, string $val) : string => "$key: $val",
			array_keys($this->properties), array_values($this->properties)
		));
	}
}
