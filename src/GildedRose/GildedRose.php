<?php

namespace GildedRose;

class GildedRose
{
    const ITEM_BACKSTAGE = 'Backstage passes to a TAFKAL80ETC concert';
    const ITEM_AGEDBRIE = 'Aged Brie';
    const ITEM_SULFURAS = 'Sulfuras, Hand of Ragnaros';

    const UP_LIMIT = 50;
    const FIRST_TIME_LIMIT = 10;
    const SECOND_TIME_LIMIT = 5;
    const VARIATION_QUALITY = 1;
    const DOWN_LIMIT_SELLIN = 0;
    const DOWN_LIMIT_QUALITY = 0;

    private $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function update_quality(): void
    {
        foreach ($this->items as $item) {
            $this->updateItemQuality($item);
            $this->updateItemSellIn($item);
            $this->checkSellInAndUpdateQuality($item);
        }
    }

    private function updateItemQuality(Item $item): void
    {
        if ($item->name != self::ITEM_AGEDBRIE && $item->name != self::ITEM_BACKSTAGE
            && $item->name != self::ITEM_SULFURAS && $item->quality > self::DOWN_LIMIT_QUALITY
        ) {
            $this->decreaseQuality($item);
            return;
        }

        if ($item->quality >= self::UP_LIMIT) {
            return;
        }

        $this->increaseQuality($item);

        if ($item->quality >= self::UP_LIMIT) {
            return;
        }

        if ($item->name != self::ITEM_BACKSTAGE) {
            return;
        }

        if ($item->sell_in <= self::FIRST_TIME_LIMIT) {
            $this->increaseQuality($item);
        }

        if ($item->sell_in <= self::SECOND_TIME_LIMIT) {
            $this->increaseQuality($item);
        }
    }

    private function updateItemSellIn(Item $item): void
    {
        if ($item->name === self::ITEM_SULFURAS) {
            return;
        }

        $this->decreaseSellIn($item);
    }

    private function checkSellInAndUpdateQuality(Item $item): void
    {
        if ($item->sell_in >= self::DOWN_LIMIT_SELLIN) {
            return;
        }

        if ($item->name === self::ITEM_AGEDBRIE && $item->quality < self::UP_LIMIT) {
            $this->increaseQuality($item);
            return;
        }

        if ($item->name === self::ITEM_BACKSTAGE) {
            $this->clearQuality($item);
            return;
        }

        if ($item->quality <= self::DOWN_LIMIT_QUALITY || $item->name === self::ITEM_SULFURAS) {
            return;
        }

        $this->decreaseQuality($item);
    }

    private function increaseQuality(Item $item): void
    {
        $item->quality = $item->quality + self::VARIATION_QUALITY;
    }

    private function decreaseQuality(Item $item): void
    {
        $item->quality = $item->quality - self::VARIATION_QUALITY;
    }

    private function clearQuality(Item $item): void
    {
        $item->quality = self::DOWN_LIMIT_QUALITY;
    }

    private function decreaseSellIn(Item $item): void
    {
        $item->sell_in = $item->sell_in - self::VARIATION_QUALITY;
    }
}
