<?php

declare(strict_types=1);

namespace osu;

use osu\types\OsuEvent;
use osu\types\OsuObject;
use osu\types\OsuProperties;
use osu\types\OsuTimingPoint;

class OsuParserColumn extends OsuParser{

	private ?string $name = null;
	/** @var string[] */
	private array $rawData = [];

	public function parse(string $data) : bool{
		static $columnNamePattern = "/\\[(.*)\\]/";
		if($data === ""){
			return false; // Empty line
		}elseif(strlen($data) >= 2 and substr($data, 0, 2) === "//"){
			return false; // Comment (noway)
		}

		if($this->name === null){
			if(preg_match($columnNamePattern, $data, $matches) > 0){
				$this->name = $matches[1];
			}else{
				throw new \Exception("Cant figure out what this column is");
			}
		}else{
			if(preg_match($columnNamePattern, $data) > 0){
				$this->finish();
				return true;
			}

			$this->rawData[] = $data;
		}

		return false;
	}

	public function finish() : void{
		if($this->name === null){
			return; // empty lines lol
		}

		switch($this->name){
			case "General":
				$this->osu->general = $this->propertiesRow();
				break;
			case "Editor":
				$this->osu->editor = $this->propertiesRow();
				break;
			case "Metadata":
				$this->osu->metadata = $this->propertiesRow();
				break;
			case "Difficulty":
				$this->osu->difficulty = $this->propertiesRow();
				break;
			case "Events":
				$this->osu->events = $this->listRow(OsuEvent::class);
				break;
			case "TimingPoints":
				$this->osu->timings = $this->listRow(OsuTimingPoint::class);
				break;
			case "HitObjects":
				$this->osu->objects = $this->listRow(OsuObject::class);
				break;
		}
	}

	private function propertiesRow() : OsuProperties{
		$properties = new OsuProperties();
		foreach($this->rawData as $row){
			$properties->parseRow($row);
		}
		return $properties;
	}

	private function listRow(string $classtype) : array{
		$list = [];
		foreach($this->rawData as $row){
			$obj = new $classtype;
			$obj->fromParser(...explode(",", $row));
			$list[] = $obj;
		}
		return $list;
	}

	public function next() : self{
		return new OsuParserColumn($this->osu);
	}
}
