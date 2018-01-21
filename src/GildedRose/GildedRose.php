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
        if ($item->name != self::ITEM_AGEDBRIE and $item->name != self::ITEM_BACKSTAGE) {
            if ($item->quality > 0) {
                if ($item->name != self::ITEM_SULFURAS) {
                    $item->quality = $item->quality - self::VARIATION_QUALITY;
                }
            }
        } else {
            if ($item->quality < self::UP_LIMIT) {
                $item->quality = $item->quality + self::VARIATION_QUALITY;
                if ($item->name == self::ITEM_BACKSTAGE) {
                    if ($item->sell_in <= self::FIRST_TIME_LIMIT) {
                        if ($item->quality < self::UP_LIMIT) {
                            $item->quality = $item->quality + self::VARIATION_QUALITY;
                        }
                    }
                    if ($item->sell_in <= self::SECOND_TIME_LIMIT) {
                        if ($item->quality < self::UP_LIMIT) {
                            $item->quality = $item->quality + self::VARIATION_QUALITY;
                        }
                    }
                }
            }
        }
    }

    private function updateItemSellIn(Item $item): void
    {
        if ($item->name != self::ITEM_SULFURAS) {
            $item->sell_in = $item->sell_in - self::VARIATION_QUALITY;
        }
    }

    private function checkSellInAndUpdateQuality(Item $item): void
    {
        if ($item->sell_in < 0) {
            if ($item->name != self::ITEM_AGEDBRIE) {
                if ($item->name != self::ITEM_BACKSTAGE) {
                    if ($item->quality > 0) {
                        if ($item->name != self::ITEM_SULFURAS) {
                            $item->quality = $item->quality - self::VARIATION_QUALITY;
                        }
                    }
                } else {
                    $item->quality = $item->quality - $item->quality;
                }
            } else {
                if ($item->quality < self::UP_LIMIT) {
                    $item->quality = $item->quality + self::VARIATION_QUALITY;
                }
            }
        }
    }
}
