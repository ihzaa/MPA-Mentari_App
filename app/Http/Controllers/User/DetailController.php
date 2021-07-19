<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\item_image;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
    public function index($id)
    {
        $data['detail'] = DB::select(DB::raw('SELECT items.id AS item_id,items.name,items.price,items.promo,items.description,items.stock, categories.name AS category_name FROM items JOIN categories ON items.category_id = categories.id WHERE items.id = ' . $id));
        $data['image'] = item_image::where('item_id', $id)->get(['id', 'path']);

        // dd($data);
        return view('FrontEnd.pages.detail', compact('data'));
    }
}
