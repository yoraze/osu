<?php

declare(strict_types=1);

namespace osu;

abstract class OsuParser{

	protected OsuBeatmap $osu;

	public function __construct(OsuBeatmap $osu){
		$this->osu = $osu;
	}

	public abstract function parse(string $data) : bool;

	public abstract function next() : OsuParser;
}
