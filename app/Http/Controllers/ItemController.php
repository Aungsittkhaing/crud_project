<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $items = Item::where("name", "LIKE", "%{$query}%")
            ->orWhere("status", "LIKE", "%{$query}%")
            ->paginate(5);
        return view('item.index', compact('items'));
    }
    public function index()
    {
        $items = Item::all();
        foreach ($items as $item) {
            $item->item_images = json_decode($item->item_images, true);
        }
        return view('item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('item.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'price' => 'required|integer',
        //     'stock' => 'required|integer',
        //     'image' => 'required',
        //     'category_id' => 'required',
        //     'status' => 'required',
        //     'description' => 'required'
        // ]);

        //single file upload
        // if ($request->image) {
        //     $file = $request->image;
        //     $newName = "item_image" . uniqid() . "." . $file->extension();
        //     $file->storeAs('public/itemImage', $newName);
        // }

        $images = [];
        if ($request->images) {
            foreach ($request->file('images') as $file) {
                $newName = "item_image" . uniqid() . "." . $file->extension();
                $file->storeAs('public/itemImage', $newName);
                $images[] = $newName;
            }
        }
        $item = new Item();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->category_id = $request->category_id;
        $item->status = $request->status;
        $item->description = $request->description;
        $item->item_images = json_encode($images);
        $item->save();
        return redirect()->route('item.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);
        return view('item.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::find($id);
        $item->item_images = json_decode($item->item_images, true);
        $categories = Category::all();
        return view('item.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request;
        // $request->validate([
        //     'name' => 'required',
        //     'price' => 'required|integer',
        //     'stock' => 'required|integer',
        //     'category_id' => 'required',
        //     'status' => 'required',
        //     'description' => 'required'
        // ]);
        // dd($request->all());
        $item = Item::find($id);
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->description = $request->description;
        $item->category_id = $request->category_id;
        $item->status = $request->status;

        //single file upload
        // if ($request->image) {
        //     $file = $request->image;
        //     $newName = "item_image" . uniqid() . "." . $file->extension();
        //     $file->storeAs('public/itemImage', $newName);
        //     $item->image = $newName;
        // }
        $images = [];
        if ($request->images) {
            foreach ($request->file('images') as $file) {
                $newName = "item_image" . uniqid() . "." . $file->extension();
                $file->storeAs('public/itemImage', $newName);
                $images[] = $newName;
            }
            $item->item_images = json_encode($images);
        }
        $item->update();

        return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);
        if ($item) {
            $item->delete();
            return back();
        }
    }
}
