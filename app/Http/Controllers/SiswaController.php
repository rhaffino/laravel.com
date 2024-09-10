<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    function tampil() {
        $siswa = Siswa::get();
        return view('siswa.tampil', compact('siswa'));
    }

    function tambah() {
        return view('siswa.tambah');
    }

    function submit(Request $request) {   
        if (Siswa::where('nis', $request->nis)->exists()) {
            return redirect()->back()->with('error', 'NIS sudah digunakan, harap menggunakan NIS yang berbeda.');
      }
    
        $siswa = new Siswa();
        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->alamat = $request->alamat;
        $siswa->no_hp = $request->no_hp;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->hobi = $request->hobi;
        $siswa->save();

        return redirect()->route('siswa.tampil')->with('succes', 'Data siswa berhasi disimpan');
    }

    function edit($id) {
        $siswa = Siswa::find($id);
        return view('siswa.edit', compact('siswa'));
    }

    function update(Request $request, $id) {
        if (Siswa::where('nis', $request->nis)->where('id', '!=', $id)->exists()) {
            return redirect()->back()->with('error', 'NIS sudah digunakan oleh siswa lain, harap menggunakan NIS yang berbeda.');
    }

        $siswa = Siswa::find($id);
        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->alamat = $request->alamat;
        $siswa->no_hp = $request->no_hp;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->hobi = $request->hobi;
        $siswa->update();

        return redirect()->route('siswa.tampil')->with('success', 'Data siswa berhasil diupdate');
    }

    function delete($id){
        $siswa = Siswa::find($id);
        $siswa->delete();
        return redirect()->route('siswa.tampil');
    }

    

    
    

}
