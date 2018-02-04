<?php

namespace GildedRose\ItemUpdater\Factory;

use GildedRose\Item;
use GildedRose\ItemUpdater\BackstageItemUpdater;
use GildedRose\ItemUpdater\GeneraltemUpdater;

class BackstageItemUpdaterFactory implements ItemUpdaterFactory
{
    public function checkTypeItem(Item $item): bool
    {
        return BackstageItemUpdater::checkTypeItem($item);
    }

    public function createItemUpdate(Item $item): GeneraltemUpdater
    {
        return new BackstageItemUpdater($item);
    }
}
