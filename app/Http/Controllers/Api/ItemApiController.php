<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        if ($request) {
            $item = Item::where('name', 'LIKE', "%{$request->name}%")
                ->orWhere('price', 'LIKE', $request->price)
                ->where('stock', 'LIKE', $request->stock)
                ->get();

            return response()->json([
                'item' => $item,
                'message' => 'success',
            ]);
        }
        return response()->json([
            'message' => 'Not found search data',
        ]);
    }
    public function index()
    {
        $items = Item::with('category')->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'stock' => $item->stock,
                'description' => $item->description,
                'status' => $item->status,
                'category' => $item->category->name,
                'image' => $item->item_images,
            ];
        });
        // $items = Item::with('category')->get();
        return response()->json([
            'items' => $items,
            'message' => 'success',
            'statusCode' => 200
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $images = [];
        if ($request->item_images) {
            foreach ($request->file('item_images') as $file) {
                $newName = "item_image" . uniqid() . "." . $file->extension();
                $file->storeAs('public/itemImage', $newName);
                $images[] = $newName;
            }
        }

        $item = new Item();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->description = $request->description;
        $item->category_id = $request->category_id;
        $item->status = $request->status;
        $item->item_images = json_encode($images);
        $item->save();

        return response()->json([
            'message' => 'item is successfully stored',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json([
                'message' => 'item not found',
            ]);
        }
        return response()->json([
            'id' => $item->id,
            'name' => $item->name,
            'price' => $item->price,
            'stock' => $item->stock,
            'description' => $item->description,
            'status' => $item->status,
            'category' => $item->category->name,
            'image' => $item->item_images,
            'message' => 'success',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $request;
        $item = Item::find($id);
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->description = $request->description;
        $item->category_id = $request->category_id;
        $item->status = $request->status;

        $images = [];
        if ($request->images) {
            return $request->file('images');
            foreach ($request->file('images') as $file) {
                $newName = "item_image" . uniqid() . "." . $file->extension();
                $file->storeAs('public/itemImage', $newName);
                $images[] = $newName;
            }
            $item->item_images = json_encode($images);
        }
        $item->update();

        return response()->json([
            'message' => 'item is successfully updated',
            'status' => '200',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //to delete in public folder
        $item = Item::find($id);
        if ($item) {
            $images = json_decode($item->item_images);
            if ($images) {
                foreach ($images as $image) {
                    Storage::delete('public/itemImage/' . $image);
                }
            }
            //to delete in database
            $item->delete();
        }
        return response()->json([
            'message' => 'item is successfully deleted',
        ]);
    }
}
