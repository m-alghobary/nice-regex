<?php

namespace NiceRegex;

use Exception;

class Regex
{
	private array $tokens = [];
	private array $flags = [];

	public function __construct(array $flags = [])
	{
		$this->flags = $flags;
	}

	public function exactly(string $term): self
	{
		$this->tokens[] = $term;
		return $this;
	}

	public function digits(int $count = 0): self
	{
		$token = $count === 0 ? '\d' : '\d{' . $count . '}';
		$this->tokens[] = $token;

		return $this;
	}

	public function in(array $chars): self
	{
		$set = '[' . implode('', $chars) . ']';
		$this->tokens[] = $set;

		return $this;
	}

	public function notIn(array $chars): self
	{
		$set = '[^' . implode('', $chars) . ']';
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

	public function range(int $min, int $max): self
	{
		if (!($min < $max)) {
			throw new Exception('min value should be less than max value');
		}

		$this->tokens[] = '{' . $min . ',' . $max . '}';
		return $this;
	}

	public function build(): string
	{
		$flags_str = implode('', $this->flags);
		$tokens_str = implode('', $this->tokens);

		// empty the token list
		$this->tokens = [];

		return '/' . $tokens_str . '/' . $flags_str;
	}
}
