<?php

namespace GildedRose;

use GildedRose\ItemUpdater\AgedbrieItemUpdater;
use GildedRose\ItemUpdater\BackstageItemUpdater;
use GildedRose\ItemUpdater\NormalItemUpdater;
use GildedRose\ItemUpdater\SulfurasItemUpdater;

class GildedRose
{
    const UP_LIMIT = 50;
    const FIRST_TIME_LIMIT = 10;
    const SECOND_TIME_LIMIT = 5;
    const VARIATION_QUALITY = 1;
    const DOWN_LIMIT_SELLIN = 0;
    const DOWN_LIMIT_QUALITY = 0;

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
            $this->checkSellInAndUpdateQuality($item);
        }
    }

    private function updateItemQuality(Item $item): void
    {
        $normalUpdater = new NormalItemUpdater();
        if ($normalUpdater->isItemForThisType($item) && $item->quality > self::DOWN_LIMIT_QUALITY) {
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
        if ($item->sell_in >= self::DOWN_LIMIT_SELLIN) {
            return;
        }

        if ($item->name === NormalItemUpdater::ITEM_AGEDBRIE && $item->quality < self::UP_LIMIT) {
            $this->increaseQuality($item);
            return;
        }

        if ($item->name === NormalItemUpdater::ITEM_BACKSTAGE) {
            $this->clearQuality($item);
            return;
        }

        if ($item->quality <= self::DOWN_LIMIT_QUALITY || $item->name === NormalItemUpdater::ITEM_SULFURAS) {
            return;
        }

        $this->decreaseQuality($item);
    }

    private function increaseQuality(Item $item): void
    {
        $item->quality = $item->quality + self::VARIATION_QUALITY;
    }

    private function decreaseQuality(Item $item): void
    {
        $item->quality = $item->quality - self::VARIATION_QUALITY;
    }

    private function clearQuality(Item $item): void
    {
        $item->quality = self::DOWN_LIMIT_QUALITY;
    }
}
