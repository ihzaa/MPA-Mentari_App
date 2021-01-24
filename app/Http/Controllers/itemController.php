<?php

namespace App\Http\Controllers;

use App\Models\item;
use App\Models\item_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class itemController extends Controller
{
    public function index($id)
    {
        $data = [];
        $data['category_id'] = $id;
        // $data['items'] = item::latest()->where('category_id', $id)->get();
        $data['items'] = DB::select(DB::raw('SELECT items.*, item_images.path FROM items LEFT JOIN item_images ON items.id=item_images.item_id WHERE items.category_id=' . $id));
        return view('BackEnd.pages.items.index', compact("data"));
    }

    public function delete($id)
    {
        $images = item_image::where('item_id', $id)->get();
        $imgLength = count($images);
        for ($i = 0; $i < $imgLength; $i++) {
            Storage::delete($images['path']);
        }
        item_image::where('item_id', $id)->delete();
        item::find($id)->delete();

        return response()->json(["terhapus" => "ok"])->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'item berhasil dihapus!');
    }
}
