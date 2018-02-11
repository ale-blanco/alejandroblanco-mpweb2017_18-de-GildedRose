<?php

namespace GildedRose\ItemUpdater\Factory;

use GildedRose\ItemUpdater\AgedBrieItemUpdater;
use GildedRose\ItemUpdater\BackstageItemUpdater;
use GildedRose\ItemUpdater\GeneraltemUpdater;
use GildedRose\ItemUpdater\NormalItemUpdater;
use GildedRose\ItemUpdater\SulfurasItemUpdater;

class ItemUpdaterFactory
{
    public static function create(string $name, int $sellIn, int $quality): GeneraltemUpdater
    {
        if (AgedBrieItemUpdater::checkItemType($name)) {
            return new AgedBrieItemUpdater($name, $sellIn, $quality);
        } elseif (BackstageItemUpdater::checkItemType($name)) {
            return new BackstageItemUpdater($name, $sellIn, $quality);
        } elseif (SulfurasItemUpdater::checkItemType($name)) {
            return new SulfurasItemUpdater($name, $sellIn, $quality);
        } else {
            return new NormalItemUpdater($name, $sellIn, $quality);
        }
    }
}
