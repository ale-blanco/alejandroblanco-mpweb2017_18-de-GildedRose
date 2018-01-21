<?php

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

abstract class GeneraltemUpdater
{
    const ITEM_BACKSTAGE = 'Backstage passes to a TAFKAL80ETC concert';
    const ITEM_AGEDBRIE = 'Aged Brie';
    const ITEM_SULFURAS = 'Sulfuras, Hand of Ragnaros';

    const UP_LIMIT = 50;
    const FIRST_TIME_LIMIT = 10;
    const SECOND_TIME_LIMIT = 5;
    const DOWN_LIMIT_QUALITY = 0;

    abstract public function isItemForThisType(Item $item): bool;

    abstract public function updateItemQuality(Item $item): void;

    abstract public function updateSellIn(Item $item): void;

    abstract public function checkSellinAndUpdateQuality(Item $item): void;

    protected function updateNormalSellIn(Item $item): void
    {
        $item->sell_in--;
    }

    protected function increaseQuality(Item $item): void
    {
        $item->quality++;
    }

    protected function decreaseQuality(Item $item): void
    {
        $item->quality--;
    }

    protected function clearQuality(Item $item): void
    {
        $item->quality = self::DOWN_LIMIT_QUALITY;
    }
}
