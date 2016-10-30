<?php declare(strict_types = 1);

namespace PHPStan\Type;

class StaticType implements Type
{

	/** @var bool */
	private $nullable;

	public function __construct(bool $nullable)
	{
		$this->nullable = $nullable;
	}

	/**
	 * @return string|null
	 */
	public function getClass()
	{
		return null;
	}

	public function isNullable(): bool
	{
		return $this->nullable;
	}

	public function combineWith(Type $otherType): Type
	{
		return new self($this->isNullable() || $otherType->isNullable());
	}

	public function makeNullable(): Type
	{
		return new self(true);
	}

	public function equals(Type $type): bool
	{
		return $type instanceof self && $this->isNullable() === $type->isNullable();
	}

}
