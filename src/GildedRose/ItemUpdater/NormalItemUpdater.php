<?php

namespace GildedRose\ItemUpdater;

final class NormalItemUpdater extends GeneraltemUpdater
{
    public static function checkTypeItem(string $name): bool
    {
        return !AgedbrieItemUpdater::checkTypeItem($name)
            && !BackstageItemUpdater::checkTypeItem($name)
            && !SulfurasItemUpdater::checkTypeItem($name);
    }

    protected function updateItemQuality(): void
    {
        if ($this->quality <= self::DOWN_LIMIT_QUALITY) {
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

        if ($this->quality <= self::DOWN_LIMIT_QUALITY ) {
            return;
        }

        $this->decreaseQuality();
    }
}
