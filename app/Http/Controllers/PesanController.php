<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PesanController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('created_at', 'DESC')->get();
        $pesans = Pesan::with('menu')->get();
        return view('pesan', compact('menus', 'pesans'));
    }


    public function tambah(Request $request)
    {
        $vD = $request->validate([
            'pesans' => 'required|array',
            'pesans.*.id_menu' => 'required|exists:menus,id',
            'pesans.*.quantity' => 'required|integer|min:1',
        ]);
        DB::beginTransaction();
        try {
            foreach ($vD['pesans'] as $pesanData) {
                $menu = Menu::findOrFail($pesanData['id_menu']);

                // Cek jika jumlah yang dipesan lebih dari jumlah yang tersedia
                if ($pesanData['quantity'] > $menu->jumlah) {
                    DB::rollBack();
                    return redirect()->back()->with(['error' => 'Jumlah pesanan melebihi stok menu.']);
                }

                // Kurangi jumlah menu
                $menu->jumlah -= $pesanData['quantity'];
                $menu->save();

                // Simpan data pesanan
                Pesan::create([
                    'id_menu' => $pesanData['id_menu'],
                    'quantity' => $pesanData['quantity'],
                ]);
            }

            // Commit transaksi
            DB::commit();

            return redirect()->back()->with('simpan', 'Pesanan telah berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            // Tangani exception jika ada kesalahan lain
            return redirect()->back()->with(['error' => 'Terjadi kesalahan, pesanan gagal disimpan.']);
        }
    }

    public function hapus($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->delete();

        return redirect()->back()->with('hapus', 'Pesanan telah dihapus!');
    }
}
