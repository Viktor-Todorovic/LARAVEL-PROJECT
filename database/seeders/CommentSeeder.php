<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Product;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::first();
        $user2 = User::skip(1)->first();

        $product1 = Product::first();
        $product2 = Product::skip(1)->first();

        if (!$user1 || !$user2 || !$product1 || !$product2) {
            $this->command->info('Nema dovoljno korisnika ili proizvoda.');
            return;
        }

        $comment1 = new Comment();
        $comment1->user_id = $user1->id;
        $comment1->product_id = $product1->id;
        $comment1->title = "Odličan proizvod!";
        $comment1->comment = "Koristim ga već neko vreme i prezadovoljan sam.";
        $comment1->save();

        $comment2 = new Comment();
        $comment2->user_id = $user2->id;
        $comment2->product_id = $product1->id;
        $comment2->title = "Moglo je bolje";
        $comment2->comment = "Proizvod je u redu, ali isporuka je kasnila.";
        $comment2->save();

        $comment3 = new Comment();
        $comment3->user_id = $user1->id;
        $comment3->product_id = $product2->id;
        $comment3->title = "Top!";
        $comment3->comment = "Preporučujem svima koji vole kvalitet.";
        $comment3->save();

        $comment4 = new Comment();
        $comment4->user_id = $user1->id;
        $comment4->product_id = $product2->id;
        $comment4->title = "Vrhunski!";
        $comment4->comment = "Sve preporuke.";
        $comment4->save();

        $comment5 = new Comment();
        $comment5->user_id = $user2->id;
        $comment5->product_id = $product1->id;
        $comment5->title = "Odličan!";
        $comment5->comment = "Proizvod je odličan, ali cena je malo visoka.";
        $comment5->save();
    }
}
