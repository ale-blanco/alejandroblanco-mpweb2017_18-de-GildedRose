<?php

namespace GildedRose;

use GildedRose\ItemUpdater\GeneraltemUpdater;

class GildedRose
{
    private $itemsUpdaters = [];

    public function __construct(array $itemsUpdater)
    {
        foreach ($itemsUpdater as $item) {
            if (!$item instanceof GeneraltemUpdater) {
                throw new \Exception('Tipo de item no valido');
            }
        }

        $this->itemsUpdaters = $itemsUpdater;
    }

    public function updateQuality(): void
    {
        foreach ($this->itemsUpdaters as $item) {
            $item->update();
        }
    }
}
