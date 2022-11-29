<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Distributor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CustomerController extends Controller
{
    //menampilkan data pada halaman Index customer
    public function index(Request $request)
    {
        //mengecek request
        if ($request->ajax()) {
            //select data customer dari database
            $data = Customer::all();
            //menampilkan data customer ke dalam dataTable
            return DataTables::of($data)->addIndexColumn()
                //membuat kolom baru berupa tombol aksi untuk setiap record pada dataTable
                ->addColumn('action', function ($data) {
                    $button = '   <a href="customer/detail/' . $data->id . '" name="show" id="' . $data->id . '" class="show nutton btn btn-warning btn-sm mx-1"> <i class="bi bi-eye"></i> Show</a>';
                    $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i> Edit</button>';
                    $button .= '   <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm "> <i class="bi bi-trash"></i> Delete</button>';
                    return $button;
                })
                ->make(true);
        }
        // mengarahkan aplikasi untuk memanggil halaman customer
        return view('admin.pelanggan.customer', [
            "title" => "Pelanggan",
            "distributor" => Distributor::all()
        ]);
    }

    //Aksi yang berguna untuk melakukan penambah data atau insert data ke database
    public function tambah(Request $request)
    {
        //melakukan validasi untuk setiap field yang ada pada form tambah customer
        $request->validate([
            'distributor_id' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'telp' => 'required|max:13'
        ]);

        //menampung data distributor berdasarkan id distributor pada sebuah variable 
        $dist = Distributor::find($request->distributor_id);
        //mengisi variable prefix dengan nama distributor
        $prefix = $dist->nama;
        //menghitung panjang karakter dari variable prefix
        $p = strlen($prefix);
        //membuat id berdasarkan prefix yang merupakan nama distributor
        $id = IdGenerator::generate(['table' => 'customers', 'length' => ($p + 4), 'prefix' => $prefix, 'reset_on_prefix_change' => true]);

        //menampung semua field pada form tambah pada sebuah array
        $form_data = array(
            'id' => $id,
            'distributor_id' => $dist->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        );

        //melakukan insert data array
        Customer::create($form_data);

        //mengembalikan pesan sukses apabila proses insert data berhasil dilakukan
        return response()->json([
            'success' => 'Data berhasil disimpan'
        ]);
    }


    //mengambil data berdasarkan id untuk ditampilkan pada edit data
    public function edit($id)
    {
        if (request()->ajax()) {
            //mengambil data customer berdasarkan id
            $data = Customer::findOrFail($id);
            //menampung data dalam bentuk json
            return response()->json(['result' => $data]);
        }
    }

    //fungsi update data
    public function update(Request $request)
    {
        //validasi data harus diisi
        $request->validate([
            'distributor_id' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'telp' => 'required|max:13'
        ]);

        //menampung data baru dalam sebuah array
        $form_data = array(
            'distributor_id' => $request->distributor_id,
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        );

        //mengupdate data array berdasarkan id
        Customer::whereId($request->hidden_id)->update($form_data);

        //mengembalikan pesan sukses saat data berhasil diupdate
        return response()->json([
            'success' => 'Data berhasil di update'
        ]);
    }

    //menghapus data berdasarkan id
    public function hapus($id)
    {
        //mencari data pada tabel berdasarkan id
        $data = Customer::findOrFail($id);
        //menghapus data
        $data->delete();
    }


    //menampilkan halaman detail berdasarkan data customer
    public function detail(Customer $customer)
    {
        //mengarahkan ke halaman detail dengan beberapa variable data
        return view('admin.pelanggan.detailCustomer', [
            'title' => 'Detail Pelanggan',
            "distributor" => Distributor::all(),
            'customer' => $customer
        ]);
    }

    //menghapus data pada halaman detail customer
    public function detailHapus($id)
    {
        //mencari data pada tabel customer berdasarkan id
        $data = Customer::findOrFail($id);
        //menghapus data
        $data->delete();
        //jika berhasil maka akan mengembalikan tampikan ke halaman customer index dengan pesan success
        return redirect()->route('customer.index')->with('success', 'Data berhasil dihapus.');
    }

    //mengupdate data pada halaman detail customer
    public function detailUpdate(Request $request)
    {
        //validasi data harus diisi
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'telp' => 'required|max:13'
        ]);

        //menampung data dalam sebuah array
        $form_data = array(
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        );

        //mengupdate data array berdasarkan id
        Customer::whereId($request->hidden_id)->update($form_data);

        //jika berhasil maka akan mengarahkan tampilan ke halaman customer index dengan pesan success
        return redirect()->route('customer.index')->with('success', 'Data berhasil di update.');
    }
}
