<?php

use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\ItemUpdater\Factory\ItemUpdaterFactory;

require_once 'vendor/autoload.php';

echo "OMGHAI!\n";
$items = array(
    ItemUpdaterFactory::create('+5 Dexterity Vest', 10, 20),
    ItemUpdaterFactory::create('Aged Brie', 2, 0),
    ItemUpdaterFactory::create('Elixir of the Mongoose', 5, 7),
    ItemUpdaterFactory::create('Sulfuras, Hand of Ragnaros', 0, 80),
    ItemUpdaterFactory::create('Sulfuras, Hand of Ragnaros', -1, 80),
    ItemUpdaterFactory::create('Backstage passes to a TAFKAL80ETC concert', 15, 20),
    ItemUpdaterFactory::create('Backstage passes to a TAFKAL80ETC concert', 10, 49),
    ItemUpdaterFactory::create('Backstage passes to a TAFKAL80ETC concert', 5, 49),
    // this conjured item does not work properly yet
    ItemUpdaterFactory::create('Conjured Mana Cake', 3, 6)
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