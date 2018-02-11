<?php

namespace GildedRose\ItemUpdater;

final class AgedbrieItemUpdater extends GeneraltemUpdater
{
    private const ITEM_AGEDBRIE = 'Aged Brie';

    public static function checkTypeItem(string $name): bool
    {
        return $name === self::ITEM_AGEDBRIE;
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
        $this->updateNormalSellIn();
    }

    protected function checkSellinAndUpdateQuality(): void
    {
        if (!$this->isInDownSellinLimit()) {
            return;
        }

        if ($this->quality >= self::UP_LIMIT) {
            return;
        }

        $this->increaseQuality();
    }
}
