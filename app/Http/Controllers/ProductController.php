<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Retrieve all products
        $products = Product::all();
        $category = Category::all();
        // Return Inertia response, passing data to the Vue component
        return Inertia::render('Menu', [
            'products' => $products,
            'category' => $category,
        ]);
    }

    public function display()
    {
        // Retrieve all products
        $products = Product::all();
        $category = Category::all();
        // Return Inertia response, passing data to the Vue component
        return Inertia::render('CustomerDashboard', [
            'products' => $products,
            'category' => $category,
        ]);
    }
    
    public function search(Request $request){
        $query = $request->input('q');
        $products = Product::where('name', 'like', '%' . $query . '%')->get();

        return response()->json($products);
    }
}
