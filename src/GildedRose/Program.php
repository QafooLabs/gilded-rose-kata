<?php

namespace GildedRose;

/**
 * Hi and welcome to team Gilded Rose.
 *
 * As you know, we are a small inn with a prime location in a prominent city
 * ran by a friendly innkeeper named Allison. We also buy and sell only the
 * finest goods. Unfortunately, our goods are constantly degrading in quality
 * as they approach their sell by date. We have a system in place that updates
 * our inventory for us. It was developed by a no-nonsense type named Leeroy,
 * who has moved on to new adventures. Your task is to add the new feature to
 * our system so that we can begin selling a new category of items. First an
 * introduction to our system:
 *
 * - All items have a SellIn value which denotes the number of days we have to sell the item
 * - All items have a Quality value which denotes how valuable the item is
 * - At the end of each day our system lowers both values for every item
 *
 * Pretty simple, right? Well this is where it gets interesting:
 *
 * - Once the sell by date has passed, Quality degrades twice as fast
 * - The Quality of an item is never negative
 * - "Aged Brie" actually increases in Quality the older it gets
 * - The Quality of an item is never more than 50
 * - "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
 * - "Backstage passes", like aged brie, increases in Quality as it's SellIn
 *   value approaches; Quality increases by 2 when there are 10 days or less and
 *   by 3 when there are 5 days or less but Quality drops to 0 after the concert
 *
 * We have recently signed a supplier of conjured items. This requires an
 * update to our system:
 *
 * - "Conjured" items degrade in Quality twice as fast as normal items
 *
 * Feel free to make any changes to the UpdateQuality method and add any new
 * code as long as everything still works correctly. However, do not alter the
 * Item class or Items property as those belong to the goblin in the corner who
 * will insta-rage and one-shot you as he doesn't believe in shared code
 * ownership (you can make the UpdateQuality method and Items property static
 * if you like, we'll cover for you).
 *
 * Just for clarification, an item can never have its Quality increase above
 * 50, however "Sulfuras" is a legendary item and as such its Quality is 80 and
 * it never alters.
 */
class Program
{
    private $items = array();

    public static function Main()
    {
        echo "HELLO\n";

        $app = new Program(array(
              new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 10,'quality' => 20)),
              new Item(array( 'name' => "Aged Brie",'sellIn' => 2,'quality' => 0)),
              new Item(array( 'name' => "Elixir of the Mongoose",'sellIn' => 5,'quality' => 7)),
              new Item(array( 'name' => "Sulfuras, Hand of Ragnaros",'sellIn' => 0,'quality' => 80)),
              new Item(array(
                     'name' => "Backstage passes to a TAFKAL80ETC concert",
                     'sellIn' => 15,
                     'quality' => 20
              )),
              new Item(array('name' => "Conjured Mana Cake",'sellIn' => 3,'quality' => 6)),
        ));

        $app->UpdateQuality();

        echo sprintf("%50s - %7s - %7s\n", "Name", "SellIn", "Quality");
        foreach ($app->items as $item) {
            echo sprintf("%50s - %7d - %7d\n", $item->name, $item->sellIn, $item->quality);
        }
    }

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function UpdateQuality()
    {
        for ($i = 0; $i < count($this->items); $i++) {
            $item = $this->items[$i];
            if (!$this->isSulfurasItem($item)) {
                $this->updateItem($item);
            }
        }
    }

    /**
     * @return Item[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Update quality and sellIn of Item.
     *
     * @param Item $item
     */
    private function updateItem(Item $item)
    {
        $item->sellIn = $item->sellIn - 1;

        if ($this->isAgedBrieItem($item)) {
            $this->updateQualityOfAgedBrieItem($item);
        } elseif ($this->isBackstagePassesItem($item)) {
            $this->updateQualityOfBackstagePassesItem($item);
        } elseif ($this->isConjuredItem($item)) {
            $this->updateQualityOfConjuredItem($item);
        } else {
            $this->updateQualityOfNormalItem($item);
        }
    }

    /**
     * @param Item $item
     */
    private function updateQualityOfNormalItem(Item $item)
    {
        $this->decrementQuality($item);

        if ($this->hasSellDatePassed($item)) {
            $this->decrementQuality($item);
        }
    }

    /**
     * @param Item $item
     */
    private function updateQualityOfBackstagePassesItem(Item $item)
    {
        if ($this->hasSellDatePassed($item)) {
            $item->quality = 0;
            return;
        }

        $this->incrementQuality($item);

        if ($item->sellIn < 11) {
            $this->incrementQuality($item);
        }

        if ($item->sellIn < 6) {
            $this->incrementQuality($item);
        }
    }

    /**
     * @param Item $item
     */
    private function updateQualityOfAgedBrieItem(Item $item)
    {
        $this->incrementQuality($item);

        if ($this->hasSellDatePassed($item)) {
            $this->incrementQuality($item);
        }
    }

    /**
     * @param Item $item
     */
    private function updateQualityOfConjuredItem(Item $item)
    {
        $this->updateQualityOfNormalItem($item);
        $this->updateQualityOfNormalItem($item);
    }

    /**
     * @param Item $item
     * @return bool
     */
    private function isAgedBrieItem(Item $item)
    {
        return $item->name == "Aged Brie";
    }

    /**
     * @param Item $item
     * @return bool
     */
    private function isConjuredItem(Item $item)
    {
        return false !== strpos($item->name, 'Conjured');
    }

    /**
     * @param Item $item
     * @return bool
     */
    private function isBackstagePassesItem(Item $item)
    {
        return false !== strpos($item->name, 'Backstage');
    }

    /**
     * @param Item $item
     * @return bool
     */
    private function isSulfurasItem(Item $item)
    {
        return false !== strpos($item->name, 'Sulfuras');
    }

    /**
     * @param Item $item
     */
    private function incrementQuality(Item $item)
    {
        $item->quality = min($item->quality + 1, 50);
    }

    /**
     * @param Item $item
     */
    private function decrementQuality(Item $item)
    {
        $item->quality = max($item->quality - 1, 0);
    }

    /**
     * @param Item $item
     * @return bool
     */
    private function hasSellDatePassed(Item $item)
    {
        return $item->sellIn < 0;
    }
}
