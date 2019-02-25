<?php

namespace RGA\Infrastructure\SegregationSourcing\Query\Query;

abstract class QueryMessage
	implements QueryInterface
{
	/** @var \Exception */
	private $exception;
	
	/** @var bool */
	private $silentException;
	
	/** @var Viewable */
	private $view;
	
	/** @var ViewableCollection */
	private $viewCollection;
	
	/** @var string */
	protected $messageName;
	
	/**
	 * @return Viewable
	 */
	public function getView()
	{
		return $this->view;
	}
	
	/**
	 * @param Viewable $view
	 */
	public function setView(Viewable $view): void
	{
		$this->view = $view;
	}
	
	/**
	 * @return ViewableCollection
	 */
	public function getViewCollection()
	{
		return $this->viewCollection;
	}
	
	/**
	 * @param ViewableCollection $viewCollection
	 */
	public function setViewCollection(ViewableCollection $viewCollection): void
	{
		$this->viewCollection = $viewCollection;
	}
	
	protected function init(): void
	{
		if ($this->messageName === null)
		{
			$this->messageName = \get_class($this);
		}
		
		if ($this->silentException === null)
		{
			$this->silentException(false);
		}
	}
	
	/**
	 * @return string
	 */
	public function messageName(): string
	{
		return $this->messageName;
	}
	
	/**
	 * @return \Exception
	 */
	public function exception(): \Exception
	{
		return $this->exception;
	}
	
	/**
	 * @param bool $silentExceptions
	 */
	public function silentException(bool $silentExceptions = true): void
	{
		$this->silentException = $silentExceptions;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function setException(\Exception $exception): void
	{
		$this->exception = $exception;
		
		if (false === $this->silentException)
		{
			throw $exception;
		}
	}
	
	/**
	 * @return bool
	 */
	public function hasException(): bool
	{
		return $this->exception() instanceof \Exception;
	}
}