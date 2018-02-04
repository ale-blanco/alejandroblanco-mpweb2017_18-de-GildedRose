<?php

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

final class NormalItemUpdater extends GeneraltemUpdater
{
    public static function checkTypeItem(Item $item): bool
    {
        return !AgedbrieItemUpdater::checkTypeItem($item)
            && !BackstageItemUpdater::checkTypeItem($item)
            && !SulfurasItemUpdater::checkTypeItem($item);
    }

    protected function updateItemQuality(): void
    {
        if ($this->item->quality <= self::DOWN_LIMIT_QUALITY) {
            return;
        }

        $this->decreaseQuality();
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

        if ($this->item->quality <= self::DOWN_LIMIT_QUALITY ) {
            return;
        }

        $this->decreaseQuality();
    }
}
