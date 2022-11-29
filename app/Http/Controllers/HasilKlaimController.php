<?php

namespace App\Http\Controllers;

use App\Models\ClaimResult;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HasilKlaimController extends Controller
{
    //menampilkan data pada halaman Index Hasil Klaim
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //select data Hasil Klaim dari database
            $data = ClaimResult::all();
            //menampilkan data hasil kalim ke dalam dataTable
            return DataTables::of($data)->addIndexColumn()
                //membuat kolom baru berupa tombol aksi untuk setiap record pada dataTable
                ->addColumn('action', function ($data) {
                    $button = '   <a href="hasil-klaim/detail/' . $data->id . '" name="show" id="' . $data->id . '" class="show nutton btn btn-warning btn-sm mx-1"> <i class="bi bi-eye"></i> Show</a>';
                    $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i> Edit</button>';
                    $button .= '   <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm "> <i class="bi bi-trash"></i> Delete</button>';
                    return $button;
                })
                ->make(true);
        }

        // mengarahkan aplikasi untuk memanggil halaman hasil klaim
        return view('admin.hasilKlaim.hasilKlaim', [
            "title" => "Hasil Klaim"
        ]);
    }
    //Aksi yang berguna untuk melakukan penambah data atau insert data ke database
    public function tambah(Request $request)
    {
        //validasi data harus diisi
        $request->validate([
            'nama_hasil' => 'required',
        ]);

        //menampung data field pada form tambah pada sebuah array
        $form_data = array(
            'nama_hasil' => $request->nama_hasil,
        );

        //melakukan insert data array
        ClaimResult::create($form_data);

        //mengembalikan pesan sukses apabila proses insert data berhasil dilakukan
        return response()->json(['success' => 'Data berhasil disimpan']);
    }

    //mengambil data berdasarkan id untuk ditampilkan pada edit data
    public function edit($id)
    {
        if (request()->ajax()) {
            //mengambil data ClaimResult berdasarkan id
            $data = ClaimResult::findOrFail($id);
            //menampung data dalam bentuk json
            return response()->json(['result' => $data]);
        }
    }

    //fungsi update data
    public function update(Request $request)
    {
        //validasi data harus diisi
        $request->validate([
            'nama_hasil' => 'required',
        ]);

        //menampung data baru dalam sebuah array
        $form_data = array(
            'nama_hasil' => $request->nama_hasil,
        );

        //mengupdate data array berdasarkan id
        ClaimResult::whereId($request->hidden_id)->update($form_data);

        //mengembalikan pesan sukses saat data berhasil diupdate
        return response()->json([
            'success' => 'Data berhasil di update'
        ]);
    }

    //menghapus data berdasarkan id
    public function hapus($id)
    {
        //mencari data pada tabel berdasarkan id
        $data = ClaimResult::findOrFail($id);
        //menghapus data
        $data->delete();
    }


    //menampilkan halaman detail berdasarkan id
    public function detail($id)
    {
        //mencari data pada tabel berdasarkan id
        $data = ClaimResult::findOrFail($id);

        //mengarahkan ke halaman detail dengan beberapa variable data
        return view('admin.hasilKlaim.detailHasilKlaim', [
            'title' => 'Detail Hasil Klaim',
            'ClaimResult' => $data
        ]);
    }

    //menghapus data pada halaman detail Hasil Klaim
    public function detailHapus($id)
    {
        //mencari data pada tabel berdasarkan id
        $data = ClaimResult::findOrFail($id);
        //menghapus data
        $data->delete();
        //jika berhasil maka akan mengembalikan tampikan ke halaman Hasil Klaim index dengan pesan success
        return redirect()->route('hasilKlaim.index')->with('success', 'Data berhasil dihapus.');
    }

    //mengupdate data pada halaman detail Hasil Klaim
    public function detailUpdate(Request $request)
    {
        //validasi data harus diisi
        $request->validate([
            'nama_hasil' => 'required',
        ]);

        //menampung data dalam sebuah array
        $form_data = array(
            'nama_hasil' => $request->nama_hasil,
        );

        //mengupdate data array berdasarkan id
        ClaimResult::whereId($request->hidden_id)->update($form_data);

        //jika berhasil maka akan mengarahkan tampilan ke halaman hasil Klaim index dengan pesan success
        return redirect()->route('hasilKlaim.index')->with('success', 'Data berhasil di update.');
    }
}
