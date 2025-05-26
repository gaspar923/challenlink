<?php

use App\Application\UseCases\CreateItemUseCase;
use App\Domain\Services\ItemService;
use App\GildedRose;

/*
 * Your work begins on LINE 249.
 */

describe('Gilded Rose', function () {

    describe('#tick', function () {

        context('normal Items', function () {

            it('updates normal items before sell date', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('normal', 10, 5, 'normal');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(9);
                expect($sellIn)->toBe(4);
            });

            it('updates normal items on the sell date', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('normal', 10, 0, 'normal');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(8);
                expect($sellIn)->toBe(-1);
            });

            it('updates normal items after the sell date', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('normal', 10, -5, 'normal');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(8);
                expect($sellIn)->toBe(-6);
            });

            it('updates normal items with a quality of 0', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('normal', 0, 5, 'normal');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(0);
                expect($sellIn)->toBe(4);
            });
        });


        context('Brie Items', function () {

            it('updates Brie items before the sell date', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Aged Brie', 10, 5, 'brie');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(11);
                expect($sellIn)->toBe(4);
            });

            it('updates Brie items before the sell date with maximum quality', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Aged Brie', 50, 5, 'brie');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(50);
                expect($sellIn)->toBe(4);
            });

            it('updates Brie items on the sell date', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Aged Brie', 10, 0, 'brie');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(12);
                expect($sellIn)->toBe(-1);
            });

            it('updates Brie items on the sell date, near maximum quality', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Aged Brie', 49, 0, 'brie');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(50);
                expect($sellIn)->toBe(-1);
            });

            it('updates Brie items on the sell date with maximum quality', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Aged Brie', 50, 0, 'brie');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(50);
                expect($sellIn)->toBe(-1);
            });

            it('updates Brie items after the sell date', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Aged Brie', 10, -10, 'brie');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(12);
                expect($sellIn)->toBe(-11);
            });

            it('updates Briem items after the sell date with maximum quality', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Aged Brie', 50, -10, 'brie');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(50);
                expect($sellIn)->toBe(-11);
            });
        });


        context('Sulfuras Items', function () {

            it('updates Sulfuras items before the sell date', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Sulfuras, Hand of Ragnaros', 80, 5, 'sulfuras');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(80);
                expect($sellIn)->toBe(4);
            });

            it('updates Sulfuras items on the sell date', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Sulfuras, Hand of Ragnaros', 80, 5, 'sulfuras');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(80);
                expect($sellIn)->toBe(4);
            });

            it('updates Sulfuras items after the sell date', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Sulfuras, Hand of Ragnaros', 80, -1, 'sulfuras');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(80);
                expect($sellIn)->toBe(-2);
            });
        });


        context('Backstage Passes', function () {
            /*
                "Backstage passes", like aged brie, increases in Quality as it's SellIn
                value approaches; Quality increases by 2 when there are 10 days or
                less and by 3 when there are 5 days or less but Quality drops to
                0 after the concert
             */
            it('updates Backstage pass items long before the sell date', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Backstage passes to a TAFKAL80ETC concert', 10, 11, 'backstage');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(11);
                expect($sellIn)->toBe(10);
            });

            it('updates Backstage pass items close to the sell date', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Backstage passes to a TAFKAL80ETC concert', 10, 10, 'backstage');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(12);
                expect($sellIn)->toBe(9);
            });

            it('updates Backstage pass items close to the sell data, at max quality', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Backstage passes to a TAFKAL80ETC concert', 50, 10, 'backstage');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(50);
                expect($sellIn)->toBe(9);
            });

            it('updates Backstage pass items very close to the sell date', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Backstage passes to a TAFKAL80ETC concert', 10, 5, 'backstage');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(13); // goes up by 3
                expect($sellIn)->toBe(4);
            });

            it('updates Backstage pass items very close to the sell date, at max quality', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Backstage passes to a TAFKAL80ETC concert', 50, 5, 'backstage');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(50);
                expect($sellIn)->toBe(4);
            });

            it('updates Backstage pass items with one day left to sell', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Backstage passes to a TAFKAL80ETC concert', 10, 1, 'backstage');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(13);
                expect($sellIn)->toBe(0);
            });

            it('updates Backstage pass items with one day left to sell, at max quality', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Backstage passes to a TAFKAL80ETC concert', 50, 1, 'backstage');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(50);
                expect($sellIn)->toBe(0);
            });

            it('updates Backstage pass items on the sell date', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Backstage passes to a TAFKAL80ETC concert', 10, 0, 'backstage');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(0);
                expect($sellIn)->toBe(-1);
            });

            it('updates Backstage pass items after the sell date', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Backstage passes to a TAFKAL80ETC concert', 10, -1, 'backstage');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(0);
                expect($sellIn)->toBe(-2);
            });
        });


        context("Conjured Items", function () {

            it('updates Conjured items before the sell date', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Conjured Mana Cake', 10, 10, 'conjured');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(8);
                expect($sellIn)->toBe(9);
            });

            it('updates Conjured items at zero quality', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Conjured Mana Cake', 0, 10, 'conjured');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(0);
                expect($sellIn)->toBe(9);
            });

            it('updates Conjured items on the sell date', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Conjured Mana Cake', 10, 0, 'conjured');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(6);
                expect($sellIn)->toBe(-1);
            });

            it('updates Conjured items on the sell date at 0 quality', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Conjured Mana Cake', 0, 0, 'conjured');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(0);
                expect($sellIn)->toBe(-1);
            });

            it('updates Conjured items after the sell date', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Conjured Mana Cake', 10, -10, 'conjured');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(6);
                expect($sellIn)->toBe(-11);
            });

            it('updates Conjured items after the sell date at zero quality', function () {
                $service = new ItemService();
                $useCase = new CreateItemUseCase($service);
                $gildedRose = new GildedRose($useCase);

                $item = $gildedRose->of('Conjured Mana Cake', 0, -10, 'conjured');
                $item->tick();
                $quality = $item->getQuality()->getAmount();
                $sellIn = $item->getSellIn()->getAmount();

                expect($quality)->toBe(0);
                expect($sellIn)->toBe(-11);
            });
        });
    });
});
