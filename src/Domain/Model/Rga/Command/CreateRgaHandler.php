<?php

namespace RGA\Domain\Model\Rga\Command;

use Ramsey\Uuid\Uuid;
use RGA\Domain\Model\Attachment;
use RGA\Domain\Model\Rga\Integration;
use RGA\Domain\Model\Rga\Rga;
use RGA\Infrastructure\Persist;
use RGA\Infrastructure\SegregationSourcing\Aggregate;
use RGA\Infrastructure\SegregationSourcing\Command;
use RGA\Infrastructure\SegregationSourcing\Message;

class CreateRgaHandler
	implements Command\CommandHandling\CommandHandlerInterface
{
	/** @var Aggregate\Persist\AggregateRepositoryTranslator */
	private $repositoryTranslator;
	
	/** @var Integration\Warranty\Calculator */
	private $warrantyCalculator;
	
	public function __construct(
		Persist\Rga\RgaRepository $rgaRepository,
		Persist\Attachment\AttachmentRepository $attachmentRepository,
		Integration\Warranty\Calculator $warrantyCalculator
	)
	{
		$this->repositoryTranslator = new Aggregate\Persist\AggregateRepositoryTranslator();
		$this->repositoryTranslator->register($rgaRepository);
		$this->repositoryTranslator->register($attachmentRepository);
		
		$this->warrantyCalculator = $warrantyCalculator;
	}
	
	/**
	 * @return Aggregate\Persist\AggregateRepositoryTranslator
	 */
	protected function getRepositoryTranslator(): Aggregate\Persist\AggregateRepositoryTranslator
	{
		return $this->repositoryTranslator;
	}
	
	/**
	 * @return Integration\Warranty\Calculator
	 */
	protected function getWarrantyCalculator(): Integration\Warranty\Calculator
	{
		return $this->warrantyCalculator;
	}
	
	/**
	 * @param Message\Domain\MessageInterface|CreateRga $message
	 */
	public function run(Message\Domain\MessageInterface $message): void
	{
		foreach ($message->getItems() as $item)
		{
			$rga = Rga::createNewRga(
				Rga\Uuid::fromString($message->getUuid()),
				$message->getReferences(),
				$item,
				$message->getApplicant(),
				$message->getAddress(),
				$message->getContact(),
				$message->getBank(),
				$message->getSource(),
				$this->getWarrantyCalculator()
			);
			
			$this->getRepositoryTranslator()->record($rga);
			
			$this->handleAttachments($message, $item);
		}
	}
	
	/**
	 * @param CreateRga $message
	 * @param Rga\Given\Item $item
	 */
	private function handleAttachments(CreateRga $message, Rga\Given\Item $item): void
	{
		foreach ($item->getAttachments() as $a)
		{
			$attachment = Attachment\Attachment::createNewAttachment(
				Attachment\Attachment\Uuid::fromString(Uuid::uuid4()->toString()),
				Attachment\Attachment\RgaUuid::fromString($message->getUuid()),
				Attachment\Attachment\FileType::fromString($a->getFileType()),
				Attachment\Attachment\FileName::fromString($a->getFileName()),
				Attachment\Attachment\OriginalFileName::fromString($a->getFileOriginalName())
			);
			
			$this->getRepositoryTranslator()->record($attachment);
		}
	}
}