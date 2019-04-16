<?php

namespace RGA\Application\Rga\Event\EventSourcing;

use Psr\Container\ContainerInterface;
use RGA\Application\Rga\Event;
use RGA\Domain\Model\Rga\Projection;
use RGA\Infrastructure\SegregationSourcing\Event\EventSourcing;

class EventBusFactory extends EventSourcing\AbstractEventBusFactory
{
    /**
     * @param EventSourcing\EventBus $eventBus
     * @param ContainerInterface $container
     */
    public function populate(EventSourcing\EventBus $eventBus, ContainerInterface $container): void
    {
        /** @var Projection\RgaProjectorInterface $rgaProjector */
        $rgaProjector = $container->get(Projection\RgaProjectorInterface::class);
        
        $this->eventRouter
            ->route(Event\ApplicantRgaChanged::class)
            ->to([$rgaProjector, 'onApplicantRgaChanged']);
        
        $this->eventRouter
            ->route(Event\ExistingRgaRemoved::class)
            ->to([$rgaProjector, 'onExistingRgaRemoved']);
        
        $this->eventRouter
            ->route(Event\FlagsRgaChanged::class)
            ->to([$rgaProjector, 'onFlagsRgaChanged']);
        
        $this->eventRouter
            ->route(Event\NoteRgaChanged::class)
            ->to([$rgaProjector, 'onNoteRgaChanged']);
        
        $this->eventRouter
            ->route(Event\NewRgaCreated::class)
            ->to([$rgaProjector, 'onNewRgaCreated']);
        
        $this->eventRouter
            ->route(Event\PackageRgaSet::class)
            ->to([$rgaProjector, 'onPackageRgaSet']);
        
        $this->eventRouter
            ->route(Event\StateRgaChanged::class)
            ->to([$rgaProjector, 'onStateRgaChanged']);
        
        $this->attachRoutesToEventBus($eventBus);
    }
}
