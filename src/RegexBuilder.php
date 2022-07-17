<?php

namespace NiceRegex;

class RegexBuilder
{
	private array $flags = [];

	public function isGlobal(): self
	{
		$this->flags[] = 'g';
		return $this;
	}

	public function isMultiLine(): self
	{
		$this->flags[] = 'm';
		return $this;
	}

	public function isCaseInsensitive(): self
	{
		$this->flags[] = 'i';
		return $this;
	}

	public function isUnicode(): self
	{
		$this->flags[] = 'u';
		return $this;
	}

	public function make()
	{
		return new Regex($this->flags);
	}
}
