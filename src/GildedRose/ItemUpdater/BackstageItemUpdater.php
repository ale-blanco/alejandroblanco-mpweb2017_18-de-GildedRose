<?php

namespace GildedRose\ItemUpdater;

final class BackstageItemUpdater extends GeneraltemUpdater
{
    private const ITEM_BACKSTAGE = 'Backstage passes to a TAFKAL80ETC concert';

    public static function checkTypeItem(string $name): bool
    {
        return $name === self::ITEM_BACKSTAGE;
    }

    protected function updateItemQuality(): void
    {
        if ($this->isUpQualityLimit()) {
            return;
        }

        $this->increaseQuality();

        if ($this->quality >= self::UP_LIMIT) {
            return;
        }

        if ($this->sell_in <= self::FIRST_TIME_LIMIT) {
            $this->increaseQuality();
        }

        if ($this->sell_in <= self::SECOND_TIME_LIMIT) {
            $this->increaseQuality();
        }
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

        $this->clearQuality();
    }
}
