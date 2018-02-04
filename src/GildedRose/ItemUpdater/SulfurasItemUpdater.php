<?php

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

final class SulfurasItemUpdater extends GeneraltemUpdater
{
    const ITEM_SULFURAS = 'Sulfuras, Hand of Ragnaros';

    public static function checkTypeItem(Item $item): bool
    {
        return $item->name === self::ITEM_SULFURAS;
    }

    protected function updateItemQuality(): void
    {
        if ($this->isUpQualityLimit()) {
            return;
        }

        $this->increaseQuality();
    }

    protected function updateSellIn(): void
    {
        return;
    }

    protected function checkSellinAndUpdateQuality(): void
    {
        return;
    }
}
