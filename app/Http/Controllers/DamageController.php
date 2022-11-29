<?php

namespace App\Http\Controllers;

use App\Models\Damage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class DamageController extends Controller
{

    //menampilkan data pada halaman Index customer
    public function index(Request $request)
    {
        //mengecek request
        if ($request->ajax()) {
            //select data Damage atau kerusakan dari database
            $data = Damage::all();
            //menampilkan data Damage ke dalam dataTable
            return DataTables::of($data)->addIndexColumn()
                //membuat kolom baru berupa tombol aksi untuk setiap record pada dataTable
                ->addColumn('action', function ($data) {
                    $button = '   <a href="kerusakan/detail/' . $data->id . '" name="show" id="' . $data->id . '" class="show nutton btn btn-warning btn-sm mx-1"> <i class="bi bi-eye"></i> Show</a>';
                    $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i> Edit</button>';
                    $button .= '   <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm "> <i class="bi bi-trash"></i> Delete</button>';
                    return $button;
                })
                ->make(true);
        }

        // mengarahkan aplikasi ke halaman kerusakan dengan variable title
        return view('admin.kerusakan.Kerusakan', [
            "title" => "Kerusakan"
        ]);
    }

    //Aksi yang berguna untuk melakukan penambah data atau insert data ke database
    public function tambah(Request $request)
    {
        //melakukan validasi untuk setiap field yang ada pada form tambah
        $request->validate([
            'nama' => 'required',
            'kondisi' => 'required',
            'jenis' => 'required',
        ]);

        //pengecekan jenis untuk menentukan prefix id 
        ($request->jenis == 'Kesalahan Pabrik') ?  $prefix = 'P' : $prefix = 'C';

        //membuat id berdasarkan prefix jenis kerusakan
        $id = IdGenerator::generate(['table' => 'damages', 'length' => 4, 'prefix' => $prefix, 'reset_on_prefix_change' => false]);

        //menampung semua field pada form tambah pada sebuah array
        $form_data = array(
            'id' => $id,
            'nama' => $request->nama,
            'kondisi' => $request->kondisi,
            'jenis' => $request->jenis,
        );

        //melakukan insert data array
        Damage::create($form_data);

        //mengembalikan pesan sukses apabila proses insert data berhasil dilakukan
        return response()->json([
            'success' => 'Data berhasil di tambah',
        ]);
    }

    //mengambil data berdasarkan id untuk ditampilkan pada edit data
    public function edit($id)
    {
        if (request()->ajax()) {
            //mengambil data kerusakan berdasarkan id
            $data = Damage::findOrFail($id);
            //menampung data dalam bentuk json
            return response()->json(['result' => $data]);
        }
    }

    //fungsi update data
    public function update(Request $request)
    {
        //validasi data harus diisi
        $request->validate([
            'nama' => 'required',
            'kondisi' => 'required'
        ]);

        //menampung data baru dalam sebuah array
        $form_data = array(
            'nama' => $request->nama,
            'kondisi' => $request->kondisi
        );

        //mengupdate data array berdasarkan id
        Damage::whereId($request->hidden_id)->update($form_data);

        //mengembalikan pesan sukses saat data berhasil diupdate
        return response()->json([
            'success' => 'Data berhasil di update.',
            'url' => route('kerusakan.index')
        ]);
    }

    //menghapus data berdasarkan id
    public function hapus($id)
    {
        //mencari data pada tabel berdasarkan id
        $data = Damage::findOrFail($id);
        //menghapus data
        $data->delete();

        //mengembalikan pesan sukses saat data berhasil dihapus
        return response()->json([
            'success' => 'Data berhasil diHapus'
        ]);
    }

    //menampilkan halaman detail berdasarkan data kerusakan
    public function detail(Damage $damage)
    {
        //mengarahkan ke halaman detail dengan beberapa variable data
        return view('admin.kerusakan.detailKerusakan', [
            'title' => 'Detail Kerusakan',
            'damage' => $damage
        ]);
    }

    //mengupdate data pada halaman detail kerusakan
    public function detailUpdate(Request $request)
    {
        //validasi data harus diisi
        $request->validate([
            'nama' => 'required',
            'kondisi' => 'required'
        ]);

        //menampung data dalam sebuah array
        $form_data = array(
            'nama' => $request->nama,
            'kondisi' => $request->kondisi
        );

        //mengupdate data array berdasarkan id
        Damage::whereId($request->hidden_id)->update($form_data);

        //jika berhasil maka akan mengarahkan tampilan ke halaman kerusakan index dengan pesan success
        return redirect()->route('kerusakan.index')
            ->with('success', 'Data berhasil di update');
    }

    //menghapus data pada halaman detail kerusakan
    public function detailHapus($id)
    {
        //mencari data pada tabel damage berdasarkan id
        $data = Damage::findOrFail($id);
        //menghapus data
        $data->delete();

        //jika berhasil maka akan mengembalikan tampikan ke halaman kerusakan index dengan pesan success
        return redirect()->route('kerusakan.index')
            ->with("success", "Data berhasil dihapus.");
    }
}
