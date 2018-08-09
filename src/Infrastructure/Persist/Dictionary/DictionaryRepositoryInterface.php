<?php

namespace RGA\Infrastructure\Persist\Dictionary;

use RGA\Domain\Model\Dictionary\Dictionary;
use RGA\Infrastructure\Persist\Exception\NotFound;

interface DictionaryRepositoryInterface
{
	/**
	 * @param string $guid
	 * @return Dictionary
	 */
	public function find(string $guid): Dictionary;

	/**
	 * @param Dictionary $model
	 */
	public function save(Dictionary $model);

	/**
	 * @param string $guid
	 * @return Dictionary
	 * @throws NotFound
	 */
	public function load(string $guid): Dictionary;

	/**
	 * @param string $guid
	 */
	public function delete(string $guid): void;
}