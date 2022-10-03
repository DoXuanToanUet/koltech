<?php

namespace WPIDE\App\Utils;

trait Collection
{
    protected $items = [];

    public function add($obj)
    {
        return $this->items[] = $obj;
    }

    public function delete($obj)
    {
        foreach ($this->items as $key => $item) {
            if ($item === $obj) {
                unset($this->items[$key]);
            }
        }
    }

    public function all(): array
    {
        return $this->items;
    }

    public function get($id, $key = 'id'): array
    {
        return array_filter( $this->items, function($item) use (&$id, &$key) {
            return $item[$key] == $id;
        });
    }

    public function length(): int
    {
        return count($this->items);
    }

    public function jsonSerialize(): array
    {
        return $this->items;
    }

    public function filter(callable $callback)
    {
        $this->items = array_filter($this->items, $callback);

        return $this;
    }

    public function map(callable $callback)
    {
        $this->items = array_map($callback, $this->items);

        return $this;
    }

    public function merge($collection) {

        $this->items = array_merge($this->items, $collection->items);
    }

    public function sortByValue($value, $desc = false)
    {
        usort($this->items, function ($a, $b) use ($value) {
            return $a[$value] <=> $b[$value];
        });

        if ($desc) {
            $this->items = array_reverse($this->items);
        }

        return $this;
    }
}
