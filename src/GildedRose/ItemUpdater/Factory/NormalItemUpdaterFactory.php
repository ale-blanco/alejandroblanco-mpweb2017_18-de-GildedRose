<?php

namespace GildedRose\ItemUpdater\Factory;

use GildedRose\Item;
use GildedRose\ItemUpdater\GeneraltemUpdater;
use GildedRose\ItemUpdater\NormalItemUpdater;

class NormalItemUpdaterFactory implements ItemUpdaterFactory
{
    public function checkTypeItem(Item $item): bool
    {
        return NormalItemUpdater::checkTypeItem($item);
    }

    public function createItemUpdate(Item $item): GeneraltemUpdater
    {
        return new NormalItemUpdater($item);
    }
}
