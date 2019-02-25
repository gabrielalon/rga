<?php

namespace RGA\Application\Rga\Command\CommandHandling;

use Psr\Container\ContainerInterface;
use RGA\Application\Rga\Command;
use RGA\Application\Rga\Integration;
use RGA\Infrastructure\Persist\Additional\AdditionalRepository;
use RGA\Infrastructure\Persist\Attachment\AttachmentRepository;
use RGA\Infrastructure\Persist\Rga\RgaRepository;
use RGA\Infrastructure\SegregationSourcing\Command\CommandHandling;

class CommandBusFactory
	extends CommandHandling\AbstractCommandBusFactory
{
	/**
	 * @param CommandHandling\CommandBus $commandBus
	 * @param ContainerInterface $container
	 */
	public function populate(CommandHandling\CommandBus $commandBus, ContainerInterface $container): void
	{
		/** @var RgaRepository $rgaRepository */
		$rgaRepository = $container->get(RgaRepository::class);
		/** @var AttachmentRepository $attachmentRepository */
		$attachmentRepository = $container->get(AttachmentRepository::class);
		/** @var AdditionalRepository $additionalRepository */
		$additionalRepository = $container->get(AdditionalRepository::class);
		/** @var Integration\Warranty\Calculator $warrantyCalculator */
		$warrantyCalculator = $container->get(Integration\Warranty\Calculator::class);
		
		$this->commandRouter
			->route(Command\ChangeApplicantRga::class)
			->to(new Command\ChangeApplicantRgaHandler($rgaRepository));
		
		
		$this->commandRouter
			->route(Command\ChangeFlagsRga::class)
			->to(new Command\ChangeFlagsRgaHandler($rgaRepository));
		
		$this->commandRouter
			->route(Command\ChangeNoteRga::class)
			->to(new Command\ChangeNoteRgaHandler($rgaRepository));
		
		$this->commandRouter
			->route(Command\ChangeStateRga::class)
			->to(new Command\ChangeStateRgaHandler($rgaRepository));
		
		$this->commandRouter
			->route(Command\CreateRga::class)
			->to(new Command\CreateRgaHandler(
				$rgaRepository,
				$attachmentRepository,
				$additionalRepository,
				$warrantyCalculator
			));
		
		$this->commandRouter
			->route(Command\RemoveRga::class)
			->to(new Command\RemoveRgaHandler($rgaRepository));
		
		$this->commandRouter
			->route(Command\SetPackageRga::class)
			->to(new Command\SetPackageRgaHandler($rgaRepository));
		
		$this->attachRoutesToCommandBus($commandBus);
	}
}