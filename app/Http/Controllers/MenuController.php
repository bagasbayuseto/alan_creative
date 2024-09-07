<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
    protected $NT = 'Menu masakan telah berhasil diproses dan ';
    public function index()
    {
        $menus = Menu::orderBy('created_at', 'DESC')->get();
        return view('welcome', compact('menus'));
    }

    public function tambah(Request $request)
    {
        $vD = $request->validate([
            'foto' => 'mimes:jpeg,png,jpg|max:2048',
            'nama_menu' => 'required|string',
            'harga' => 'required|string',
            'jumlah' => 'required|string',
        ]);
        $mn = new Menu;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $imageNamefile = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('asset/images/menu'), $imageNamefile);
            $mn->foto = $imageNamefile;
        }
        $mn->nama_menu = $vD['nama_menu'];
        $mn->harga = $vD['harga'];
        $mn->jumlah = $vD['jumlah'];
        $mn->save();

        return redirect()->back()->with('simpan', $this->NT . 'ditambahkan!');
    }

    public function ubah(Request $request, $id)
    {
        $vD = $request->validate([
            'foto' => 'mimes:jpeg,png,jpg|max:2048',
            'nama_menu' => 'required|string',
            'harga' => 'required|string',
            'jumlah' => 'required|string',
        ]);

        $mn = Menu::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($mn->foto && File::exists(public_path('asset/images/menu/' . $mn->foto))) {
                File::delete(public_path('asset/images/menu/' . $mn->foto));
            }

            $foto = $request->file('foto');
            $ext = $foto->getClientOriginalExtension();
            $imageNamefile = time() . '.' . $ext;
            $foto->move(public_path('asset/images/menu'), $imageNamefile);
            $mn->foto = $imageNamefile;
        }

        $mn->nama_menu = $vD['nama_menu'];
        $mn->harga = $vD['harga'];
        $mn->jumlah = $vD['jumlah'];
        $mn->save();

        return redirect()->back()->with('ubah', $this->NT . 'diperbaharui!');
    }

    public function hapus($id)
    {
        $mn = Menu::findOrFail($id);
        if ($mn->foto && File::exists(public_path('asset/images/menu/' . $mn->foto))) {
            File::delete(public_path('asset/images/menu/' . $mn->foto));
        }
        $mn->delete();

        return redirect()->back()->with('hapus', $this->NT . 'dihapus!');
    }
}
