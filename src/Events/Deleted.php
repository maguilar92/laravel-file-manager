<?php

namespace Alexusmai\LaravelFileManager\Events;

use Illuminate\Support\Facades\Storage;

class Deleted
{
    /**
     * @var string
     */
    private $disk;

    /**
     * @var array
     */
    private $items;

    /**
     * @param $disk
     * @param $items
     */
    public function __construct($disk, $items)
    {
        $this->disk  = $disk;
        $this->items = $items;
    }

    /**
     * @return string
     */
    public function disk()
    {
        return $this->disk;
    }

    /**
     * @return array
     */
    public function items()
    {
        return array_map(function ($item) {
            $item['size'] = Storage::disk($this->disk())->size($item['path']);

            return $item;
        }, $this->items);
    }
}
