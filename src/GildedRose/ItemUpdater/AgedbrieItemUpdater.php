<?php

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

final class AgedbrieItemUpdater extends GeneraltemUpdater
{
    public function isItemForThisType(Item $item): bool
    {
        return $item->name === self::ITEM_AGEDBRIE;
    }

    public function updateItemQuality(Item $item): void
    {
        if ($item->quality >= self::UP_LIMIT) {
            return;
        }

        $this->increaseQuality($item);
    }

    public function updateSellIn(Item $item): void
    {
        $this->updateNormalSellIn($item);
    }
}
