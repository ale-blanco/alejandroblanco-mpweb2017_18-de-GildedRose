<?php

namespace GildedRose\ItemUpdater;

final class NormalItemUpdater extends GeneraltemUpdater
{
    public static function checkItemType(string $name): bool
    {
        return !AgedBrieItemUpdater::checkItemType($name)
            && !BackstageItemUpdater::checkItemType($name)
            && !SulfurasItemUpdater::checkItemType($name);
    }

    protected function updateItemQuality(): void
    {
        if ($this->isDownLimitQuality()) {
            return;
        }

        $this->decreaseQuality();
    }

    protected function updateSellIn(): void
    {
        $this->updateNormalSellIn();
    }

    protected function checkSellinAndUpdateQuality(): void
    {
        if (!$this->isInDownSellinLimit()) {
            return;
        }

        if ($this->isDownLimitQuality()) {
            return;
        }

        $this->decreaseQuality();
    }

    private function isDownLimitQuality(): bool
    {
        return $this->quality <= self::DOWN_LIMIT_QUALITY;
    }
}
