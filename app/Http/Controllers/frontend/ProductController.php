<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products
     */
    public function index(Request $request)
    {
        $query = Product::with('kategori')->aktif()->tersedia();

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        if ($sortBy === 'harga') {
            $query->orderBy('harga', $sortOrder);
        } elseif ($sortBy === 'nama') {
            $query->orderBy('nama', $sortOrder);
        } else {
            $query->orderBy('created_at', $sortOrder);
        }

        $products = $query->paginate(12);
        $kategoris = Kategori::withCount('products')->get();

        return view('home.products.index', compact('products', 'kategoris'));
    }

    /**
     * Display the specified product
     */
    public function show(Product $product)
    {
        // Load relasi kategori
        $product->load('kategori');
        
        // Produk terkait dari kategori yang sama
        $relatedProducts = Product::with('kategori')
            ->where('kategori_id', $product->kategori_id)
            ->where('id', '!=', $product->id)
            ->aktif()
            ->tersedia()
            ->take(4)
            ->get();

        return view('home.products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Search products via AJAX
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $products = Product::with('kategori')
            ->where('nama', 'like', "%{$query}%")
            ->aktif()
            ->tersedia()
            ->take(10)
            ->get();

        return response()->json($products);
    }
}