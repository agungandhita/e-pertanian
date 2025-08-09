<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display cart items
     */
    public function index()
    {
        $cartItems = Cart::with('product.kategori')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum('subtotal');

        return view('home.cart.index', compact('cartItems', 'total'));
    }

    /**
     * Add product to cart
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        
        // Check if product is available
        if (!$product->isAvailable($request->quantity)) {
            Alert::error('Error', 'Produk tidak tersedia atau stok tidak mencukupi!');
            return back();
        }

        // Check if item already exists in cart
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            // Update quantity
            $newQuantity = $cartItem->quantity + $request->quantity;
            
            if (!$product->isAvailable($newQuantity)) {
                Alert::error('Error', 'Stok tidak mencukupi untuk jumlah yang diminta!');
                return back();
            }
            
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            // Create new cart item
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $product->harga
            ]);
        }

        Alert::success('Berhasil', 'Produk berhasil ditambahkan ke keranjang!');
        return back();
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, Cart $cart)
    {
        // Check if cart belongs to current user
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Check if product is available
        if (!$cart->product->isAvailable($request->quantity)) {
            Alert::error('Error', 'Stok tidak mencukupi!');
            return back();
        }

        $cart->update(['quantity' => $request->quantity]);

        Alert::success('Berhasil', 'Keranjang berhasil diperbarui!');
        return back();
    }

    /**
     * Remove item from cart
     */
    public function destroy(Cart $cart)
    {
        // Check if cart belongs to current user
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        Alert::success('Berhasil', 'Item berhasil dihapus dari keranjang!');
        return back();
    }

    /**
     * Clear all cart items
     */
    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();

        Alert::success('Berhasil', 'Keranjang berhasil dikosongkan!');
        return back();
    }

    /**
     * Get cart count for AJAX
     */
    public function count()
    {
        $count = Cart::where('user_id', Auth::id())->sum('quantity');
        return response()->json(['count' => $count]);
    }

    /**
     * Add to cart via AJAX
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        
        // Check if product is available
        if (!$product->isAvailable($request->quantity)) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak tersedia atau stok tidak mencukupi!'
            ]);
        }

        // Check if item already exists in cart
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            // Update quantity
            $newQuantity = $cartItem->quantity + $request->quantity;
            
            if (!$product->isAvailable($newQuantity)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi untuk jumlah yang diminta!'
                ]);
            }
            
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            // Create new cart item
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $product->harga
            ]);
        }

        $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang!',
            'cart_count' => $cartCount
        ]);
    }
}