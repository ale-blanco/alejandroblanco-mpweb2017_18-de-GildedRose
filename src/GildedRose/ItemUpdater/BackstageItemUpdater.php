<?php

namespace GildedRose\ItemUpdater;

final class BackstageItemUpdater extends GeneraltemUpdater
{
    private const ITEM_BACKSTAGE = 'Backstage passes to a TAFKAL80ETC concert';

    public static function checkItemType(string $name): bool
    {
        return $name === self::ITEM_BACKSTAGE;
    }

    protected function updateItemQuality(): void
    {
        if ($this->isUpperQualityLimit()) {
            return;
        }

        $this->increaseQuality();

        if ($this->isUpperQualityLimit()) {
            return;
        }

        if ($this->isDownFirtsTimeLimit()) {
            $this->increaseQuality();
        }

        if ($this->isDownSecondTimeLimit()) {
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

    private function isDownFirtsTimeLimit(): bool
    {
        return $this->sell_in <= self::FIRST_TIME_LIMIT;
    }

    private function isDownSecondTimeLimit(): bool
    {
        return $this->sell_in <= self::SECOND_TIME_LIMIT;
    }
}
