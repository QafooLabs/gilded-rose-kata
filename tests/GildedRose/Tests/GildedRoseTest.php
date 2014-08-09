<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param array $items
     * @param $days
     * @param array $expectedItems
     *
     * #@dataProvider dataProvider
     */
    public function testProgramWithoutItems(array $items, $days, array $expectedItems)
    {
        $program = new Program($items);

        $program->UpdateQuality();

        $result = $program->getItems();

        $this->assertEquals($expectedItems, $result);
    }

    public function dataProvider()
    {
        return array(
            'No items' => array(
                'items'     => array(),
                'days'      => 1,
                'result'    => array(),

            ),
            'Main Test' => array(
                'items' => array(
                    new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 10,'quality' => 20)),
                    new Item(array( 'name' => "Aged Brie",'sellIn' => 2,'quality' => 0)),
                    new Item(array( 'name' => "Aged Brie",'sellIn' => 0,'quality' => 1)),
                    new Item(array( 'name' => "Elixir of the Mongoose",'sellIn' => 5,'quality' => 7)),
                    new Item(array( 'name' => "Sulfuras, Hand of Ragnaros",'sellIn' => 0,'quality' => 80)),
                    new Item(array(
                            'name' => "Backstage passes to a TAFKAL80ETC concert",
                            'sellIn' => 15,
                            'quality' => 20
                        )
                    ),
                    new Item(array(
                            'name' => "Backstage passes to a TAFKAL80ETC concert",
                            'sellIn' => 8,
                            'quality' => 20
                        )
                    ),
                    new Item(array(
                            'name' => "Backstage passes to a TAFKAL80ETC concert",
                            'sellIn' => 5,
                            'quality' => 20
                        )
                    ),
                    new Item(array(
                            'name' => "Backstage passes to a TAFKAL80ETC concert",
                            'sellIn' => 0,
                            'quality' => 20
                        )
                    ),
                    new Item(array('name' => "Conjured Mana Cake",'sellIn' => 3,'quality' => 6)),
                    new Item(array('name' => "Conjured Mana Cake",'sellIn' => 0,'quality' => 6)),
                ),
                'days'      => 1,
                'result'    => array(
                    new Item(array( 'name' => "+5 Dexterity Vest",'sellIn' => 9,'quality' => 19)),
                    new Item(array( 'name' => "Aged Brie",'sellIn' => 1,'quality' => 1)),
                    new Item(array( 'name' => "Aged Brie",'sellIn' => -1,'quality' => 3)),
                    new Item(array( 'name' => "Elixir of the Mongoose",'sellIn' => 4,'quality' => 6)),
                    new Item(array( 'name' => "Sulfuras, Hand of Ragnaros",'sellIn' => 0,'quality' => 80)),
                    new Item(array(
                            'name' => "Backstage passes to a TAFKAL80ETC concert",
                            'sellIn' => 14,
                            'quality' => 21
                        )
                    ),
                    new Item(array(
                            'name' => "Backstage passes to a TAFKAL80ETC concert",
                            'sellIn' => 7,
                            'quality' => 22
                        )
                    ),
                    new Item(array(
                            'name' => "Backstage passes to a TAFKAL80ETC concert",
                            'sellIn' => 4,
                            'quality' => 23
                        )
                    ),
                    new Item(array(
                            'name' => "Backstage passes to a TAFKAL80ETC concert",
                            'sellIn' => -1,
                            'quality' => 0
                        )
                    ),
                    new Item(array('name' => "Conjured Mana Cake",'sellIn' => 2,'quality' => 4)),
                    new Item(array('name' => "Conjured Mana Cake",'sellIn' => -1,'quality' => 2)),
                ),
            ),
        );
    }
}

