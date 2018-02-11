<?php

namespace GildedRose\ItemUpdater;

final class AgedBrieItemUpdater extends GeneraltemUpdater
{
    private const ITEM_AGEDBRIE = 'Aged Brie';

    public static function checkItemType(string $name): bool
    {
        return $name === self::ITEM_AGEDBRIE;
    }

    protected function updateItemQuality(): void
    {
        if ($this->isUpperQualityLimit()) {
            return;
        }

        $this->increaseQuality();
    }

    protected function updateSellIn(): void
    {
        $this->updateNormalSellIn();
    }

    protected function checkSellinAndUpdateQuality(): void
    {
        if (!$this->isInDownSellinLimit()) {
            return;
        }

        if ($this->isUpperQualityLimit()) {
            return;
        }

        $this->increaseQuality();
    }
}
