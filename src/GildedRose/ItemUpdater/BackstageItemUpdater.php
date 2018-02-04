<?php

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

final class BackstageItemUpdater extends GeneraltemUpdater
{
    private const ITEM_BACKSTAGE = 'Backstage passes to a TAFKAL80ETC concert';

    public static function checkTypeItem(Item $item): bool
    {
        return $item->name === self::ITEM_BACKSTAGE;
    }

    protected function updateItemQuality(): void
    {
        if ($this->isUpQualityLimit()) {
            return;
        }

        $this->increaseQuality();

        if ($this->item->quality >= self::UP_LIMIT) {
            return;
        }

        if ($this->item->sell_in <= self::FIRST_TIME_LIMIT) {
            $this->increaseQuality();
        }

        if ($this->item->sell_in <= self::SECOND_TIME_LIMIT) {
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
