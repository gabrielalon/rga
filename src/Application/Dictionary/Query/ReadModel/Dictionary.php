<?php

namespace RGA\Application\Dictionary\Query\ReadModel;

use RGA\Domain\Model\Dictionary\Dictionary as VO;
use RGA\Infrastructure\SegregationSourcing;

class Dictionary
	implements SegregationSourcing\Query\Query\Viewable
{
	/** @var VO\Uuid */
	private $identifier;
	
	/** @var VO\Type */
	private $type;
	
	/** @var VO\Entries */
	private $entries;
	
	/** @var VO\BehavioursUuid */
	protected $behaviours;
	
	/**
	 * @param string $identifier
	 */
	public function __construct(string $identifier)
	{
		$this->setIdentifier(VO\Uuid::fromString($identifier));
	}
	
	/**
	 * @param string $uuid
	 * @return Dictionary
	 */
	public static function fromUuid(string $uuid): self
	{
		return new static($uuid);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function identifier()
	{
		return $this->identifier->toString();
	}
	
	/**
	 * @param VO\Uuid $identifier
	 * @return Dictionary
	 */
	public function setIdentifier(VO\Uuid $identifier): Dictionary
	{
		$this->identifier = $identifier;
		
		return $this;
	}
	
	/**
	 * @return VO\Uuid
	 */
	public function getIdentifier(): VO\Uuid
	{
		return $this->identifier;
	}
	
	/**
	 * @return string
	 */
	public function type(): string
	{
		return $this->type->toString();
	}
	
	/**
	 * @param VO\Type $type
	 * @return Dictionary
	 */
	public function setType(VO\Type $type): Dictionary
	{
		$this->type = $type;
		
		return $this;
	}
	
	/**
	 * @return VO\Type
	 */
	public function getType(): VO\Type
	{
		return $this->type;
	}
	
	/**
	 * @param string $locale
	 * @return string
	 */
	public function entry(string $locale): string
	{
		return $this->entries->getLocale($locale)->toString();
	}
	
	/**
	 * @return array
	 */
	public function entries(): array
	{
		return $this->entries->raw();
	}
	
	/**
	 * @param string $locale
	 * @param string $entry
	 * @return Dictionary
	 */
	public function addEntry(string $locale, string $entry): Dictionary
	{
		if (null === $this->entries)
		{
			$this->setEntries(VO\Entries::fromArray([
				$locale => $entry
			]));
		}
		else
		{
			$this->entries->addLocale($locale, $entry);
		}
		
		return $this;
	}
	
	/**
	 * @param VO\Entries $entries
	 * @return Dictionary
	 */
	public function setEntries(VO\Entries $entries): Dictionary
	{
		$this->entries = $entries;
		
		return $this;
	}
	
	/**
	 * @return VO\Entries
	 */
	public function getEntries(): VO\Entries
	{
		return $this->entries;
	}
	
	/**
	 * @return array
	 */
	public function behaviours(): array
	{
		return $this->behaviours->all();
	}
	
	/**
	 * @param string $uuid
	 * @return Dictionary
	 */
	public function addBehaviour(string $uuid): Dictionary
	{
		if (null === $this->behaviours)
		{
			$this->setBehaviours(VO\BehavioursUuid::fromArray([$uuid]));
		}
		else
		{
			$this->behaviours->addUuid($uuid);
		}
		
		return $this;
	}
	
	/**
	 * @param VO\BehavioursUuid $behaviours
	 * @return Dictionary
	 */
	public function setBehaviours(VO\BehavioursUuid $behaviours): Dictionary
	{
		$this->behaviours = $behaviours;
		
		return $this;
	}
	
	/**
	 * @return VO\BehavioursUuid
	 */
	public function getBehaviours(): VO\BehavioursUuid
	{
		return $this->behaviours;
	}
}