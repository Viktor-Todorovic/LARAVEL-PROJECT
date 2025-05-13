<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $c1 = new Category();
        $c1->id= 1;
        $c1->name = 'Majice';
        $c1->description = 'Majice veoma su udobne';
        $c1->save();
    
        $c2 = new Category();
        $c2->id= 2;
        $c2->name = 'Pantalone';
        $c2->description = 'Pantalone veoma su udobne';
        $c2->save();
    
        $c3 = new Category();
        $c3->id= 3;
        $c3->name = 'Kosulje';
        $c3->description = 'Kosulje veoma su udobne';
        $c3->save();

        $c4 = new Category();
        $c4->id= 4;
        $c4->name = 'Dukserice';
        $c4->description = 'Raznovrsna ponuda dukserica';
        $c4->save();

        $c5 = new Category();
        $c5->id= 5;
        $c5->name = 'Trenerke';
        $c5->description = 'Sportske trenerke';
        $c5->save();

        $p1 = new Product();
        $p1->name = 'Majica';
        $p1->description = 'Crvena majica';
        $p1->price = 1000;
        $p1->promo = 'da';
        $p1->category_id = 1;
        $p1->image = 'images/majica.jpg';
        $p1->save();

        $p2 = new Product();
        $p2->name = 'Pantalone';
        $p2->description = 'Pantalone sa printom';
        $p2->price = 2000;
        $p2->promo = 'da';
        $p2->category_id = 2;
        $p2->image = 'images/pantalone2.png';
        $p2->save();

        $p3 = new Product();
        $p3->name = 'Plava kosulja';
        $p3->description = 'Prelepa plava kosulja za svaku priliku';
        $p3->price = 3000;
        $p3->promo = 'da';
        $p3->category_id = 3;
        $p3->image = 'images/kosulja.jpg';
        $p3->save();

        $p4 = new Product();
        $p4->name = 'Raznobojna dukserica';
        $p4->description = 'Dukserica sa printom';
        $p4->price = 2000;
        $p4->promo = 'ne';
        $p4->category_id = 4;
        $p4->image = 'images/duks.jpg';
        $p4->save();

        $p5 = new Product();
        $p5->name = 'Trenerka';
        $p5->description = 'Sportska trenerka';
        $p5->price = 2500;
        $p5->promo = 'da';
        $p5->category_id = 5;
        $p5->image = 'images/trenerka.jpg';
        $p5->save();

        $p6 = new Product();
        $p6->name = 'Superman majica';
        $p6->description = 'Dečija majica sa printom superheroja';
        $p6->price = 3500;
        $p6->promo = 'ne';
        $p6->category_id = 1;
        $p6->image = 'images/supermen.jpg';
        $p6->save();


        
    }
}
