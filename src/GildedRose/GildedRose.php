<?php

namespace GildedRose;

use GildedRose\ItemUpdater\Factory\AgedbrieItemUpdaterFactory;
use GildedRose\ItemUpdater\Factory\BackstageItemUpdaterFactory;
use GildedRose\ItemUpdater\Factory\NormalItemUpdaterFactory;
use GildedRose\ItemUpdater\Factory\SulfurasItemUpdaterFactory;
use GildedRose\ItemUpdater\GeneraltemUpdater;

class GildedRose
{
    private $itemsUpdaters = [];
    private $listUpdatersFactorys;

    public function __construct(array $items)
    {
        $this->listUpdatersFactorys = [
            new NormalItemUpdaterFactory(),
            new AgedbrieItemUpdaterFactory(),
            new BackstageItemUpdaterFactory(),
            new SulfurasItemUpdaterFactory()
        ];

        foreach ($items as $item) {
            $this->itemsUpdaters[] = $this->getUpdater($item);
        }
    }

    public function update_quality(): void
    {
        foreach ($this->itemsUpdaters as $item) {
            $item->update();
        }
    }

    private function getUpdater(Item $item): GeneraltemUpdater
    {
        foreach ($this->listUpdatersFactorys as $factory) {
            if (!$factory->checkTypeItem($item)) {
                continue;
            }
            return $factory->createItemUpdate($item);
        }

        throw new \Exception('No hay updater para ese item');
    }
}
