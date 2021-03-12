<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\item;
use App\Models\transaction;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $data = array();
        $data['newTransaction'] = $this->getUnprocessedTransaction();
        $data['todayTransaction'] = transaction::whereDate('created_at', Carbon::today())->count();
        $data['total_item'] = item::count();
        $data['total_user'] = User::count();
        $data['item'] = item::get(['id', 'name', 'category_id']);
        $data['promo_item'] = item::whereNotNull('promo')->get();
        $data['promo_count'] = item::whereNotNull('promo')->count();

        // dd($data['promo_count']);
        return view('BackEnd.pages.dashboard', compact("data"));
    }

    public function getUnprocessedTransaction()
    {
        return transaction::where('status', "0")->count();
    }

    public function rupiah($angka)
    {
        $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
        return $hasil_rupiah;

    }

    public function kirimWhatsapp()
    {
        $promoItems = item::whereNotNull('promo')->get(['name', 'price', 'promo', 'stock']);
        // dd($promoItems[0]->name);
        // dd(rupiah(5000));
        $i = 1;
        $message = "*INFO PROMO!*\n\nBarang dengan *promo* hari ini:\n\n";
        foreach ($promoItems as $p) {
            $message .= $i . '. *' . $p->name . "*\n\t- Harga : " . $this->rupiah($p->price) . " -> " . $this->rupiah($p->promo) . "\n\t- Persediaan : " . $p->stock . "\n\n";
            $i++;
        };
        $message .= 'Untuk informasi lebih lanjut silahkan kunjungi: ' . env('FRONT_URL');
        $message = urlencode($message);

        $url = 'https://api.whatsapp.com/send?text=' . $message;
        return redirect($url);
    }

    public function hapusPromo($id)
    {
        $item = item::find($id);
        $item->promo = null;
        $item->save();

        return redirect(route('admin_index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus promo produk!');
    }
}
