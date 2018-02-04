<?php

namespace GildedRose\ItemUpdater\Factory;

use GildedRose\Item;
use GildedRose\ItemUpdater\AgedbrieItemUpdater;
use GildedRose\ItemUpdater\GeneraltemUpdater;

class AgedbrieItemUpdaterFactory implements ItemUpdaterFactory
{
    public function checkTypeItem(Item $item): bool
    {
        return AgedbrieItemUpdater::checkTypeItem($item);
    }

    public function createItemUpdate(Item $item): GeneraltemUpdater
    {
        return new AgedbrieItemUpdater($item);
    }
}
