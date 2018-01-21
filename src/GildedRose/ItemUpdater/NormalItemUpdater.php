<?php

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

final class NormalItemUpdater extends GeneraltemUpdater
{
    public function isItemForThisType(Item $item): bool
    {
        return $item->name != self::ITEM_AGEDBRIE
               && $item->name != self::ITEM_BACKSTAGE
               && $item->name != self::ITEM_SULFURAS;
    }

    public function updateItemQuality(Item $item): void
    {
        if ($item->quality <= self::DOWN_LIMIT_QUALITY) {
            return;
        }

        $this->decreaseQuality($item);
    }

    public function updateSellIn(Item $item): void
    {
        $this->updateNormalSellIn($item);
    }

    public function checkSellinAndUpdateQuality(Item $item): void
    {
        if (!$this->isInDownSellinLimit($item)) {
            return;
        }

        if ($item->quality <= self::DOWN_LIMIT_QUALITY ) {
            return;
        }

        $this->decreaseQuality($item);
    }
}
