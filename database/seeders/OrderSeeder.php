<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $user1 = User::find(1);
        $user2 = User::find(2);

        $product1 = Product::find(1);
        $product2 = Product::find(2);
        $product3 = Product::find(3);

        if (!$user1 || !$user2 || !$product1 || !$product2) {
            echo "Nema dovoljno korisnika ili proizvoda u bazi. Ubaci ih pre ovoga.\n";
            return;
        }

        $order1 = new Order();
        $order1->user_id = $user1->id;
        $order1->product_id = $product1->id;
        $order1->quantity = 2;
        $order1->message = "Molim vas spakujte kao poklon.";
        $order1->save();

        $order2 = new Order();
        $order2->user_id = $user2->id;
        $order2->product_id = $product2->id;
        $order2->quantity = 1;
        $order2->message = "Dostava što pre, hvala!";
        $order2->save();

        $order3 = new Order();
        $order3->user_id = $user1->id;
        $order3->product_id = $product3->id;
        $order3->quantity = 3;
        $order3->message = "Za porodični poklon.";
        $order3->save();

        $order3 = new Order();
        $order3->user_id = $user1->id;
        $order3->product_id = $product1->id;
        $order3->quantity = 5;
        $order3->message = "Treba mi za firmu.";
        $order3->save();
    }
}
