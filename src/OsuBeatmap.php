<?php

declare(strict_types=1);

namespace osu;

use osu\types\OsuEvent;
use osu\types\OsuObject;
use osu\types\OsuProperties;
use osu\types\OsuTimingPoint;

class OsuBeatmap{

	public static function fromFile(string $filepath) : self{
		return self::fromString(file_get_contents($filepath));
	}

	public static function fromString(string $data) : self{
		$osu = new self();
		$osu->parse($data);
		return $osu;
	}

	public int $osuVer;
	public OsuProperties $general;
	public OsuProperties $editor;
	public OsuProperties $metadata;
	public OsuProperties $difficulty;
	/** @var OsuEvent[] */
	public array $events;
	/** @var OsuTimingPoint[] */
	public array $timings;
	/** @var OsuObject[] */
	public array $objects;

	protected function __construct(){
		//NOOP
	}

	public function parse(string $data) : void{
		$rawOsuData = $data;
		$osuDataColumns = explode("\n", $data);
		$parser = new OsuParserIntro($this);

		for($indx = 0; $indx < count($osuDataColumns); $indx++){
			$line = trim(ltrim($osuDataColumns[$indx]));
			repeat:
			if($parser->parse($line)){
				$parser = $parser->next();
				goto repeat;
			}
		}

		$parser->finish();
	}

	public function serialize() : string{
		return ""; //TODO
	}
}
