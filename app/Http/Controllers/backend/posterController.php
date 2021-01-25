<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\poster;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class posterController extends Controller
{
     public function getPoster()
    {
        $data = array();
        $data['poster'] = poster::all();
        return view('BackEnd.pages.poster',compact('data'));
    }

    public function addPoster(Request $request)
    {
        $this->validate($request, [
            'image' => [ 'image', 'max:500'],
            'judulPoster' => 'required',
            'deskripsiPoster' => 'required'
        ]);

        $poster = poster::create([
            'title' => $request->judulPoster,
            'description' => $request->deskripsiPoster
        ]);

        if ($request->file('image') != "") {
            $extension = $request->file('image')->getClientOriginalExtension();
            $nameUpload = 'Image-' . $poster->id . '.' . $extension;
            $request->file('image')->storeAs('public/images/poster', $nameUpload);
            $poster->image = 'images/poster/' . $nameUpload;
        }

        $poster->save();

        return redirect(route('admin_poster_get'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menambahkan poster.');
    }

    public function editPoster($id, Request $request)
    {
        $this->validate($request, [
            'image' => [ 'image', 'max:500'],
            'judulPoster' => 'required',
            'deskripsiPoster' => 'required'
        ]);

        $poster = poster::find($id);

        $poster->title = $request->judulPoster;
        $poster->description = $request->deskripsiPoster;

        if ($request->file('image') != "") {
            Storage::delete('public/'.$poster->image);
            $extension = $request->file('image')->getClientOriginalExtension();
            $nameUpload = 'Image-' . $poster->id . '.' . $extension;
            $request->file('image')->storeAs('public/images/poster', $nameUpload);
            $poster->image = 'images/poster/' . $nameUpload;
        }
        $poster->save();

        return redirect(route('admin_poster_get'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil mengubah data poster.');
    }

    public function hapusPoster($id)
    {
        $path = poster::find($id);
        Storage::delete('public/'.$path->image);
        poster::find($id)->delete();

        return redirect(route('admin_poster_get'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus poster!');
    }
}
