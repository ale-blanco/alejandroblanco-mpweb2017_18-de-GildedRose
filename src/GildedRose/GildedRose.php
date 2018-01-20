<?php

namespace GildedRose;

class GildedRose
{
    const BACKSTAGE = 'Backstage passes to a TAFKAL80ETC concert';
    const AGEDBRIE = 'Aged Brie';
    const SULFURAS = 'Sulfuras, Hand of Ragnaros';

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
            if ($item->name != self::AGEDBRIE and $item->name != self::BACKSTAGE) {
                if ($item->quality > 0) {
                    if ($item->name != self::SULFURAS) {
                        $item->quality = $item->quality - self::VARIATION_QUALITY;
                    }
                }
            } else {
                if ($item->quality < self::UP_LIMIT) {
                    $item->quality = $item->quality + self::VARIATION_QUALITY;
                    if ($item->name == self::BACKSTAGE) {
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

            if ($item->name != self::SULFURAS) {
                $item->sell_in = $item->sell_in - self::VARIATION_QUALITY;
            }

            if ($item->sell_in < 0) {
                if ($item->name != self::AGEDBRIE) {
                    if ($item->name != self::BACKSTAGE) {
                        if ($item->quality > 0) {
                            if ($item->name != self::SULFURAS) {
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
}
