<?php

declare(strict_types=1);

namespace osu;

class OsuBeatmap{
	public static function fromFile(string $filepath) : self{
		return self::fromString(file_get_contents($filepath));
	}

	public static function fromString(string $data) : self{
		$osu = new self();
		$osu->parse($data);
		return $osu;
	}

	/** @var int */
	public $osuVer;
	/** @var OsuObject[] */
	public $objects;

	protected function __construct(){
		//NOOP
	}

	public function parse(string $data) : void{
		$rawOsuData = $data;
		$osuDataColumns = explode("\n", $data);
		$parser = new OsuParserIntro($this);

		for($indx = 0; $indx < count($osuDataColumns); $indx++){
			$line = trim(ltrim($osuDataColumns[$indx]));
			if($parser->parse($line)){
				$parser = $parser->next();
			}
		}
	}
}
