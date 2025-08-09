<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class UpdateCartPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update existing cart items that don't have price and subtotal
        $carts = Cart::with('product')
            ->whereNull('price')
            ->orWhereNull('subtotal')
            ->get();

        foreach ($carts as $cart) {
            if ($cart->product) {
                $cart->update([
                    'price' => $cart->product->harga,
                    'subtotal' => $cart->quantity * $cart->product->harga
                ]);
            }
        }

        $this->command->info('Cart prices and subtotals updated successfully!');
    }
}