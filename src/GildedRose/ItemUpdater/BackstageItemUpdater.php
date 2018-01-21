<?php

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

final class BackstageItemUpdater extends GeneraltemUpdater
{
    public function isItemForThisType(Item $item): bool
    {
        return $item->name === self::ITEM_BACKSTAGE;
    }

    public function updateItemQuality(Item $item): void
    {
        if ($item->quality >= self::UP_LIMIT) {
            return;
        }

        $this->increaseQuality($item);

        if ($item->quality >= self::UP_LIMIT) {
            return;
        }

        if ($item->sell_in <= self::FIRST_TIME_LIMIT) {
            $this->increaseQuality($item);
        }

        if ($item->sell_in <= self::SECOND_TIME_LIMIT) {
            $this->increaseQuality($item);
        }
    }

    public function updateSellIn(Item $item): void
    {
        $this->updateNormalSellIn($item);
    }

    public function checkSellinAndUpdateQuality(Item $item): void
    {
        $this->clearQuality($item);
    }
}
