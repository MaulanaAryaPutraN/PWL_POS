<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileUpload(){
        return view('file-upload');
    }



    public function prosesFileUpload(Request $request){
        $request->validate([
            'berkas' => 'required|file|image|max:500',
            'image_name' => 'required|string',
        ]);
        $extfile = $request->berkas->getClientOriginalExtension();
        $namaFile = $request->input('image_name') . '.' . $extfile;

        $path = $request->berkas->move('gambar', $namaFile);
        echo "Gambar berhasil diupload ke <a href='$path' target='_blank'>$namaFile</a>";
        echo "<br> <br>";
        echo "Tampilkan gambar: <br> <img src='$path'>";
    }
}
