<?php

namespace GildedRose\ItemUpdater\Factory;

use GildedRose\Item;
use GildedRose\ItemUpdater\AgedBrieItemUpdater;
use GildedRose\ItemUpdater\BackstageItemUpdater;
use GildedRose\ItemUpdater\GeneraltemUpdater;
use GildedRose\ItemUpdater\NormalItemUpdater;
use GildedRose\ItemUpdater\SulfurasItemUpdater;

class ItemUpdaterFactory
{
    public static function create(Item $item): GeneraltemUpdater
    {
        if (AgedBrieItemUpdater::checkItemType($item->name)) {
            return new AgedBrieItemUpdater($item);
        } elseif (BackstageItemUpdater::checkItemType($item->name)) {
            return new BackstageItemUpdater($item);
        } elseif (SulfurasItemUpdater::checkItemType($item->name)) {
            return new SulfurasItemUpdater($item);
        } else {
            return new NormalItemUpdater($item);
        }
    }
}
