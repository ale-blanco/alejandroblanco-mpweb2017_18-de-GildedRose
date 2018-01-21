<?php

namespace GildedRose;

use GildedRose\ItemUpdater\AgedbrieItemUpdater;
use GildedRose\ItemUpdater\BackstageItemUpdater;
use GildedRose\ItemUpdater\NormalItemUpdater;
use GildedRose\ItemUpdater\SulfurasItemUpdater;

class GildedRose
{
    const DOWN_LIMIT_SELLIN = 0;

    private $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function update_quality(): void
    {
        foreach ($this->items as $item) {
            $this->updateItemQuality($item);
            $this->updateItemSellIn($item);
            if ($item->sell_in < self::DOWN_LIMIT_SELLIN) {
                $this->checkSellInAndUpdateQuality($item);
            }
        }
    }

    private function updateItemQuality(Item $item): void
    {
        $normalUpdater = new NormalItemUpdater();
        if ($normalUpdater->isItemForThisType($item)) {
            $normalUpdater->updateItemQuality($item);
            return;
        }

        $sulfurasUpdater = new SulfurasItemUpdater();
        if ($sulfurasUpdater->isItemForThisType($item)) {
            $sulfurasUpdater->updateItemQuality($item);
            return;
        }

        $backstageUpdater = new BackstageItemUpdater();
        if ($backstageUpdater->isItemForThisType($item)) {
            $backstageUpdater->updateItemQuality($item);
            return;
        }

        $agedbrieUpdater = new AgedbrieItemUpdater();
        if ($agedbrieUpdater->isItemForThisType($item)) {
            $agedbrieUpdater->updateItemQuality($item);
            return;
        }
    }

    private function updateItemSellIn(Item $item): void
    {
        $normalUpdater = new NormalItemUpdater();
        if ($normalUpdater->isItemForThisType($item)) {
            $normalUpdater->updateSellIn($item);
            return;
        }

        $sulfurasUpdater = new SulfurasItemUpdater();
        if ($sulfurasUpdater->isItemForThisType($item)) {
            $sulfurasUpdater->updateSellIn($item);
            return;
        }

        $backstageUpdater = new BackstageItemUpdater();
        if ($backstageUpdater->isItemForThisType($item)) {
            $backstageUpdater->updateSellIn($item);
            return;
        }

        $agedbrieUpdater = new AgedbrieItemUpdater();
        if ($agedbrieUpdater->isItemForThisType($item)) {
            $agedbrieUpdater->updateSellIn($item);
            return;
        }
    }

    private function checkSellInAndUpdateQuality(Item $item): void
    {
        $normalUpdater = new NormalItemUpdater();
        if ($normalUpdater->isItemForThisType($item)) {
            $normalUpdater->checkSellinAndUpdateQuality($item);
            return;
        }

        $sulfurasUpdater = new SulfurasItemUpdater();
        if ($sulfurasUpdater->isItemForThisType($item)) {
            $sulfurasUpdater->checkSellinAndUpdateQuality($item);
            return;
        }

        $backstageUpdater = new BackstageItemUpdater();
        if ($backstageUpdater->isItemForThisType($item)) {
            $backstageUpdater->checkSellinAndUpdateQuality($item);
            return;
        }

        $agedbrieUpdater = new AgedbrieItemUpdater();
        if ($agedbrieUpdater->isItemForThisType($item)) {
            $agedbrieUpdater->checkSellinAndUpdateQuality($item);
            return;
        }
    }
}
