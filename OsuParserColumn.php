<?php

declare(strict_types=1);

namespace osu;

class OsuParserColumn extends OsuParser{

	/** @var string */
	private $name = null;
	/** @var string[] */
	private $rawData = [];

	public function parse(string $data) : bool{
		if($data === ""){
			$this->finish();
			return true;
		}

		if($this->name === null){
			if(preg_match("/\\[(.*)\\]/", $data, $matches) > 0){
				$this->name = $matches[1];
			}else{
				throw new \Exception("Cant figure out what this column is");
			}
		}else{
			if(substr($data, 0, 2) === "//"){
				return false; // Comment (noway)
			}

			$this->rawData[] = $data;
		}

		return false;
	}

	private function finish() : void{
		if($this->name === null){
			return; // empty lines lol
		}

		switch($this->name){
			case "General":
				break;
			case "Editor":
				break;
			case "Metadata":
				break;
			case "Difficulty":
				break;
			case "Events":
				break;
			case "TimingPoints":
				break;
			case "HitObjects":
				$this->osu->objects = [];
				foreach($this->rawData as $row){
					$obj = new OsuObject;
					$obj->fromParser(...explode(",", $row));
					$this->osu->objects[] = $obj;
				}
				break;
		}
	}

	public function next() : self{
		return new OsuParserColumn($this->osu);
	}
}
