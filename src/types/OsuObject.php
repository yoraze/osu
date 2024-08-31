<?php

declare(strict_types=1);

namespace osu\types;

class OsuObject{

	public const TYPE_CIRCLE = 0;
	public const TYPE_SLIDER = 1;
	public const TYPE_NEW_COMBO = 2;
	public const TYPE_SPINNER = 3;
	public const TYPE_UNK4 = 4;
	public const TYPE_UNK5 = 5;
	public const TYPE_UNK6 = 6;
	public const TYPE_MANIA_LN = 7;

	public int $x;
	public int $y;
	public int $time;
	public int $type;
	public int $hitSound;
	public string $objectParams;
	public string $hitSample;

	// x,y,time,type,hitSound,objectParams,hitSample

	public function fromParser(
		string $x, string $y,
		string $timing, string $type, string $hitSound,
		string $objectParams
	) : void{
		$this->x = (int) $x;
		$this->y = (int) $y;
		$this->time = (int) $time;
		$this->type = (int) $type;
		$this->hitSound = (int) $hitSound;
		$this->objectParams = $objectParams;
		$this->hitSample = $hitSample;
	}

	public function serialize() : string{
		return implode(",", []); //TODO: lazy
	}
}
