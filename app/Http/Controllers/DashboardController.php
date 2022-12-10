<?php

namespace App\Http\Controllers;

use App\Models\Klaim;
use App\Models\Damage;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Distributor;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    //autentifikasi middleware agar tidak terjadi kesalahan halaman berdasarkan role user
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Dashboard Admin
    public function berandaAdmin()
    {
        //menghitung total data customer
        $distributor = Distributor::count();

        //menghitung total data produk
        $produk = Product::count();

        //menghitung total data kerusakan
        $kerusakan = Damage::count();

        $totalKlaim = Klaim::where('hasil_klaim', '!=', 'Pending')->count();

        //mengarahkan aplikasi ke halaman dashboard Admin dengan beberapa variable yang akan digunakan
        return view(
            'admin.dashboard',
            [
                'distributor' => $distributor,
                'produk' => $produk,
                'kerusakan' => $kerusakan,
                'totalKlaim' => $totalKlaim,
                'title' => 'Dashboard'
            ]

        );
    }

    //Dashboard Manager
    public function berandaManager()
    {

        $title = 'Beranda';

        //mengarahkan aplikasi ke halaman dashboard Manager dengan beberapa variable yang akan digunakan
        return view(
            'manager.dashboard',
            [
                'title' => $title
            ]

        );
    }

    public function dataChart(Request $request)
    {

        // dd($request->value);
        if ($request['value'] == 'Kerusakan Konsumen') {
            return Klaim::select([
                DB::raw('damages.nama as nama'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2017",1,null)) as data2017'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2018",1,null)) as data2018'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2019",1,null)) as data2019'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2020",1,null)) as data2020'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2021",1,null)) as data2021'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2022",1,null)) as data2022')
            ])
                ->join("damages", "damages.id", "=", "klaims.damage_id")
                ->where('klaims.hasil_klaim', '!=', 'Pending')
                ->where('damages.jenis', '=', 'Kesalahan Konsumen')
                ->groupBy(DB::raw("nama"))
                ->get();
        } else if ($request['value'] == 'Kerusakan Pabrik') {
            return Klaim::select([
                DB::raw('damages.nama as nama'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2017",1,null)) as data2017'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2018",1,null)) as data2018'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2019",1,null)) as data2019'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2020",1,null)) as data2020'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2021",1,null)) as data2021'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2022",1,null)) as data2022')
            ])
                ->join("damages", "damages.id", "=", "klaims.damage_id")
                ->where('klaims.hasil_klaim', '!=', 'Pending')
                ->where('damages.jenis', '!=', 'Kesalahan Konsumen')
                ->groupBy(DB::raw("nama"))
                ->get();
        } else if ($request['value'] == 'Distributor') {
            return Klaim::select([
                DB::raw('distributors.nama as nama'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2017",1,null)) as data2017'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2018",1,null)) as data2018'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2019",1,null)) as data2019'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2020",1,null)) as data2020'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2021",1,null)) as data2021'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2022",1,null)) as data2022')
            ])
                ->join("customers", "customers.id", "=", "klaims.customer_id")
                ->join("distributors", "distributors.id", "=", "customers.distributor_id")
                ->where('klaims.hasil_klaim', '!=', 'Pending')
                ->groupBy(DB::raw("nama"))
                ->get();
        } else {
            return Klaim::select([
                DB::raw('products.nama as nama'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2017",1,null)) as data2017'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2018",1,null)) as data2018'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2019",1,null)) as data2019'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2020",1,null)) as data2020'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2021",1,null)) as data2021'),
                DB::raw('COUNT(if(klaims.tahun_produksi="2022",1,null)) as data2022')
            ])
                ->join("products", "products.id", "=", "klaims.product_id")
                ->where('klaims.hasil_klaim', '!=', 'Pending')
                ->groupBy(DB::raw("nama"))
                ->get();
        }
    }
}
