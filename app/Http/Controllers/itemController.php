<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\item;
use App\Models\item_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class itemController extends Controller
{
    public function index($id)
    {
        $data = [];
        $data['category_id'] = $id;
        // $data['items'] = item::latest()->where('category_id', $id)->get();
        // $data['items'] = DB::select(DB::raw('SELECT items.*, item_images.path FROM items LEFT JOIN item_images ON items.id=item_images.item_id WHERE items.category_id=' . $id.' GROUP BY items.id'));
        $data['items'] = DB::select(DB::raw('SELECT items.*, (SELECT item_images.path FROM item_images WHERE item_images.item_id = items.id LIMIT 1) as path FROM items WHERE items.category_id=' . $id . ' AND items.deleted_at IS NULL ORDER BY id DESC'));
        return view('BackEnd.pages.items.index', compact("data"));
    }

    public function delete($id)
    {
        $images = item_image::where('item_id', $id)->get();
        $imgLength = count($images);
        for ($i = 0; $i < $imgLength; $i++) {
            Storage::delete('public/' . $images[$i]['path']);
        }
        item_image::where('item_id', $id)->delete();
        item::find($id)->delete();

        Session::flash('icon', 'success');
        Session::flash('title', 'Berhasil');
        Session::flash('text', 'item berhasil dihapus!');
        return response()->json([
            'status' => 'ok',
        ]);
    }

    public function addGet($id)
    {
        $data['category_id'] = $id;
        return view('BackEnd.pages.items.tambah', compact('data'));
    }

    public function addPost($id, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ]);

        $item = item::create([
            'name' => $request->name,
            'price' => str_replace('.', '', $request->price),
            'description' => $request->description,
            'stock' => $request->stock,
            'category_id' => $id
        ]);

        if ($request->hasFile('images')) {
            // dd($request->file('images')[0]);
            foreach ($request->file('images') as $file) {
                $photoName =  $item->id . '-' . rand() . substr(md5(time()), 0, 5) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/items/images', $photoName);
                item_image::create([
                    'name' => $photoName,
                    'path' => 'items/images/' . $photoName,
                    'item_id' => $item->id
                ]);
            }
        }

        return redirect(route('admin_list.item.category', ['id' => $id]))->with('icon', 'success')->with('title', 'Berhasil')->with('message', 'Berhasil menambahkan item.');
    }

    public function editGet($id, $id_item)
    {
        $data = [];
        $data['category_id'] = $id;
        $data['item'] = item::find($id_item);
        $data['images'] = item_image::where('item_id', $id_item)->pluck('path');
        $data['category'] = category::get();
        // return $data;
        $banyakGambar = count($data['images']);
        for ($i = 0; $i < $banyakGambar; $i++) {
            $data['images'][$i] = asset('storage') . '/' . $data['images'][$i];
        }
        return view('BackEnd.pages.items.edit', compact('data'));
    }

    public function editPost($id, $id_item, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ]);
        $images = json_decode($request->imagesList);
        $imagesName = [];
        foreach ($images as $image) {
            if (array_key_exists('name', $image)) {
                array_push($imagesName, $image->name);
            }
        }
        $deleteImage = item_image::where('item_id', $id_item)->whereNotIn('name', $imagesName)->get();
        foreach ($deleteImage as $image) {
            Storage::delete('public/' . $image->path);
        }
        item_image::where('item_id', $id_item)->whereNotIn('name', $imagesName)->delete();
        item::find($id_item)->update([
            'name' => $request->name,
            'price' => str_replace('.', '', $request->price),
            'description' => $request->description,
            'stock' => $request->stock,
            'category_id' => $request->category
        ]);

        if ($request->hasFile('images')) {
            // dd($request->file('images'));
            foreach ($request->file('images') as $file) {
                $photoName =  $id_item . '-' . rand() . substr(md5(time()), 0, 5) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/items/images', $photoName);
                item_image::create([
                    'name' => $photoName,
                    'path' => 'items/images/' . $photoName,
                    'item_id' => $id_item
                ]);
            }
        }

        return redirect(route('admin_list.item.category', ['id' => $id]))->with('icon', 'success')->with('title', 'Berhasil')->with('message', 'Berhasil mengedit item.');
    }
}
