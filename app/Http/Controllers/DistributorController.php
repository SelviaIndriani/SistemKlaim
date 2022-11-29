<?php


namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DistributorController extends Controller
{
    //menampilkan data pada halaman Index Distributor
    public function index(Request $request)
    {
        //mengecek request
        if ($request->ajax()) {
            //select data distributor dari database
            $data = Distributor::all();
            //menampilkan data distributor ke dalam dataTable
            return DataTables::of($data)->addIndexColumn()
                //membuat kolom baru berupa tombol aksi untuk setiap record pada dataTable
                ->addColumn('action', function ($data) {
                    $button = '   <a href="distributor/detail/' . $data->id . '" name="show" id="' . $data->id . '" class="show nutton btn btn-warning btn-sm mx-1"> <i class="bi bi-eye"></i> Show</a>';
                    $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i> Edit</button>';
                    $button .= '   <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm "> <i class="bi bi-trash"></i> Delete</button>';
                    return $button;
                })
                ->make(true);
        }

        // mengarahkan aplikasi untuk menuju halaman distributor
        return view('admin.distributor.Distributor', [
            "title" => "Distributor"
        ]);
    }

    //Aksi yang berguna untuk melakukan penambah data atau insert data ke database
    public function tambah(Request $request)
    {
        //melakukan validasi untuk setiap field yang ada pada form tambah distributor
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required|max:13',
        ]);

        //menampung semua field pada form tambah pada sebuah array
        $form_data = array(
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        );

        //melakukan insert data array
        Distributor::create($form_data);

        //mengembalikan pesan sukses apabila proses insert data berhasil dilakukan
        return response()->json([
            'success' => 'Data berhasil disimpan'
        ]);
    }


    //mengambil data berdasarkan id untuk ditampilkan pada edit data
    public function edit($id)
    {
        if (request()->ajax()) {
            //mengambil data distributor berdasarkan id
            $data = Distributor::findOrFail($id);
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
            'alamat' => 'required',
            'telp' => 'required|max:13',
        ]);

        //menampung data baru dalam sebuah array
        $form_data = array(
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        );

        //mengupdate data array berdasarkan id
        Distributor::whereId($request->hidden_id)->update($form_data);

        //mengembalikan pesan sukses saat data berhasil diupdate
        return response()->json([
            'success' => 'Data berhasil di update'
        ]);
    }

    //menghapus data berdasarkan id
    public function hapus($id)
    {
        //mencari data pada tabel berdasarkan id
        $data = Distributor::findOrFail($id);
        //menghapus data
        $data->delete();
    }


    //menampilkan halaman detail berdasarkan data distributor
    public function detail(Distributor $distributor)
    {
        //mengarahkan ke halaman detail dengan beberapa variable data
        return view('admin.distributor.detailDist', [
            'title' => 'Detail Distributor',
            'distributor' => $distributor
        ]);
    }

    //menghapus data pada halaman detail distributor
    public function detailHapus($id)
    {
        //mencari data pada tabel distributor berdasarkan id
        $data = Distributor::findOrFail($id);
        //menghapus data
        $data->delete();
        //jika berhasil maka akan mengembalikan tampikan ke halaman distributor index dengan pesan success
        return redirect()->route('distributor.index')->with('success', 'Data berhasil dihapus.');
    }

    //mengupdate data pada halaman detail distributor
    public function detailUpdate(Request $request)
    {
        //validasi data harus diisi
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required|max:13',
        ]);

        //menampung data dalam sebuah array
        $form_data = array(
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        );

        //mengupdate data array berdasarkan id
        Distributor::whereId($request->hidden_id)->update($form_data);

        //jika berhasil maka akan mengarahkan tampilan ke halaman distributor index dengan pesan success
        return redirect()->route('distributor.index')->with('success', 'Data berhasil di update.');
    }
}
