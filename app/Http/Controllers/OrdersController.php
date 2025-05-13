<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    
   public function store(Request $request, Product $product)
{
    $request->validate([
        'kolicina' => 'required|integer|min:1',
        'message' => 'nullable|string|max:1000',
    ], [
        'kolicina.required' => 'Polje za količinu je obavezno.',
        'kolicina.integer' => 'Količina mora biti broj.',
        'kolicina.min' => 'Količina mora biti bar 1.',
        'message.max' => 'Napomena ne sme biti duža od 1000 karaktera.',
    ]);

    $order = new Order();
    $order->user_id = Auth::id();
    $order->product_id = $product->id;
    $order->quantity = $request->input('kolicina');
    $order->message = $request->input('message');
    $order->save();

    return redirect()->back()->with('success', 'Uspešno ste poručili proizvod!');
}

   
    public function list()
    {
        $orders = Order::with('user', 'product')->latest()->get();
        return view('admin.orders.list', compact('orders'));
    }


    
    public function create()
{
    $products = Product::all(); 
    return view('admin.orders.create', compact('products'));
}

    public function insert(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id', 
        'quantity' => 'required|integer|min:1',
        'message' => 'nullable|string|max:1000',
    ], [
        'product_id.required' => 'Proizvod je obavezan.',
        'product_id.exists' => 'Izabrani proizvod ne postoji.',
        'quantity.required' => 'Polje za količinu je obavezno.',
        'quantity.integer' => 'Količina mora biti broj.',
        'quantity.min' => 'Količina mora biti bar 1.',
        'message.max' => 'Napomena ne sme biti duža od 1000 karaktera.',
    ]);

    $order = new Order();
    $order->user_id = Auth::id();  
    $order->product_id = $request->input('product_id');  
    $order->quantity = $request->input('quantity');  
    $order->message = $request->input('message');  
    $order->save();

    return redirect()->route('admin.orders.list')->with('success', 'Porudžbina uspešno dodata!');
}


    
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $products = Product::all();
        $users = User::all();
        return view('admin.orders.edit', compact('order', 'products', 'users'));
    }

    
   public function update(Request $request, $id)
{
 
    $request->validate([
        'quantity' => 'required|integer|min:1',
        'message' => 'nullable|string|max:1000',
    ], [
        'quantity.required' => 'Polje količina je obavezno.',
        'quantity.integer' => 'Količina mora biti broj.',
        'quantity.min' => 'Količina mora biti najmanje 1.',
        'message.max' => 'Napomena ne može imati više od 1000 karaktera.',
    ]);

    $order = Order::findOrFail($id);
    $order->quantity = $request->input('quantity');
    $order->message = $request->input('message');
    $order->save();

    return redirect()->route('admin.orders.edit', ['id' => $id])
                     ->with('success', 'Porudžbina je uspešno ažurirana.');
}



    
    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.list')->with('success', 'Porudžbina je uspešno obrisana.');
    }


    public function ordersChart()
    {
        $ordersPerDate = Order::selectRaw('DATE(created_at) as date, COUNT(*) as total_orders')
                            ->groupBy('date')
                            ->orderBy('date')
                            ->get();

        return view('admin.index', compact('ordersPerDate'));
    }




}
