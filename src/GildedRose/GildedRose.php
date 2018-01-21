<?php

namespace GildedRose;

use GildedRose\ItemUpdater\AgedbrieItemUpdater;
use GildedRose\ItemUpdater\BackstageItemUpdater;
use GildedRose\ItemUpdater\GeneraltemUpdater;
use GildedRose\ItemUpdater\NormalItemUpdater;
use GildedRose\ItemUpdater\SulfurasItemUpdater;

class GildedRose
{

    private $items;
    private $listUpdaters;

    public function __construct($items)
    {
        $this->items = $items;
        $this->listUpdaters = [
            new NormalItemUpdater(),
            new AgedbrieItemUpdater(),
            new BackstageItemUpdater(),
            new SulfurasItemUpdater()
        ];
    }

    public function update_quality(): void
    {

        foreach ($this->items as $item) {
            $updater = $this->getUpdater($item);

            $updater->updateItemQuality($item);
            $updater->updateSellIn($item);
            $updater->checkSellInAndUpdateQuality($item);
        }
    }

    private function getUpdater(Item $item): GeneraltemUpdater
    {
        foreach ($this->listUpdaters as $updater) {
            if ($updater->isItemForThisType($item)) {
                return $updater;
            }
        }

        throw new \Exception('No hay updater para ese item');
    }
}
