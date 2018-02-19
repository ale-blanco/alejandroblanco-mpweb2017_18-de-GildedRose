<?php

use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\ItemUpdater\Factory\ItemUpdaterFactory;

require_once 'vendor/autoload.php';

echo "OMGHAI!\n";
$items = array(
    ItemUpdaterFactory::create(new Item('+5 Dexterity Vest', 10, 20)),
    ItemUpdaterFactory::create(new Item('Aged Brie', 2, 0)),
    ItemUpdaterFactory::create(new Item('Elixir of the Mongoose', 5, 7)),
    ItemUpdaterFactory::create(new Item('Sulfuras, Hand of Ragnaros', 0, 80)),
    ItemUpdaterFactory::create(new Item('Sulfuras, Hand of Ragnaros', -1, 80)),
    ItemUpdaterFactory::create(new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20)),
    ItemUpdaterFactory::create(new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49)),
    ItemUpdaterFactory::create(new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49)),
    // this conjured item does not work properly yet
    ItemUpdaterFactory::create(new Item('Conjured Mana Cake', 3, 6))
);
$app = new GildedRose($items);
$days = 2;
if (count($argv) > 1) {
    $days = (int) $argv[1];
}
for ($i = 0; $i < $days; $i++) {
    echo("-------- day $i --------\n");
    echo("name, sellIn, quality\n");
    foreach ($items as $item) {
        echo $item . PHP_EOL;
    }
    echo PHP_EOL;
    $app->updateQuality();
}