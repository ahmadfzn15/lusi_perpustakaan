<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Buku;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            "nama" => "lusi",
            "email" => "lusi@gmail.com",
            "password" => Hash::make("123123123"),
            "role" => "admin"
        ]);

        User::create([
            "nama" => "ahmad",
            "email" => "ahmad@gmail.com",
            "password" => Hash::make("123123123"),
            "role" => "peminjam"
        ]);

        Kategori::create([
            'kategori_buku' => 'Bucin'
        ]);

        Buku::create([
            "cover" => "dilan.jpg",
            "judul_buku" => "Dilan 1990",
            "penulis" => "Pidi Baiq",
            "penerbit" => "Cv.Gelung Pratama Putra",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1
        ]);

        Buku::create([
            "cover" => "laskar.jpg",
            "judul_buku" => "Laskar Pelangi",
            "penulis" => "Andrea Hirata",
            "penerbit" => "Bentang Pustaka",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1
        ]);

        Buku::create([
            "cover" => "ayat.jpg",
            "judul_buku" => "Ayat Ayat Cinta",
            "penulis" => "Habiburrahman El Shirazy",
            "penerbit" => "Republika",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1
        ]);

        Buku::create([
            "cover" => "perahu.jpg",
            "judul_buku" => "Perahu Kertas",
            "penulis" => "Dewi Lestari",
            "penerbit" => "Bentang Pustaka",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1
        ]);

        Buku::create([
            "cover" => "bumi.jpg",
            "judul_buku" => "Bumi Manusia",
            "penulis" => "Pramoedya Ananta Toer",
            "penerbit" => "Hasta Mitra",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1
        ]);

        Buku::create([
            "cover" => "kapal.jpg",
            "judul_buku" => "Tenggelamnya Kapal Van Der Wijck",
            "penulis" => "Hamka",
            "penerbit" => "Bulan Bintang",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1
        ]);

        Buku::create([
            "cover" => "ronggeng.jpg",
            "judul_buku" => "Ronggeng Dukuh Paruk",
            "penulis" => "Ahmad Tohari",
            "penerbit" => "Gramedia Pustaka Utama",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1
        ]);

        Buku::create([
            "cover" => "negri.jpg",
            "judul_buku" => "Negeri 5 Menara",
            "penulis" => "Ahmad Fuadi",
            "penerbit" => "Gramedia Pustaka Utama",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1
        ]);

        Buku::create([
            "cover" => "pulang.jpeg",
            "judul_buku" => "Pulang",
            "penulis" => "Tere Liye",
            "penerbit" => "Republika",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1
        ]);

        Buku::create([
            "cover" => "laut.jpg",
            "judul_buku" => "Laut Bercerita",
            "penulis" => "Leila S.Chudori",
            "penerbit" => "Kepustakaan Populer Gramedia",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1
        ]);
    }
}
