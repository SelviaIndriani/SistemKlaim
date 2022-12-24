<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    //fungsi untuk menampilkan data pada dataTable
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::all()->where('show', '!=', '0');
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '   <a href="produk/' . $data->id . '" name="show" id="' . $data->id . '" class="show btn btn-warning btn-sm mx-1"> <i class="bi bi-eye"></i> Show</a>';
                    $button .= '   <a href="produk/edit/' . $data->id . '" name="edit" id="' . $data->id . '" class="edit edit btn btn-success btn-sm"> <i class="bi-pencil-square"></i> Edit</a>';
                    $button .= '   <button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm "> <i class="bi bi-trash"></i> Delete</button>';
                    return $button;
                })
                ->make(true);
        }
        return view('admin.produk.product', [
            "title" => "Produk"
        ]);
    }

    //aksi tambah data
    public function tambah(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:products,id',
            'nama' => 'required',
            'ukuran' => 'required',
            'mm_awal' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        //request semua data
        $input = $request->all();

        $input['show'] = 1;

        if ($image = $request->file('image')) {
            $destinationPath = 'imgProduk/';
            $productImage = $request->id . '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $productImage);
            $input['image'] = "$productImage";
        }
        Product::create($input);

        return redirect()->route('produk.index')
            ->with('success', 'Produk Berhasil Disimpan.');
    }

    //aksi detail produk
    public function detail(Product $product)
    {
        return view('admin.produk.detailProduk', [
            'title' => 'Detail Produk',
            'product' => $product
        ]);
    }

    //fungsi untuk memproses update data
    public function update(Request $request)
    {
        $request->validate([

            'nama' => 'required',
            'ukuran' => 'required',
            'mm_awal' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $form_data = array(
            'nama' => $request->nama,
            'ukuran' => $request->ukuran,
            'mm_awal' => $request->mm_awal
        );

        $data = Product::findOrFail($request->hidden_id);
        if ($image = $request->file('image')) {
            unlink("imgProduk/" . $data->image); //untuk menghapus foto lama
            $destinationPath = 'imgProduk/';
            $productImage = $request->hidden_id . '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $productImage);
            $form_data['image'] = "$productImage";
        } else {
            unset($form_data['image']);
        }

        // $product->update($input);
        $data->update($form_data);
        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diedit.');
    }

    //Fungsi menampilkan data yang akan diedit
    public function edit(Product $product)
    {
        return view('admin.produk.editProduk', [
            'title' => 'Edit Produk',
            'product' => $product
        ]);
    }

    //Fungsi menghapus record Produk
    public function hapus($id)
    {
        $data = Product::findOrFail($id);
        $data->delete();

        if ($data->image != null) {
            unlink("imgProduk/" . $data->image);
        }

        return redirect()->route('produk.index')
            ->with("success", "Produk berhasil dihapus.");
    }
}
