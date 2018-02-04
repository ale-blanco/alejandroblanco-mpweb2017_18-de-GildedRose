<?php

namespace GildedRose\ItemUpdater\Factory;

use GildedRose\Item;
use GildedRose\ItemUpdater\GeneraltemUpdater;
use GildedRose\ItemUpdater\SulfurasItemUpdater;

class SulfurasItemUpdaterFactory implements ItemUpdaterFactory
{
    public function checkTypeItem(Item $item): bool
    {
        return SulfurasItemUpdater::checkTypeItem($item);
    }

    public function createItemUpdate(Item $item): GeneraltemUpdater
    {
        return new SulfurasItemUpdater($item);
    }
}
