<?php

declare(strict_types=1);

namespace osu;

class OsuParserIntro extends OsuParser{

	private bool $versionReceived = false;

	public function parse(string $data) : bool{
		if($data === ""){
			return false;
		}

		if($this->versionReceived){
			return true;
		}

		if(preg_match("/osu file format v([0-9]*)/", $data, $matches) > 0){
			$this->osu->osuVer = (int) $matches[1];
			$this->versionReceived = true;
			return false;
		}else{
			throw new \Exception("Thats not osu file format");
		}
	}

	public function next() : OsuParser{
		return new OsuParserColumn($this->osu);
	}
}
