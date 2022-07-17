<?php

namespace NiceRegex;

class Regex
{
	private array $tokens = [];
	private array $flags = [];

	public function __construct(array $flags = [])
	{
		$this->flags = $flags;
	}

	public function in(array $chars): self
	{
		$set = "[" . implode('', $chars) . "]";
		$this->tokens[] = $set;

		return $this;
	}

	public function notIn(array $chars): self
	{
		$set = "[^" . implode('', $chars) . "]";
		$this->tokens[] = $set;

		return $this;
	}

	public function zeroOrOneTimes(): self
	{
		$this->tokens[] = '?';
		return $this;
	}

	public function zeroOrMoreTimes(): self
	{
		$this->tokens[] = '*';
		return $this;
	}

	public function oneOrMoreTimes(): self
	{
		$this->tokens[] = '+';
		return $this;
	}

	public function or(): self
	{
		$this->tokens[] = '|';
		return $this;
	}

	public function times(int $times): self
	{
		$this->tokens[] = '{' . $times . '}';
		return $this;
	}

	public function build(): string
	{
		$flags_str = implode('', $this->flags);
		$tokens_str = implode('', $this->tokens);

		return '/' . $tokens_str . '/' . $flags_str;
	}
}
