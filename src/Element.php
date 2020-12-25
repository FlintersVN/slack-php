<?php

namespace Slack;

use Slack\Exceptions\ItemMustBeInstanceOf;

class Element implements ToArray
{
    use ConditionallyToArray;

    public function toArray(): array
    {
        $data = $this->filterNullValues($this->propertiesAsArray());

        foreach ($data as $key => $value) {
            if ($value instanceof ToArray) {
                $data[$key] = $value->toArray();
            } else if (is_array($value)) {
                $data[$key] = $this->arrayElementsToArray($value);
            }
        }

        return $data;
    }

    protected function arrayElementsToArray($elements = [])
    {
        return array_map(function ($item) {
            return $item instanceof ToArray
                ? $item->toArray()
                : $item;
        }, $elements);
    }

    /**
     * @param $collection
     * @param $class
     * @throws ItemMustBeInstanceOf
     */
    public function assertCollectionOf($collection, $class)
    {
        if ($collection === null) {
            return;
        }

        foreach ($collection as $item) {
            if (! $item instanceof $class) {
                throw new ItemMustBeInstanceOf("All items must be instance of $class");
            }
        }
    }
}