<?php

namespace App\Http\Controllers;

use App\Models\Klaim;
use App\Models\Damage;
use App\Models\Product;
use App\Models\Customer;
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

        //menghitung data klaim dengan hasil_klaim selain 'Pending' berdasarkan data distributor
        $byDistributor = Klaim::select([
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
            ->groupBy(DB::raw("klaims.tahun_produksi"))
            ->orderBy(DB::raw('nama'))
            ->get();

        //menghitung data klaim dengan hasil_klaim selain 'Pending' berdasarkan data kerusakan jenis kesalahan konsumen
        $byKKonsumen = Klaim::select([
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
            ->groupBy(DB::raw("klaims.tahun_produksi"))
            ->orderBy(DB::raw('damages.jenis'))
            ->get();

        //menghitung data klaim dengan hasil_klaim selain 'Pending' berdasarkan data kerusakan jenis kesalahan pabrik
        $byKPabrik = Klaim::select([
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
            ->groupBy(DB::raw("klaims.tahun_produksi"))
            ->orderBy(DB::raw('damages.jenis'))
            ->get();

        //menghitung data klaim dengan hasil_klaim selain 'Pending' berdasarkan data produk



        //judul halaman
        $title = 'Dashboard';

        //mengarahkan aplikasi ke halaman dashboard Admin dengan beberapa variable yang akan digunakan
        return view(
            'admin.dashboard',
            [
                'distributor' => $distributor,
                'produk' => $produk,
                'kerusakan' => $kerusakan,
                'totalKlaim' => $totalKlaim,
                'byKKonsumen' => $byKKonsumen,
                'byDistributor' => $byDistributor,
                // 'byProduk' => $byProduk,
                'byKPabrik' => $byKPabrik,
                'title' => $title
            ]

        );
    }

    public function dataByProduk()
    {
        $data = Klaim::select([
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
            ->groupBy(DB::raw("klaims.tahun_produksi"))
            ->orderBy(DB::raw('nama'))
            ->get();




        return $data;
    }


    public function klaimKesalahanKonsumen()
    {
        $data = Klaim::select([
            DB::raw('damages.nama as nama'),
            DB::raw('COUNT(if(klaims.tahun_produksi="2017",1,null)) AS data2017'),
            DB::raw('COUNT(if(klaims.tahun_produksi="2018",1,null)) AS data2018'),
            DB::raw('COUNT(if(klaims.tahun_produksi="2019",1,null)) AS data2019'),
            DB::raw('COUNT(if(klaims.tahun_produksi="2020",1,null)) AS data2020'),
            DB::raw('COUNT(if(klaims.tahun_produksi="2021",1,null)) AS data2021'),
            DB::raw('COUNT(if(klaims.tahun_produksi="2022",1,null)) AS data2022')
        ])
            ->join("damages", "damages.id", "=", "klaims.damage_id")
            ->where('klaims.hasil_klaim', '!=', 'Pending')
            ->where('damages.jenis', '=', 'Kesalahan Konsumen')
            ->groupBy(DB::raw("klaims.tahun_produksi"))
            ->orderBy(DB::raw('damages.jenis'))
            ->get();
        return $data;
    }

    //Dashboard Manager
    public function berandaManager()
    {
        //menghitung data klaim dengan berdasarkan data distributor
        $byDistributor = Klaim::select(DB::raw("COUNT(*) as count"), DB::raw("distributors.nama as distNama"))
            ->join("customers", "customers.id", "=", "klaims.customer_id")
            ->join("distributors", "distributors.id", "=", "customers.distributor_id")
            ->groupBy(DB::raw("distNama"))
            ->pluck('count', 'distNama');

        //menghitung data klaim dengan berdasarkan data kerusakan jenis kesalahan konsumen
        $byKKonsumen = Klaim::select(DB::raw("COUNT(*) as count"), DB::raw("damages.nama as namaKerusakan"))
            ->join("damages", "damages.id", "=", "klaims.damage_id")
            ->where('jenis', '=', 'Kesalahan Konsumen')
            ->groupBy(DB::raw("namaKerusakan"))
            ->pluck('count', 'namaKerusakan');

        //menghitung data klaim dengan berdasarkan data kerusakan jenis kesalahan pabrik
        $byKPabrik = Klaim::select(DB::raw("COUNT(*) as count"), DB::raw("damages.nama as namaKerusakan"))
            ->join("damages", "damages.id", "=", "klaims.damage_id")
            ->where('jenis', '!=', 'Kesalahan Konsumen')
            ->groupBy(DB::raw("namaKerusakan"))
            ->pluck('count', 'namaKerusakan');

        //menghitung data klaim dengan berdasarkan data produk
        $byProduk = Klaim::select(DB::raw("COUNT(*) as count"), DB::raw("products.nama as namaProduk"))
            ->join("products", "products.id", "=", "klaims.product_id")
            ->groupBy(DB::raw("namaProduk"))
            ->pluck('count', 'namaProduk');

        //menghitung data klaim dengan berdasarkan data hasil_klaim
        $byHasil = Klaim::select(DB::raw("COUNT(*) as count"), DB::raw("hasil_klaim as hasil"))
            ->groupBy(DB::raw("hasil"))
            ->pluck('count', 'hasil');

        $title = 'Beranda';

        //mengarahkan aplikasi ke halaman dashboard Manager dengan beberapa variable yang akan digunakan
        return view(
            'manager.dashboard',
            //membuat array untuk masing masing variable
            compact(
                'byKKonsumen',
                'byHasil',
                'byDistributor',
                'byProduk',
                'byKPabrik',
                'title'
            )
        );
    }

    // SELECT klaims.tahun_produksi, COUNT(*) from klaims INNER JOIN damages ON damages.id = klaims.damage_id WHERE damages.jenis = 'Kesalahan Konsumen' GROUP by tahun_produksi;
    //SELECT klaims.tahun_produksi, damages.jenis, COUNT(*) from klaims INNER JOIN damages ON damages.id = klaims.damage_id GROUP by damages.jenis ORDER BY klaims.tahun_produksi;

    //SELECT klaims.tahun_produksi, damages.jenis, COUNT(*) from klaims INNER JOIN damages ON damages.id = klaims.damage_id GROUP by klaims.tahun_produksi, damages.jenis ORDER BY damages.jenis;

    //SELECT klaims.tahun_produksi, damages.jenis, COUNT(*) from klaims INNER JOIN damages ON damages.id = klaims.damage_id GROUP by klaims.tahun_produksi, damages.jenis ORDER BY klaims.tahun_produksi;

    //SELECT COUNT(*) FROM `klaims` INNER JOIN damages ON klaims.damage_id = damages.id WHERE damages.jenis = 'Kesalahan Pabrik' AND klaims.tahun_produksi = 2021

    //SELECT COUNT(*) FROM `klaims` INNER JOIN damages ON klaims.damage_id = damages.id WHERE damages.jenis = 'Kesalahan Konsumen' AND klaims.tahun_produksi = 2021;

    //SELECT klaims.tahun_produksi, COUNT(if(klaims.tahun_produksi='2020',1,null)) as data_2020, COUNT(if(klaims.tahun_produksi='2021',1,null)) as data_2021 from klaims INNER JOIN damages ON damages.id = klaims.damage_id WHERE jenis = 'Kesalahan Konsumen' and hasil_klaim != 'Pending' GROUP by klaims.tahun_produksi, damages.jenis ORDER BY damages.jenis;


    //SELECT damages.nama,COUNT(if(klaims.tahun_produksi='2017',1,null)) as data_2017, COUNT(if(klaims.tahun_produksi='2018',1,null)) as data_2018, COUNT(if(klaims.tahun_produksi='2019',1,null)) as data_2019, COUNT(if(klaims.tahun_produksi='2020',1,null)) as data_2020, COUNT(if(klaims.tahun_produksi='2021',1,null)) as data_2021, COUNT(if(klaims.tahun_produksi='2022',1,null)) as data_2022  from klaims INNER JOIN damages ON damages.id = klaims.damage_id WHERE jenis = 'Kesalahan Konsumen' and hasil_klaim != 'Pending' GROUP by klaims.tahun_produksi, damages.jenis ORDER BY damages.jenis;
}
