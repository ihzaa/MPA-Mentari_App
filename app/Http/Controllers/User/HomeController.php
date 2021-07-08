<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data = array();
        $data['carousel'] = poster::all();
        $data['carousel-count'] = poster::count();
        $data['category'] = category::get(['id', 'name']);
        $data['searchValue'] = $request->search;
        // $data['categoryValue'] = $request->categoryValue;
        $data['categoryId'] = $request->categoryValue;

        // dd($data['categoryValue']);

        if ($request->search == null && $request->categoryValue == null) {
            $data['product'] = DB::select(DB::raw('SELECT items.id AS item_id,items.name,items.price,items.promo,items.description,items.stock,categories.id AS category_id, categories.name AS category_name, (SELECT item_images.path FROM item_images WHERE item_images.item_id = items.id ORDER BY item_images.id LIMIT 1) AS path FROM items JOIN categories ON items.category_id = categories.id WHERE items.deleted_at IS NULL ORDER BY items.updated_at DESC LIMIT 15'));

            if ($request->ajax()) {
                $product = DB::select(DB::raw('SELECT items.id AS item_id,items.name,items.price,items.promo,items.description,items.stock,categories.id AS category_id, categories.name AS category_name, (SELECT item_images.path FROM item_images WHERE item_images.item_id = items.id ORDER BY item_images.id LIMIT 1) AS path FROM items JOIN categories ON items.category_id = categories.id WHERE items.id > ' . $request->lastId . '  AND items.deleted_at IS NULL ORDER BY items.updated_at DESC LIMIT 15'));

                if (count($product) == 0) {
                    return ['data' => '', 'lastId' => -1];
                }
                $response = '';

                foreach ($product as $p) {
                    $response .=
                        '<div class="card product-card my-2 p-3 mx-1" data-aos="zoom-in-up">';
                    if ($p->promo != null) {
                        $response .= '<div class="ribbon ribbon-top-right">
                                    <span>Promo</span>
                                </div>';
                    }
                    if ($p->path != null) {
                        $response .= '<img width="100%" class="card-img-top" height="200"
                                    src="{{ asset("storage/" . $p->path) }}" top></img>';
                    } else {
                        $response .= '<img class=" card-img-top" width=" 100%"
                                    height="200" src="/frontend/images/no-image-available.png"
                                    style="border: 1px solid lightgray">
                                </img>';
                    }
                    $response .= '<div class="header card-header text-center" tag="header">
                                <h5>
                                    <strong>' . $p->name . '</strong>
                                </h5>
                                <p style="margin-bottom: -10px">
                                    ' . $p->category_name . '
                                </p>
                            </div>
                            <div class="card-body">';

                    if (strlen($p->description) < 140) {
                        $response .= '<div class="card-text info">
                                        ' . $p->description . '
                                    </div>';
                    } else {
                        $response .= '<div class="card-text info">
                                        ' . substr($p->description, 0, 140) . "..." . '
                                    </div>';
                    }
                    if ($p->promo == null) {
                        $response .= '<div class="harga card-text text-right" style="line-height:10px">
                                        <p>Rp. ' . number_format($p->price, 0, ',', '.') . '</p>
                                    </div>';
                    } else {
                        $response .= '<div class="harga card-text text-right">
                                        <p>Rp. ' . number_format($p->promo, 0, ',', '.') . '</p>
                                        <p style="font-size:14px; margin-top:-20px">
                                            <s class="text-danger">Rp. ' . number_format($p->price, 0, ',', '.') . '</s>
                                        </p>
                                    </div>';
                    }
                    $response .= '</div>
                            <div class="card-footer card-footer d-flex justify-content-between" tag="footer">';

                    if ($p->stock != 0) {
                        $response .= '<div class="btn btn-primary">
                                        <i class="fas fa-shopping-cart" style="width: 20px; height: 20px">
                                        </i>
                                    </div>';
                    } else {
                        $response .= '<div class="btn btn-secondary disabled">
                                        <i class="fas fa-shopping-cart" style="width: 20px; height: 20px">
                                        </i>
                                    </div>';
                    }
                    if ($p->stock != 0) {
                        $response .= '<div class="persediaan text-center" style="margin-top:10px">
                                        <p style="line-height:2px">
                                            Persediaan
                                        </p>
                                        <p style="line-height:2px">
                                            <strong>' . $p->stock . '</strong>
                                        </p>
                                    </div>';
                    } else {
                        $response .= '<div class="persediaan text-center" style="margin-top:10px">
                                        <p style="line-height:2px">
                                            Persediaan
                                        </p>
                                        <p style="line-height:2px">
                                            <strong class="text-danger">Kosong</strong>
                                        </p>
                                    </div>';
                    }
                    $response .= '</div></div>';

                }

                return ['data' => $response, 'lastId' => $product[count($product) - 1]->item_id];
            }

        } elseif ($request->search != null && $request->categoryValue == null) {
            $data['product'] = DB::select(DB::raw('SELECT items.id AS item_id,items.name,items.price,items.promo,items.description,items.stock,categories.id AS category_id, categories.name AS category_name, (SELECT item_images.path FROM item_images WHERE item_images.item_id = items.id ORDER BY item_images.id LIMIT 1) AS path FROM items JOIN categories ON items.category_id = categories.id WHERE items.name LIKE "%' . $request->search . '%" ORDER BY items.updated_at DESC'));

        } elseif ($request->search == null && $request->categoryValue != null) {
            $data['product'] = DB::select(DB::raw('SELECT items.id AS item_id,items.name,items.price,items.promo,items.description,items.stock,categories.id AS category_id, categories.name AS category_name, (SELECT item_images.path FROM item_images WHERE item_images.item_id = items.id ORDER BY item_images.id LIMIT 1) AS path FROM items JOIN categories ON items.category_id = categories.id WHERE items.category_id = ' . $request->categoryValue . ' ORDER BY items.updated_at DESC'));

            $data['categoryValue'] = category::where('id', $request->categoryValue)->first('name');
        } elseif ($request->search != null && $request->categoryValue != null) {
            $data['product'] = DB::select(DB::raw('SELECT items.id AS item_id,items.name,items.price,items.promo,items.description,items.stock,categories.id AS category_id, categories.name AS category_name, (SELECT item_images.path FROM item_images WHERE item_images.item_id = items.id ORDER BY item_images.id LIMIT 1) AS path FROM items JOIN categories ON items.category_id = categories.id WHERE items.name LIKE "%' . $request->search . '%" AND items.category_id = ' . $request->categoryValue . ' ORDER BY items.updated_at DESC'));

            $data['categoryValue'] = category::where('id', $request->categoryValue)->first('name');
        }

        return view('FrontEnd.pages.home', compact('data'));
    }

    // public function search(Request $request)
    // {
    //     if ($request->name == '') {
    //         return redirect(route('user.home'));
    //     } else {
    //         $data['product'] = DB::select(DB::raw('SELECT items.id AS item_id,items.name,items.price,items.description,items.stock,categories.id AS category_id, categories.name AS category_name, (SELECT item_images.path FROM item_images WHERE item_images.item_id = items.id ORDER BY item_images.id LIMIT 1) AS path FROM items JOIN categories ON items.category_id = categories.id WHERE items.name LIKE "%' . $request->name . '%" ORDER BY items.updated_at DESC'));
    //     }

    //     return view('FrontEnd.pages.home', compact('data'));
    // }
}
