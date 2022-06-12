<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Redirect;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::orderBy('created_at', 'desc')->paginate(10);
        return view('transaksi.index', ['transaksi' => $transaksi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        $user = User::all();
        return view('transaksi.form', [
            'kelas' => $kelas,
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'jumlah' => 'required|numeric',
            'peserta' => 'required|numeric'
        ]);

        $transaksi = Transaksi::make($request->except('kelas_id'));

        switch ($request->peserta) {
            case 1: // semua
                $transaksi->wajib_semua = 1;
                break;
            case 2: // hanya kelas
                $transaksi->kelas_id = $request->kelas_id;
                break;
            case 3: // user , make role
                $transaksi->save();
                foreach ($request->siswa_id as $user_id) {
                    $transaksi->user()->save(User::find($user_id));
                }
                break;
            default:
                return Redirect::back()->withErrors(['Peserta Wajib diisi']);
        }

        if ($transaksi->save()) {
            return redirect()->route('transaksi.index')->with([
                'type' => 'success',
                'msg' => 'Item Transaksi ditambahkan'
            ]);
        } else {
            return redirect()->route('transaksi.index')->with([
                'type' => 'danger',
                'msg' => 'Err.., Terjadi Kesalahan'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        $kelas = Kelas::all();
        $user = User::all();
        return view('transaksi.form', [
            'kelas' => $kelas,
            'user' => $user,
            'transaksi' => $transaksi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'jumlah' => 'required|numeric',
            'peserta' => 'required|numeric'
        ]);

        $transaksi->fill($request->except('kelas_id'));

        //remove all related
        // $transaksi->user()->detach();
        $transaksi->kelas_id = null;
        $transaksi->wajib_semua = null;

        switch ($request->peserta) {
            case 1: // semua
                $transaksi->wajib_semua = 1;
                break;
            case 2: // hanya kelas
                $transaksi->kelas_id = $request->kelas_id;
                break;
            case 3: // user , make role
                foreach ($request->siswa_id as $user_id) {
                    $transaksi->user()->save(User::find($user_id));
                }
                break;
            default:
                return Redirect::back()->withErrors(['Peserta Wajib diisi']);
        }

        if ($transaksi->save()) {
            return redirect()->route('transaksi.index')->with([
                'type' => 'success',
                'msg' => 'Item Transaksi diubah'
            ]);
        } else {
            return redirect()->route('transaksi.index')->with([
                'type' => 'danger',
                'msg' => 'Err.., Terjadi Kesalahan'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        // if ($transaksi->transaksi->count() != 0) {
        //     return redirect()->route('transaksi.index')->with([
        //         'type' => 'danger',
        //         'msg' => 'tidak dapat menghapus transaksi yang masih memiliki transaksi'
        //     ]);
        // }
        // $transaksi->user()->detach();
        if ($transaksi->delete()) {
            return redirect()->route('transaksi.index')->with([
                'type' => 'success',
                'msg' => 'transaksi telah dihapus'
            ]);
        }
    }
}
