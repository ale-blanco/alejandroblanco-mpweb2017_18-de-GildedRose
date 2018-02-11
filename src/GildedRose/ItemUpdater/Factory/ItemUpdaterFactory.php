<?php

namespace GildedRose\ItemUpdater\Factory;

use GildedRose\ItemUpdater\AgedbrieItemUpdater;
use GildedRose\ItemUpdater\BackstageItemUpdater;
use GildedRose\ItemUpdater\GeneraltemUpdater;
use GildedRose\ItemUpdater\NormalItemUpdater;
use GildedRose\ItemUpdater\SulfurasItemUpdater;

class ItemUpdaterFactory
{
    public static function create(string $name, int $sellIn, int $quality): GeneraltemUpdater
    {
        if (AgedbrieItemUpdater::checkTypeItem($name)) {
            return new AgedbrieItemUpdater($name, $sellIn, $quality);
        } elseif (BackstageItemUpdater::checkTypeItem($name)) {
            return new BackstageItemUpdater($name, $sellIn, $quality);
        } elseif (SulfurasItemUpdater::checkTypeItem($name)) {
            return new SulfurasItemUpdater($name, $sellIn, $quality);
        } else {
            return new NormalItemUpdater($name, $sellIn, $quality);
        }
    }
}
