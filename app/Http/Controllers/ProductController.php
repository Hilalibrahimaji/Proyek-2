<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil semua t-shirts dari database
        $products = Product::latest()->get();

        return view('products.index', compact('products'));
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