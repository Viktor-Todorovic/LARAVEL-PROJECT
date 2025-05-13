<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('product.category', [
            'category' => $category,
            'categories' => Category::all()
        ]);
    }
}
