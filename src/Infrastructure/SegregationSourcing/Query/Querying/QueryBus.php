<?php

namespace RGA\Infrastructure\SegregationSourcing\Query\Querying;

use RGA\Infrastructure\SegregationSourcing\Message\Messaging\MessageBus;
use RGA\Infrastructure\SegregationSourcing\Plugin\Routing\RouterInterface;
use RGA\Infrastructure\SegregationSourcing\Query;

class QueryBus extends MessageBus implements QueryBusInterface
{
    /** @var Query\Plugin\QueryRouter */
    private $router;
    
    /**
     * @param Query\Plugin\QueryRouter $router
     */
    public function __construct(Query\Plugin\QueryRouter $router)
    {
        $this->router = $router;
    }
    
    /**
     * @param RouterInterface|Query\Plugin\QueryRouter $router
     */
    public function setRouter(RouterInterface $router): void
    {
        $this->router = $router;
    }
    
    /**
     * @param RouterInterface|Query\Plugin\QueryRouter $router
     */
    public function injectRoutes(RouterInterface $router): void
    {
        $this->router->merge($router);
    }
    
    /**
     * {@inheritdoc}
     */
    public function dispatch(Query\Query\QueryInterface $query): void
    {
        /** @var QueryHandlerInterface $handler */
        foreach ($this->router->map($query->messageName()) as $handler) {
            try {
                $handler->run($query);
            } catch (Query\Exception\ResourceNotFoundException $e) {
                $query->setException($e);
            } catch (Query\Exception\CanNotHandleException $e) {
                $query->setException($e);
            } catch (\Exception $e) {
                $query->setException($e);
            }
        }
    }
}
