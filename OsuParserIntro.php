<?php

declare(strict_types=1);

namespace osu;

class OsuParserIntro extends OsuParser{
	public function parse(string $data) : bool{
		if($data === ""){
			return true;
		}

		if(preg_match("/osu file format v([0-9]*)/", $data, $matches) > 0){
			$this->osu->osuVer = (int) $matches[1];
		}else{
			throw new \Exception("Thats not osu file format");
		}

		return false;
	}

	public function next() : OsuParser{
		return new OsuParserColumn($this->osu);
	}
}
