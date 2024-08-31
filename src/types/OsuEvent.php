<?php

declare(strict_types=1);

namespace osu\types;

class OsuEvent{

	public int $eventType;
	public int $startTime;
	public array $eventParams;

	public function fromParser(string $eventType, string $startTime, string ...$eventParams) : void{
		$this->eventType = (int) $eventType;
		$this->startTime = (int) $startTime;
		$this->eventParams = $eventParams;
	}

	//TODO: Proper EventParams decode

	public function serialize() : string{
		return implode(",", [
			$this->eventType, $this->startTime, $this->eventParams
		]);
	}
}
