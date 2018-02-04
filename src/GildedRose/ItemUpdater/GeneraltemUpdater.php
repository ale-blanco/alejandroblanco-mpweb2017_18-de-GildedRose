<?php

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

abstract class GeneraltemUpdater
{
    const UP_LIMIT = 50;
    const FIRST_TIME_LIMIT = 10;
    const SECOND_TIME_LIMIT = 5;
    const DOWN_LIMIT_QUALITY = 0;
    const DOWN_LIMIT_SELLIN = 0;

    protected $item;

    public function __construct(Item $item)
    {
        if (!self::checkTypeItem($item)) {
            throw new \Exception('Tipo de item no valido');
        }

        $this->item = $item;
    }

    abstract public static function checkTypeItem(Item $item): bool;

    abstract protected function updateItemQuality(): void;

    abstract protected function updateSellIn(): void;

    abstract protected function checkSellinAndUpdateQuality(): void;

    public function update(): void
    {
        $this->updateItemQuality();
        $this->updateSellIn();
        $this->checkSellInAndUpdateQuality();
    }

    protected function updateNormalSellIn(): void
    {
        $this->item->sell_in--;
    }

    protected function increaseQuality(): void
    {
        $this->item->quality++;
    }

    protected function decreaseQuality(): void
    {
        $this->item->quality--;
    }

    protected function clearQuality(): void
    {
        $this->item->quality = self::DOWN_LIMIT_QUALITY;
    }

    protected function isInDownSellinLimit(): bool
    {
        return $this->item->sell_in < self::DOWN_LIMIT_SELLIN;
    }

    protected function isUpQualityLimit(): bool
    {
        return $this->item->quality >= self::UP_LIMIT;
    }
}
