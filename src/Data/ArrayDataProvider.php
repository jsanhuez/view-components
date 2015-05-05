<?php

namespace Nayjest\ViewComponents\Data;

use ArrayIterator;
use IteratorAggregate;

class ArrayDataProvider implements DataProviderInterface, IteratorAggregate
{
    protected $processingManager;
    protected $operationsCollection;

    public function __construct($src, array $operations = [])
    {
        $this->operationsCollection = new OperationsCollection();
        $this->operationsCollection->set($operations);

        $this->processingManager = new ProcessingManager(
            new ProcessorResolver(),
            $this->operationsCollection,
            $this->makeRowObjects($src)
        );
    }

    /**
     * @param $src
     * @return array
     */
    protected function makeRowObjects($src)
    {
        $newSrc = [];
        foreach($src as $row) {
            $newSrc[] = is_array($row)?(object)$row:$row;
        }
        return $newSrc;
    }

    public function operations()
    {
        return $this->operationsCollection;
    }

    public function getIterator()
    {
        return new ArrayIterator(
            $this->processingManager->getProcessedData()
        );
    }
}
