<?php

namespace GildedRose\ItemUpdater;

use GildedRose\Item;

abstract class GeneraltemUpdater extends Item
{
    const UP_LIMIT = 50;
    const FIRST_TIME_LIMIT = 10;
    const SECOND_TIME_LIMIT = 5;
    const DOWN_LIMIT_QUALITY = 0;
    const DOWN_LIMIT_SELLIN = 0;

    protected $item;

    public function __construct(Item $item)
    {
        parent::__construct($item->name, $item->sell_in, $item->quality);
        $this->item = $item;
    }

    abstract public static function checkItemType(string $name): bool;

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
        $this->sell_in--;
    }

    protected function increaseQuality(): void
    {
        $this->quality++;
    }

    protected function decreaseQuality(): void
    {
        $this->quality--;
    }

    protected function clearQuality(): void
    {
        $this->quality = self::DOWN_LIMIT_QUALITY;
    }

    protected function isInDownSellinLimit(): bool
    {
        return $this->sell_in < self::DOWN_LIMIT_SELLIN;
    }

    protected function isUpperQualityLimit(): bool
    {
        return $this->quality >= self::UP_LIMIT;
    }
}
