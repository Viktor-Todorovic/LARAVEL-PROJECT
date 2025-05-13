<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
{
    $products = Product::where('promo', 'da')->get();

    return view('product.index', [
        'products' => $products,
        'categories' => Category::all()
    ]);
}


    public function contact()
    {
        $products = Product::all();
        return view('partials.contact',[
            'products' => $products,
            'categories' => Category::all()
        ]);
    }

    public function about()
    {
        $products = Product::all();
        return view('partials.about',[
            'products' => $products,
            'categories' => Category::all()
        ]);
    }

    public function show($product_id)
    {
        $product = Product::findOrFail($product_id);
        return view('product.show', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    public function list()
    {
        $products = Product::all();
        return view('admin.products.list', [
            'products' => $products,
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        return view('admin.products.create', [
            'categories' => Category::all()
        ]);
    }

    public function insert(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|min:3|max:255',
        'description' => 'required|string|min:3',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'image' => 'required|image|max:2048',
    ], [
        'required' => 'Polje :attribute je obavezno.',
        'min' => 'Polje :attribute mora imati najmanje :min karaktera.',
        'max' => 'Polje :attribute ne sme imati više od :max karaktera.',
        'numeric' => 'Polje :attribute mora biti broj.',
        'image' => 'Fajl mora biti slika.',
        'exists' => 'Izabrana vrednost za :attribute nije validna.',
    ]);

    $product = new Product();
    $product->name = $validated['name'];
    $product->description = $validated['description'];
    $product->price = $validated['price'];
    $product->category_id = $validated['category_id'];

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        $product->image = 'images/' . $filename;
    }
    
    $product->promo = $request->has('promo') ? 'da' : 'ne';
    $product->save();

    return redirect()->route('admin.products.list')->with('success', 'Proizvod uspešno dodat!');
}


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }
   public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => ['required', 'string', 'min:3', 'max:255'],
        'description' => ['required', 'string', 'min:3'],
        'price' => ['required', 'numeric', 'min:0'],
        'category_id' => ['required', 'exists:categories,id'],
        'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        'promo' => ['nullable'],
    ], [
        'required' => 'Polje :attribute je obavezno.',
        'string' => 'Polje :attribute mora biti tekst.',
        'min' => 'Polje :attribute mora imati najmanje :min karaktera.',
        'max' => 'Polje :attribute ne sme imati više od :max karaktera.',
        'numeric' => 'Polje :attribute mora biti broj.',
        'image' => 'Fajl mora biti slika.',
        'mimes' => 'Slika mora biti JPEG, PNG, JPG ili GIF formata.',
        'exists' => 'Izabrana vrednost za :attribute nije validna.',
    ]);

    $product = Product::findOrFail($id);
    $product->name = $validatedData['name'];
    $product->description = $validatedData['description'];
    $product->price = $validatedData['price'];
    $product->category_id = $validatedData['category_id'];

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        $product->image = 'images/' . $filename;
    }

    $product->promo = $request->has('promo') ? 'da' : 'ne';
    $product->save();

    return redirect()->route('admin.products.edit', ['id' => $id])
                     ->with('success', 'Proizvod uspešno izmenjen!');
}



    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.list')->with('success', 'Proizvod uspešno obrisan!');
    }


}
