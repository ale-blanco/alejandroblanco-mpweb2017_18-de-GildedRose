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
        $this->decreaseQuality($item);
    }
}