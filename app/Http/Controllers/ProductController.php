<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
   public function index(Request $request)
{
    $products = Product::query();

    // SEARCH (biar search + sort bisa barengan)
    if ($request->q) {
        $products->where('name', 'like', '%' . $request->q . '%');
    }

    // SORT
    if ($request->sort === 'price_asc') {
        $products->orderBy('price', 'asc');
    } elseif ($request->sort === 'price_desc') {
        $products->orderBy('price', 'desc');
    } else {
        // DEFAULT = LATEST
        $products->orderBy('created_at', 'desc');
    }

    return view('products.index', [
        'products' => $products->get(),
        'query' => $request->q
    ]);
}


    public function search(Request $request)
    {
        $query = $request->input('q');
        
        // Search products dari database
        if ($query) {
            $products = Product::search($query)->get();
        } else {
            $products = Product::latest()->get();
        }

        return view('products.index', compact('products', 'query'));
    }

    public function show($id)
    {
        // Ambil product detail dari database
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    // HAPUS method byCategory() karena tidak perlu
}