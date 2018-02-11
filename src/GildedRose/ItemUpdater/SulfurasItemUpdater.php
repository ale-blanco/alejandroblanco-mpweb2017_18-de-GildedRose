<?php

namespace GildedRose\ItemUpdater;

final class SulfurasItemUpdater extends GeneraltemUpdater
{
    const ITEM_SULFURAS = 'Sulfuras, Hand of Ragnaros';

    public static function checkTypeItem(string $name): bool
    {
        return $name === self::ITEM_SULFURAS;
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
