<?php

namespace RGA\Application\Command\CommandHandling\Event;

class DispatcherEvents
{
	const EVENT_COMMAND_SUCCESS = 'rga.command_handling.command_success';
	const EVENT_COMMAND_FAILURE = 'rga.command_handling.command_failure';
}