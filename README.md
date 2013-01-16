# Gilded Rose Kata for PHP

Port of the Gilded Rose Kata for C# (https://github.com/NotMyself/GildedRose)

## Install

* Git Checkout: git clone https://github.com/qafoo/gilded-rose-kata
* Generate Autoloader: composer dump-autoload
* Run tests with "phpunit"

## Introduction

Hi and welcome to team Gilded Rose. As you know, we are a small inn with a
prime location in a prominent city ran by a friendly innkeeper named Allison.
We also buy and sell only the finest goods. Unfortunately, our goods are
constantly degrading in quality as they approach their sell by date. We have a
system in place that updates our inventory for us. It was developed by a
no-nonsense type named Leeroy, who has moved on to new adventures. Your task is
to add the new feature to our system so that we can begin selling a new
category of items. First an introduction to our system:

- All items have a SellIn value which denotes the number of days we have to
sell the item
- All items have a Quality value which denotes how valuable the
item is 
- At the end of each day our system lowers both values for every item

Pretty simple, right? Well this is where it gets interesting:

- Once the sell by date has passed, Quality degrades twice as fast 
- The Quality of an item is never negative 
- "Aged Brie" actually increases in Quality the older it gets
- The Quality of an item is never more than 50
- "Sulfuras", being a legendary item, never has to be sold or decreases in
Quality
- "Backstage passes", like aged brie, increases in Quality as it's
SellIn value approaches; Quality increases by 2 when there are 10 days or less
and by 3 when there are 5 days or less but Quality drops to 0 after the concert

We have recently signed a supplier of conjured items. This requires an update
to our system:

- "Conjured" items degrade in Quality twice as fast as normal items

Feel free to make any changes to the UpdateQuality method and add any new code
as long as everything still works correctly. However, do not alter the Item
class or Items property as those belong to the goblin in the corner who will
insta-rage and one-shot you as he doesn't believe in shared code ownership (you
can make the UpdateQuality method and Items property static if you like, we'll
cover for you). Your work needs to be completed by Friday, February 18, 2011
08:00:00 AM PST.

Just for clarification, an item can never have its Quality increase above 50,
however "Sulfuras" is a legendary item and as such its Quality is 80 and it
never alters.

## Task

Start Refactoring this legacy code to emerge into a TDD design, keeping
the requirements that are already covered by the project. Start
implementing tests for the already known dependencies, then start refactoring
the code to be SOLID.

## Complexity

The GildedRose UpdateQuality() method has a very high complexity and is very 
useful to teach refactoring and testing of legacy code:

- The method UpdateQuality() has a Cyclomatic Complexity of 19. The configured cyclomatic complexity threshold is 10.
- The method UpdateQuality() has an NPath complexity of 211. The configured NPath complexity threshold is 200.

