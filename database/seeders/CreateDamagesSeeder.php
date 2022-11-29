<?php

namespace Database\Seeders;

use App\Models\Damage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateDamagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $damages = [
            [
                'id' => 'P001',
                'nama' => 'Crown Separation ( Tread Separation )',
                'jenis' => 'Kesalahan Pabrik',
                'kondisi' => 'Telapak ban dan ply steel terkelupas, atau lapisan penghubung belt terjadi separation. Kondisi di telapak ban kembung, steel mengembang dan ban pecah. ( ini terjadi pada saat pemakaian awal ). Catatan : Tidak ada karet yang terbakar',
            ],
            [
                'id' => 'P002',
                'nama' => 'Crown Separation ( Cut Separation )',
                'jenis' => 'Kesalahan Pabrik',
                'kondisi' => 'Telapak ban dan ply steel terkelupas, hingga ke steel cord. Terlepas seperti teriris-iris. Catatan : Telapak ban terkena benda tajam , karena korosi dari air dan juga kotoran membuat luka melebar dan karet telapak ban terkelupas.',
            ],
            [
                'id' => 'P003',
                'nama' => 'Tire Crown Open Splice ( TOS )',
                'jenis' => 'Kesalahan Pabrik',
                'kondisi' => 'Terkelupasnya karet pasti bersudut dan terkelupas secara halus dan tegak lurus terhadap alur rib ban. ( Sambungan tread dalam satu posisi dan punya sudut kemiringan tertentu ). Catatan : Tidak ada bekas luka potong/tersayat.',
            ],
            [
                'id' => 'C004',
                'nama' => 'Crown Blow Out ( Cut Burst )',
                'jenis' => 'Kesalahan Konsumen',
                'kondisi' => 'Telapak ban terkena impack atau terpotong benda tajuam hingga pecah. Luka potongan bisa berbentuk "I""X""Y",Lapisan belt pada telapak ban akan berantakan. Pada posisi yang pecah tidak tampak gejala sepa, Tetapi akan terlihat ada potongan/tertarik.',
            ],
            [
                'id' => 'C005',
                'nama' => 'Puncture Injury ( Tread Cut Penetration )',
                'jenis' => 'Kesalahan Konsumen',
                'kondisi' => 'Telapak ban terdapat luka tusuk atau luka potong. Periksa bagian dalam ban, kita akan menemukan luka tusuk dari bagian dalam ban hingga tembus ke telapak ban. Posisi luka pada telapak ban akan sesuai dengan bagian dalam ban yang tembus / tertusuk.',
            ],
            [
                'id' => 'C006',
                'nama' => 'Cutting Injury ( Tread Cut Circle )',
                'jenis' => 'Kesalahan Konsumen',
                'kondisi' => 'Permukaan/telapak ban terlihat ada bekas luka potong. Pada saat bagian dalam ban diperiksa, kita akan menemukan bagian telapak yang terluka akan menembus bagian dalam ban.',
            ],
            [
                'id' => 'C007',
                'nama' => 'Tire Crown abnormal Wear ( IW )',
                'jenis' => 'Kesalahan Konsumen',
                'kondisi' => 'Tekanan angin ban tidak sesuai, sehingga distribusi beban pada telapak berbeda/berubah. Bagian tengah/kedua sisi telapak ban mengalami habis lebih cepat, keausan tersebut tidak normal, atau keausan telapak ban bergelombang, seperti bulu burung, teriris-iris,terdapat perbedaan tinggi kembang hingg 3mm atau lebih.',
            ],
            [
                'id' => 'C008',
                'nama' => 'Crown Trauma of Scratch ( Tread Cut )',
                'jenis' => 'Kesalahan Konsumen',
                'kondisi' => 'Telapak ban sekeliling atau sebagian ada goresan/luka potong. Dapat terjadi pada saat ban melewati jalan yang berlumpur , ada ban akan slip, maka pada saat itu ban bisa tergores atau terluka oleh benda tajam.',
            ],


        ];

        foreach ($damages as $key => $dmg) {
            Damage::create($dmg);
        }
    }
}
