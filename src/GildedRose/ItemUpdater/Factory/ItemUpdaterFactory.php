<?php

namespace GildedRose\ItemUpdater\Factory;

use GildedRose\Item;
use GildedRose\ItemUpdater\GeneraltemUpdater;

interface ItemUpdaterFactory
{
    public function checkTypeItem(Item $item): bool ;

    public function createItemUpdate(Item $item): GeneraltemUpdater;
}