<?php

namespace osu;

class OsuObject{

	public int $x;
	public int $y;
	public int $timing;

	public string $n1;
	public string $n2;
	public string $n3;

	public function fromParser(string $x, string $y, string $timing, string $n1, string $n2, string $n3) : void{
		$this->x = (int) $x;
		$this->y= (int) $y;
		$this->timing = (int) $timing;
		$this->n1 = $n1;
		$this->n2 = $n2;
		$this->n3 = $n3;
	}

	public function serialize() : string{
		return implode(",", [
			$this->x, $this->y, $this->timing,
			$this->n1, $this->n2, $this->n3
		]);
	}
}
