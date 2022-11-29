<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Image;
use App\Models\Klaim;
use App\Models\Damage;
use App\Models\Product;
use App\Models\Customer;
use App\Models\ClaimResult;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\App;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class KlaimController extends Controller
{
    //fungsi untuk mengambil data pada dataTable halaman teknisi
    public function indexTeknisiPending(Request $request)
    {
        if ($request->ajax()) {
            $data = Klaim::all()->where('hasil_klaim', '=', 'Pending');
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('sisa_td', function ($row) {
                    $mAkhir = $row->mm_akhir;
                    $mAwal = $row->mm_awal;
                    $sisa = ceil($mAkhir / $mAwal * 100);
                    return $sisa . "%";
                })

                ->addColumn('action', function ($data) {
                    return '   <a href="teknisi/' . $data->id . '" name="show" id="' . $data->id . '" class="show btn btn-warning btn-sm mx-1"> <i class="bi bi-eye"></i> Show</a>';
                })
                ->make(true);
        }
        return view('teknisi.dashboard', [
            "title" => "Dashboard",
        ]);
    }
    //fungsi untuk mengambil data pada dataTable halaman teknisi
    public function indexTeknisiApproved(Request $request)
    {
        if ($request->ajax()) {
            $data = Klaim::all()->where('hasil_klaim', '!=', 'Pending');
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('sisa_td', function ($row) {
                    $mAkhir = $row->mm_akhir;
                    $mAwal = $row->mm_awal;
                    $sisa = ceil($mAkhir / $mAwal * 100);
                    return $sisa . "%";
                })

                ->addColumn('action', function ($data) {
                    return '   <a href="teknisi/' . $data->id . '" name="show" id="' . $data->id . '" class="show btn btn-warning btn-sm mx-1"> <i class="bi bi-eye"></i> Show</a>';
                })
                ->make(true);
        }
        // return view('teknisi.dashboard', [
        //     "title" => "Dashboard",
        // ]);
    }


    //Teknisi fungsi untuk memproses penyimpanan data klaim pada halaman Teknisi
    public function tambah(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'damage_id' => 'required',
            'product_id' => 'required',
            'checking_by' => 'required',
            'keterangan_klaim' => 'required',
            // 'mm_awal' => 'required',
            'mm_akhir' => 'required',
            // 'mm_akhir' => 'required_|less_than_field:mm_awal',
            'no_seri' => 'required',
            'tahun_produksi' => 'required',
            'images' => 'required|array|between:3,6'
        ]);

        $product = Product::find($request->product_id);
        $cust = Customer::find($request->customer_id);

        $prefix = 'CLM-' . date('Yd');
        $id = IdGenerator::generate(['table' => 'klaims', 'length' => 13, 'prefix' => $prefix, 'reset_on_prefix_change' => true]);

        $form_data = array(
            'id' => $id,
            'customer_id' => $cust->id,
            'customer_nama' => $cust->nama,
            'customer_alamat' => $cust->alamat,
            'damage_id' => $request->damage_id,
            'product_id' => $product->id,
            'product_nama' => $product->nama,
            'product_ukuran' => $product->ukuran,
            'checking_by' => $request->checking_by,
            'keterangan_klaim' => $request->keterangan_klaim,
            'mm_awal' => $product->mm_awal,
            'mm_akhir' => $request->mm_akhir,
            'hasil_klaim' => 'Pending',
            'no_seri' => $request->no_seri,
            'tahun_produksi' => $request->tahun_produksi,
        );

        $dataKlaim = Klaim::create($form_data);

        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $destinationPath = 'imgKlaim/';
                $imageName = $cust->nama . '-' . date('Ymd') . rand(1, 1000) . '.' . $image->extension();
                $image->move($destinationPath, $imageName);
                Image::create([
                    'klaim_id' => $dataKlaim->id,
                    'image' => $imageName
                ]);
            }
        }

        return redirect()->route('teknisi.index')
            ->with('success', 'Pengajuan Klaim berhasil dibuat.');
    }


    //Teknisi - menampilkan data pada detail klaim
    public function detailKlaimTeknisi($id)
    {
        $klaim = Klaim::find($id);
        return view('teknisi.detailKlaim', [
            'title' => 'Detail Pengajuan Klaim',
            'klaim' => $klaim,
            "img" => Image::where('klaim_id', $id)->get()
        ]);
    }

    //Teknisi - Tambah Klaim
    public function tambahKlaim()
    {
        return view('teknisi.tambahKlaim', [
            "title" => "Tambah Klaim Baru",
            "customer" => Customer::all(),
            "damage" => Damage::all(),
            "product" => Product::all()
        ]);
    }

    //fungsi untuk mengambil data pada dataTable halaman Manager
    public function toApprove(Request $request)
    {
        if ($request->ajax()) {
            $data = Klaim::where('hasil_klaim', 'Pending')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('sisa_td', function ($row) {
                    $mAkhir = $row->mm_akhir;
                    $mAwal = $row->mm_awal;
                    $sisa = ceil($mAkhir / $mAwal * 100);
                    return $sisa . "%";
                })
                ->addColumn('action', function ($data) {
                    return '<a href="to-approve/' . $data->id . '" name="show" id="' . $data->id . '" class="show btn btn-warning btn-sm mx-1"> <i class="bi bi-eye"></i> Show</a>';
                })
                ->make(true);
        }
        return view('manager.toApprove', [
            "title" => "Dashboard",
            "klaim" => Klaim::all(),
            "customer" => Customer::all(),
            "damage" => Damage::all(),
            "product" => Product::all()
        ]);
    }
    //fungsi untuk mengambil data pada dataTable halaman Manager
    public function listklaiManager(Request $request)
    {
        if ($request->ajax()) {
            $data = Klaim::where('hasil_klaim', '!=', 'Pending')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('sisa_td', function ($row) {
                    $mAkhir = $row->mm_akhir;
                    $mAwal = $row->mm_awal;
                    $sisa = ceil($mAkhir / $mAwal * 100);
                    return $sisa . "%";
                })
                ->addColumn('action', function ($data) {
                    return '<a href="to-approve/' . $data->id . '" name="show" id="' . $data->id . '" class="show btn btn-warning btn-sm mx-1"> <i class="bi bi-eye"></i> Show</a>';
                })
                ->make(true);
        }
        return view('manager.listklaim', [
            "title" => "Dashboard"
        ]);
    }


    //fungsi untuk menampilkan data pada detail To Approve halaman Manager
    public function detailToApprove($id)
    {
        $klaim = Klaim::find($id);
        return view('manager.detailToApprove', [
            'title' => 'Detail Pengajuan Klaim',
            'klaim' => $klaim,
            "customer" => Customer::all(),
            "damage" => Damage::all(),
            "product" => Product::all(),
            "img" => Image::where('klaim_id', $id)->get(),
            "hasilKlaim" => ClaimResult::all()
        ]);
    }

    //fungsi untuk mengupdate hasil klaim pada halaman Manager
    public function updateToApprove(Request $request)
    {
        ($request->hasil == 'lainnya') ?  $dataHasil = $request->hasilBaru : $dataHasil = $request->hasil;
        $form_data = array(
            'hasil_klaim' => $dataHasil
        );

        $id = $request->hidden_id;

        Klaim::whereId($id)->update($form_data);

        if ($request->hasilBaru != null) {
            $form_hasil = array(
                'nama_hasil' => $request->hasilBaru,
            );
            ClaimResult::create($form_hasil);
        }

        return redirect()->route('to-approve.list')
            ->with('success', 'Hasil Klaim berhasil diperbarui.');
    }


    //fungsi untuk mengambil data pada dataTable halaman Admin
    public function listKlaimAdmin(Request $request)
    {
        if ($request->ajax()) {
            $data = Klaim::where('hasil_klaim', '!=', 'Pending')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('sisa_td', function ($row) {
                    $mAkhir = $row->mm_akhir;
                    $mAwal = $row->mm_awal;
                    $sisa = ceil($mAkhir / $mAwal * 100);
                    return $sisa . "%";
                })->addColumn('customerNama', function ($row) {

                    return $row->customer_id . '-' . $row->customer_nama;
                })->addColumn('action', function ($data) {
                    return '   <a href="listklaim/detail/' . $data->id . '" name="show" id="' . $data->id . '" class="show btn btn-warning btn-sm mx-1"> <i class="bi bi-eye"></i> Show</a>';
                })
                ->make(true);
        }
        return view('admin.klaim.listklaim', [
            "title" => "List Klaim"
        ]);
    }
    //fungsi untuk mengambil data pada dataTable halaman Admin
    public function listKlaimChart(Request $request, $tahun)
    {
        if ($request->ajax()) {
            $data = Klaim::where('hasil_klaim', '!=', 'Pending')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('sisa_td', function ($row) {
                    $mAkhir = $row->mm_akhir;
                    $mAwal = $row->mm_awal;
                    $sisa = ceil($mAkhir / $mAwal * 100);
                    return $sisa . "%";
                })
                ->addColumn('action', function ($data) {
                    return '   <a href="listklaim/detail/' . $data->id . '" name="show" id="' . $data->id . '" class="show btn btn-warning btn-sm mx-1"> <i class="bi bi-eye"></i> Show</a>';
                })
                ->make(true);
        }
        return view('admin.dashboard', [
            "title" => "List Klaim"
        ]);
    }
    //fungsi untuk mengambil data pada dataTable halaman Admin
    // public function listKlaimChart2($data)
    // {
    //     dd($data);
    //     // if ($request->ajax()) {
    //     //     $data = Klaim::where('product_nama', $nama)->get();
    //     //     return DataTables::of($data)->addIndexColumn()
    //     //         ->addColumn('sisa_td', function ($row) {
    //     //             $mAkhir = $row->mm_akhir;
    //     //             $mAwal = $row->mm_awal;
    //     //             $sisa = ceil($mAkhir / $mAwal * 100);
    //     //             return $sisa . "%";
    //     //         })
    //     //         ->addColumn('action', function ($data) {
    //     //             return '   <a href="detail/' . $data->id . '" name="show" id="' . $data->id . '" class="show btn btn-warning btn-sm mx-1"> <i class="bi bi-eye"></i> Show</a>';
    //     //         })
    //     //         ->make(true);
    //     // }
    // }


    //fungsi untuk memproses update data halaman Admin
    public function updateKlaim(Request $request)
    {
        $request->validate([
            'jumlah' => 'required',
        ]);

        $form_data = array(
            'kompensasi' => $request->jumlah,
            'hasil_pabrik' => $request->hasilPabrik,
        );

        $id = $request->hidden_id;

        Klaim::whereId($id)->update($form_data);

        return redirect()->route('admin.listklaim')
            ->with('success', 'Hasil Klaim berhasil diperbarui.');
    }


    //fungsi untuk menampilkan data pada detail klaim halaman Admin
    public function detailListklaim($id)
    {
        $klaim = Klaim::find($id);
        return view('admin.klaim.detailKlaim', [
            'title' => 'Detail Pengajuan Klaim',
            'klaim' => $klaim,
            "customer" => Customer::all(),
            "damage" => Damage::all(),
            "product" => Product::all(),
            "img" => Image::where('klaim_id', $id)->get()
        ]);
    }



    public function cetakPDF($id)
    {
        $klaim = Klaim::find($id);
        $img = Image::where('klaim_id', $id)->get();
        $tanggal = Carbon::parse($klaim->created_at)->format('d/m/Y');
        $html =  '<center><h3 style="background-color: #07ae52; color: white;">DOUBLESTAR TIRE CLAIM - RESULT FORM</h3></center>
        <p align="right">' . $klaim->id . '</p>
        <table width="100%" border="0.5px" style="border-collapse: collapse;">
        <tr>
            <td colspan="4"><b>Informasi Umum</b></td>
        </tr>
        <tr>
            <td>ID Pelanggan </td>
            <td> : ' . $klaim->customer_id . '</td>
            <td>Dicek oleh </td>
            <td> : ' . $klaim->checking_by . '</td>
        </tr>
        <tr>
            <td>Nama Pelanggan </td>
            <td> : ' . $klaim->customer_nama . '</td>
            <td>Alamat Pelanggan </td>
            <td> : ' . $klaim->customer_alamat . '</td>
        </tr>
        <tr>
            <td colspan="4" style="height: 15px !important;"></td>
        </tr>
        <tr>
            <td colspan="4"><b>Informasi Klaim Ban</b></td>
        </tr>
        <tr>
            <td>Nama Produk </td>
            <td> : ' . $klaim->product_nama . '</td>
            <td>Tahun Produksi </td>
            <td> : ' . $klaim->tahun_produksi . '</td>
        </tr>
        <tr>
            <td>ID Produk </td>
            <td> : ' . $klaim->product_id . '</td>
            <td>MM Awal </td>
            <td> : ' . $klaim->mm_awal . '</td>
        </tr>
        <tr>
            <td>Ukuran Produk </td>
            <td> : ' . $klaim->product_ukuran . '</td>
            <td>MM Akhir </td>
            <td> : ' . $klaim->mm_akhir . '</td>
        </tr>
        <tr>
            <td>Jumlah </td>
            <td> : </td>
            <td>MM Terpakai </td>
            <td> : ' . $klaim->mm_awal - $klaim->mm_akhir . '</td>
        </tr>
        <tr>
            <td>Nomor Seri </td>
            <td> : ' . $klaim->no_seri . ' </td>
            <td>Sisa Td (%) </td>
            <td> : ' . ceil($klaim->mm_akhir / $klaim->mm_awal * 100)  . '%</td>
        </tr>
        <tr>
            <td colspan="4" style="height: 15px !important;"></td>
        </tr>
        <tr>
            <td colspan="4"><b>Gambar</b></td>
        </tr>
        <tr>
            <td colspan="4">';

        foreach ($img as $image) {
            $html .= '<img src="imgKlaim/' . $image->image . '" width="130px" style="margin-top: 30px !important;">    ';
        }
        $html .= '</td>
        </tr>
        <tr>
            <td colspan="4" style="height: 15px !important;"></td>
        </tr>
        <tr>
            <td colspan="4"><b>Informasi Hasil Klaim</b></td>
        </tr>
        <tr>
            <td>Hasil Klaim </td>
            <td> : ' . $klaim->hasil_klaim . ' </td>

            <td>No Klaim </td>
            <td> : ' . $klaim->id . ' </td>
        </tr>
        <tr>
            <td>Jumalah Kompensasi (Rp) </td>
            <td> : Rp ' .  number_format($klaim->kompensasi, 0, '.', ',') . ' </td>
            <td>Tanggal Klaim </td>
            <td> : ' . $tanggal  . '</td>
        </tr>
        <tr>
            <td>Kode Kerusakan </td>
            <td colspan="3"> : ' . $klaim->damage_id . ' </td>
        </tr>
        <tr>
            <td>Keterangan Kerusakan </td>
            <td colspan="3"> : ' . $klaim->keterangan_klaim . ' </td>
        </tr>
        </table>';



        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html)->setPaper('a4', 'potrait');

        return $pdf->stream();
    }

    public function cetakPDFTeknisi($id)
    {
        $klaim = Klaim::find($id);
        $img = Image::where('klaim_id', $id)->get();
        $tanggal = Carbon::parse($klaim->created_at)->format('d/m/Y');
        $html =  '<center><h3 style="background-color: #07ae52; color: white;">DOUBLESTAR TIRE CLAIM - RESULT FORM</h3></center>
        <p align="right">' . $klaim->id . '</p>
        <table width="100%" border="0.5px" style="border-collapse: collapse;">
        <tr>
            <td colspan="4"><b>Informasi Umum</b></td>
        </tr>
        <tr>
            <td>ID Pelanggan </td>
            <td> : ' . $klaim->customer_id . '</td>
            <td>Tanggal Transaksi</td>
            <td> : </td>
        </tr>
        <tr>
            <td>Nama Pelanggan </td>
            <td> : ' . $klaim->customer_nama . '</td>
            <td>Dicek oleh </td>
            <td> : ' . $klaim->checking_by . '</td>
        </tr>
        <tr>
            <td colspan="4" style="height: 15px !important;"></td>
        </tr>
        <tr>
            <td colspan="4"><b>Informasi Klaim Ban</b></td>
        </tr>
        <tr>
            <td>Nama Produk </td>
            <td> : ' . $klaim->product_nama . '</td>
            <td>Tahun Produksi </td>
            <td> : ' . $klaim->tahun_produksi . '</td>
        </tr>
        <tr>
            <td>ID Produk </td>
            <td> : ' . $klaim->product_id . '</td>
            <td>MM Awal </td>
            <td> : ' . $klaim->mm_awal . '</td>
        </tr>
        <tr>
            <td>Ukuran Produk </td>
            <td> : ' . $klaim->product_ukuran . '</td>
            <td>MM Akhir </td>
            <td> : ' . $klaim->mm_akhir . '</td>
        </tr>
        <tr>
            <td>Jumlah </td>
            <td> : </td>
            <td>MM Terpakai </td>
            <td> : ' . $klaim->mm_awal - $klaim->mm_akhir . '</td>
        </tr>
        <tr>
            <td>Nomor Seri </td>
            <td> : ' . $klaim->no_seri . ' </td>
            <td>Sisa Td (%) </td>
            <td> : ' . ceil($klaim->mm_akhir / $klaim->mm_awal * 100)  . '%</td>
        </tr>
        <tr>
            <td colspan="4" style="height: 15px !important;"></td>
        </tr>
        <tr>
            <td colspan="4"><b>Gambar</b></td>
        </tr>
        <tr>
            <td colspan="4">';

        foreach ($img as $image) {
            $html .= '<img src="imgKlaim/' . $image->image . '" width="130px" style="margin-top: 30px !important;">    ';
        }
        $html .= '</td>
        </tr>
        <tr>
            <td colspan="4" style="height: 15px !important;"></td>
        </tr>
        <tr>
            <td colspan="4"><b>Informasi Hasil Klaim</b></td>
        </tr>
        <tr>
            <td>No Klaim </td>
            <td> : ' . $klaim->id . ' </td>
            <td>Tanggal Klaim </td>
            <td> : ' . $tanggal  . '</td>
        </tr>
        <tr>
            <td>Kode Kerusakan </td>
            <td> : ' . $klaim->damage_id . ' </td>
            <td>Keterangan Kerusakan </td>
            <td> : ' . $klaim->keterangan_klaim . ' </td>
        </tr>
        </table>';



        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html)->setPaper('a4', 'potrait');

        return $pdf->stream();
    }
}
