<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\item;
use App\Models\transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = array();
        $data['newTransaction'] = $this->getUnprocessedTransaction();
        $data['todayTransaction'] = transaction::whereDate('created_at', Carbon::today())->count();
        $data['total_item'] = item::count();
        $data['total_user'] = User::count();
        return view('BackEnd.pages.dashboard', compact("data"));
    }

    public function getUnprocessedTransaction()
    {
        return transaction::where('status', "0")->count();
    }
}
