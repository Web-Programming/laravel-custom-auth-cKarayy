<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends BaseController
{
    public function index(){
        $prodis = Prodi::all();
        $success['data'] = $prodis;
        return $this->sendResponse($prodis, "Data Prodi");
    }

     public function store(Request $request){
        // dump($request);
        // echo $request->nama;

        $this->authorize('create', Prodi::class);

        $validateData = $request->validate([
            'nama' => 'required|min:5|max:20',
            'foto' => 'required|file|image|max:5000',
            //atau
            //'file_lain' => 'required|file|mimes:pdf,png|max:5000',
        ]);
        // dump($validateData);
        // echo $validateData['nama'];

        //ambil ekstensi file
        $ext = $request->foto->getClientOriginalExtension();

        //rename nama file
        $nama_file = "foto" . time() . "." . $ext;
        $path = $request->foto->storeAs('public', $nama_file);

        $prodi = new Prodi(); //buat objek prodi
        $prodi->nama = $validateData['nama']; //simpna nilai input ke properti nama prodi
        $prodi->foto = $nama_file;

        if($prodi -> save()){
            $success['data'] = $prodi;
            return $this->sendResponse($success, 'Data Prodi berhasil disimpan.');
        } else {
            return $this->sendError('Error.', ['error' => 'Data Prodi gagal disimpan.']);
        }
    }

     public function update(Request $request, $id){
        $validateData = $request->validate([
            'nama' => 'required|min:5|max:20',
            'foto' => 'required|file|image|max:20'
            ]);

            $ext = $request->foto->getClientOriginalExtension();
            $nama_file = "foto-" . time() . "." . $ext;
            $path = $request->foto->storeAs('public', $nama_file);

            $prodi = Prodi::find($id);
            $prodi->nama = $validateData['nama'];
            $prodi->foto = $nama_file;

        if($prodi -> save()){
            $success['data'] = $prodi;
            return $this->sendResponse($success, 'Data Prodi berhasil diperbarui.');
        } else {
            return $this->sendError('Error.', ['error' => 'Data Prodi gagal diperbarui.']);
        }
    }

    public function delete($id){
        $prodi = Prodi::findOrFail($id);

    if($prodi -> save()){
            $success['data'] = $prodi;
            return $this->sendResponse($success, "Data Prodi dengan id $id dihapus.");
        } else {
            return $this->sendError('Error.', ['error' => 'Data Prodi gagal dihapus.']);
        }
    }
}
