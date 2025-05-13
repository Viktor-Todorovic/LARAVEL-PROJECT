<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CommentController extends Controller
{
    public function create()
{
    $products = Product::all();
    return view('admin.comments.create', compact('products'));
}

public function store(Request $request, Product $product)
{

    $request->validate([
        'title' => 'required|string|max:255',
        'comment' => 'required|string',
    ]);


    $comment = new Comment();
    $comment->product_id = $product->id;  
    $comment->user_id = Auth::id();
    $comment->title = $request->title;
    $comment->comment = $request->comment;
    $comment->save();

    // Preusmeravanje sa uspešnim porukama
    return back()->with('success', 'Komentar je uspešno dodat.');
}




public function insert(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'title' => 'required|string|max:255',
        'comment' => 'required|string',
    ], [
        'product_id.required' => 'Proizvod je obavezan.',
        'product_id.exists' => 'Izabrani proizvod nije validan.',
        'title.required' => 'Naslov je obavezan.',
        'title.max' => 'Naslov ne sme biti duži od 255 karaktera.',
        'comment.required' => 'Komentar je obavezan.',
    ]);

    $comment = new Comment();
    $comment->product_id = $request->product_id;
    $comment->user_id = Auth::id();
    $comment->title = $request->title;
    $comment->comment = $request->comment;
    $comment->save();

    return redirect()->route('admin.comments.list')->with('success', 'Komentar je uspešno dodat.');
}

    public function list()
    {
        $comments = Comment::with('product', 'user')->latest()->get();
        return view('admin.comments.list', compact('comments'));
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $products = Product::all(); 
        return view('admin.comments.edit', compact('comment', 'products'));
    }

    public function update(Request $request, $id)
{

    $request->validate([
    'title' => 'required|string|max:255',
    'comment' => 'required|string',
], [
    'title.required' => 'Naslov je obavezan.',
    'title.max' => 'Naslov ne sme biti duži od 255 karaktera.',
    'comment.required' => 'Komentar je obavezan.',
]);


    $comment = Comment::findOrFail($id);


    $comment->title = $request->input('title');
    $comment->comment = $request->input('comment');


    $comment->save();


    return redirect()->route('admin.comments.edit', ['id' => $id])
                     ->with('success', 'Komentar uspešno ažuriran.');
}


    public function delete($id)
    {
        Comment::findOrFail($id)->delete();
        return redirect()->route('admin.comments.list')->with('success', 'Komentar obrisan.');
    }
}


