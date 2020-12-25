<?php

namespace Slack;

use Closure;

trait ConditionallyToArray
{
    public function when($condition, $value)
    {
        if ($condition) {
            return $value instanceof Closure ? $value() : $value;
        }

        return new MissingValue;
    }

    public function filter($data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->filter($value);
                continue;
            }
        }

        return $this->removeMissingValues($data);
    }

    protected function filterNullValues($data)
    {
        return array_filter($data, function ($value) {
            return $value !== null;
        });
    }

    protected function removeMissingValues($data)
    {
        foreach ($data as $key => $value) {
            if ($value instanceof MissingValue) {
                unset($data[$key]);
            }
        }

        return $data;
    }

    protected function propertiesAsArray()
    {
        return get_object_vars($this);
    }

    public function whenNotNull($value)
    {
        return is_null($value) ? new MissingValue : $value;
    }
}