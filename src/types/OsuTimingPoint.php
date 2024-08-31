<?php

declare(strict_types=1);

namespace osu\types;

class OsuTimingPoint{

	public int $time;
	public float $beatLength;
	public int $meter;
	public int $sampleSet;
	public int $sampleIndex;
	public int $volume;
	public int $uninherited;
	public int $effects;

	/**
	 * Timing point syntax:
	 * time,beatLength,meter,sampleSet,sampleIndex,volume,uninherited,effects
	 */
	public function fromParser(
		string $time, string $beatLength,
		string $meter, string $sampleSet,
		string $sampleIndex, string $volume,
		string $uninherited, string $effects
	) : void{
		$this->time = (int) $time;
		$this->beatLength = (float) $beatLength;
		$this->meter = (int) $meter;
		$this->sampleSet = (int) $sampleSet;
		$this->sampleIndex = (int) $sampleIndex;
		$this->volume = (int) $volume;
		$this->uninherited = (int) $uninherited; // always 0 or 1
		$this->effects = (int) $effects;
	}

	public function serialize() : string{
		return implode(",", []); // lazy
	}
}
