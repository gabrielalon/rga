<?php

namespace RGA\Application\Rga\Command;

use RGA\Domain\Model\Rga\Rga\Applicant;
use RGA\Domain\Model\Rga\Rga\Given;
use RGA\Domain\Model\Rga\Rga\Reference;
use RGA\Domain\Model\Source;
use RGA\Infrastructure\SegregationSourcing\Command\Command;

class CreateRga
	implements Command\CommandInterface
{
	use Command\CommandTrait;
	
	/** @var Reference\References */
	private $references;
	
	/** @var Given\Item[] */
	private $items;
	
	/** @var Applicant\Applicant */
	private $applicant;
	
	/** @var Applicant\Address */
	private $address;
	
	/** @var Applicant\Contact */
	private $contact;
	
	/** @var Applicant\Bank */
	private $bank;
	
	/** @var Source\RgaObject */
	private $source;
	
	/**
	 * @param string $uuid
	 * @param Reference\References $references
	 * @param Given\Item[] $items
	 * @param Applicant\Applicant $applicant
	 * @param Applicant\Address $address
	 * @param Applicant\Contact $contact
	 * @param Applicant\Bank $bank
	 * @param Source\RgaObject $source
	 */
	public function __construct(
		string $uuid,
		Reference\References $references,
		array $items,
		Applicant\Applicant $applicant,
		Applicant\Address $address,
		Applicant\Contact $contact,
		Applicant\Bank $bank,
		Source\RgaObject $source
	)
	{
		$this->setIdentifier($uuid);
		$this->references = $references;
		$this->items = $items;
		$this->applicant = $applicant;
		$this->address = $address;
		$this->contact = $contact;
		$this->bank = $bank;
		$this->source = $source;
	}
	
	/**
	 * @return Reference\References
	 */
	public function getReferences(): Reference\References
	{
		return $this->references;
	}
	
	/**
	 * @return Given\Item[]
	 */
	public function getItems(): array
	{
		return $this->items;
	}
	
	/**
	 * @return Applicant\Applicant
	 */
	public function getApplicant(): Applicant\Applicant
	{
		return $this->applicant;
	}
	
	/**
	 * @return Applicant\Address
	 */
	public function getAddress(): Applicant\Address
	{
		return $this->address;
	}
	
	/**
	 * @return Applicant\Contact
	 */
	public function getContact(): Applicant\Contact
	{
		return $this->contact;
	}
	
	/**
	 * @return Applicant\Bank
	 */
	public function getBank(): Applicant\Bank
	{
		return $this->bank;
	}
	
	/**
	 * @return Source\RgaObject
	 */
	public function getSource(): Source\RgaObject
	{
		return $this->source;
	}
}