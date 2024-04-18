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
            "jenis_kelamin" => "Perempuan",
            "password" => Hash::make("123"),
            "role" => "admin"
        ]);

        User::create([
            "nama" => "petugas",
            "email" => "petugas@gmail.com",
            "jenis_kelamin" => "Laki-laki",
            "password" => Hash::make("123"),
            "role" => "petugas"
        ]);

        User::create([
            "nama" => "user",
            "email" => "user@gmail.com",
            "jenis_kelamin" => "Laki-laki",
            "password" => Hash::make("123"),
            "role" => "peminjam"
        ]);

        Kategori::create([
            'kategori_buku' => 'Romansa'
        ]);

        Kategori::create([
            'kategori_buku' => 'Aksi'
        ]);

        Kategori::create([
            'kategori_buku' => 'Religi'
        ]);

        Kategori::create([
            'kategori_buku' => 'Horor'
        ]);

        Kategori::create([
            'kategori_buku' => 'Komedi'
        ]);

        Kategori::create([
            'kategori_buku' => 'Drama'
        ]);

        Buku::create([
            "cover" => "dilan.jpg",
            "judul_buku" => "Dilan 1990",
            "penulis" => "Pidi Baiq",
            "penerbit" => "Cv.Gelung Pratama Putra",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1,
            "sinopsis" => 'Dilan 1990 adalah kisah cinta yang menggambarkan perjalanan cinta remaja antara Dilan dan Milea di tahun 1990-an. Dilan, sosok yang penuh dengan keberanian dan kegigihan, jatuh cinta pada Milea, seorang gadis cerdas yang baru saja pindah ke sekolahnya. Mereka berdua menghadapi berbagai rintangan, termasuk perbedaan latar belakang dan tekanan dari lingkungan sekitar. Meskipun demikian, cinta mereka bertahan dan menginspirasi banyak orang di sekitar mereka.'
        ]);

        Buku::create([
            "cover" => "laskar.jpg",
            "judul_buku" => "Laskar Pelangi",
            "penulis" => "Andrea Hirata",
            "penerbit" => "Bentang Pustaka",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1,
            "sinopsis" => 'Laskar Pelangi adalah cerita inspiratif tentang perjuangan sekelompok anak muda di Belitong untuk mendapatkan pendidikan yang layak meskipun dihadapkan pada berbagai keterbatasan. Mereka membentuk kelompok bernama "Laskar Pelangi" dan bersama-sama menentang sistem pendidikan yang tidak adil. Di tengah perjuangan mereka, mereka belajar tentang kehidupan, persahabatan, dan impian. Cerita ini memperlihatkan kekuatan semangat manusia untuk mengubah nasib mereka sendiri.'
        ]);

        Buku::create([
            "cover" => "ayat.jpg",
            "judul_buku" => "Ayat Ayat Cinta",
            "penulis" => "Habiburrahman El Shirazy",
            "penerbit" => "Republika",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1,
            "sinopsis" => 'Ayat-Ayat Cinta mengisahkan perjalanan seorang mahasiswa Muslim bernama Fahri dalam menjalani cinta dan agamanya. Fahri, yang belajar di luar negeri, menghadapi berbagai tantangan moral dan sosial saat dia jatuh cinta pada wanita-wanita yang berbeda. Cerita ini menyoroti konflik antara cinta dan kewajiban agama dalam kehidupan sehari-hari seorang Muslim modern.'
        ]);

        Buku::create([
            "cover" => "perahu.jpg",
            "judul_buku" => "Perahu Kertas",
            "penulis" => "Dewi Lestari",
            "penerbit" => "Bentang Pustaka",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1,
            "sinopsis" => 'Perahu Kertas adalah cerita tentang pertemuan tak terduga antara dua remaja, Kugy dan Keenan, di sebuah tempat yang penuh dengan misteri dan keajaiban. Mereka berdua memiliki impian dan ambisi yang besar, namun harus menghadapi berbagai rintangan dan tantangan dalam perjalanan mereka. Di tengah perjalanan mereka, mereka menemukan arti sejati dari persahabatan dan cinta.'
        ]);

        Buku::create([
            "cover" => "bumi.jpg",
            "judul_buku" => "Bumi Manusia",
            "penulis" => "Pramoedya Ananta Toer",
            "penerbit" => "Hasta Mitra",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1,
            "sinopsis" => 'Bumi Manusia adalah sebuah novel epik yang menggambarkan kehidupan di Hindia Belanda pada awal abad ke-20. Cerita ini mengikuti perjalanan seorang pribumi, Minke, yang berjuang melawan ketidakadilan kolonialisme Belanda sambil menjalani cinta terlarang dengan Annelies, seorang wanita Indo. Melalui kisah ini, pembaca diperkenalkan pada kompleksitas hubungan rasial dan politik di masa lalu Indonesia.'
        ]);

        Buku::create([
            "cover" => "kapal.jpg",
            "judul_buku" => "Tenggelamnya Kapal Van Der Wijck",
            "penulis" => "Hamka",
            "penerbit" => "Bulan Bintang",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1,
            "sinopsis" => 'Tenggelamnya Kapal Van Der Wijck adalah kisah tragis cinta antara Zainuddin, seorang pemuda Minang, dan Hayati, seorang gadis Minang keturunan Belanda. Mereka berdua jatuh cinta meskipun harus menghadapi berbagai tekanan sosial dan budaya. Kisah ini memperlihatkan konflik antara cinta dan tradisi dalam masyarakat Minangkabau pada masa itu.'
        ]);

        Buku::create([
            "cover" => "ronggeng.jpg",
            "judul_buku" => "Ronggeng Dukuh Paruk",
            "penulis" => "Ahmad Tohari",
            "penerbit" => "Gramedia Pustaka Utama",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1,
            "sinopsis" => 'Ronggeng Dukuh Paruk adalah cerita tentang perjalanan seorang gadis desa bernama Srintil yang terpaksa menjadi penari ronggeng untuk menyelamatkan keluarganya dari kemiskinan. Namun, di balik kecantikannya, Srintil harus menghadapi berbagai konflik moral dan sosial yang menguji imannya dan integritasnya.'
        ]);

        Buku::create([
            "cover" => "negri.jpg",
            "judul_buku" => "Negeri 5 Menara",
            "penulis" => "Ahmad Fuadi",
            "penerbit" => "Gramedia Pustaka Utama",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1,
            "sinopsis" => 'Negeri 5 Menara mengisahkan perjalanan seorang remaja bernama Alif dalam mengejar impian untuk menjadi seorang ulama di pesantren terkenal. Di tengah perjalanan yang penuh dengan rintangan dan cobaan, Alif belajar tentang kehidupan, persahabatan, dan tekad untuk meraih mimpi.'
        ]);

        Buku::create([
            "cover" => "pulang.jpeg",
            "judul_buku" => "Pulang",
            "penulis" => "Tere Liye",
            "penerbit" => "Republika",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1,
            "sinopsis" => 'Pulang adalah kisah tentang perjalanan seorang pria yang kembali ke Indonesia setelah lama tinggal di luar negeri. Dia mencari makna di balik kepergian ayahnya dan mengungkap rahasia keluarga yang tersembunyi. Di tengah perjalanan tersebut, dia menemukan kembali akar-akarnya dan menemukan kedamaian dalam kebenaran.'
        ]);

        Buku::create([
            "cover" => "laut.jpg",
            "judul_buku" => "Laut Bercerita",
            "penulis" => "Leila S.Chudori",
            "penerbit" => "Kepustakaan Populer Gramedia",
            "jumlah_halaman" => 100,
            "stok" => 10,
            "id_kategori"=> 1,
            "sinopsis" => 'Laut Bercerita adalah novel yang mengisahkan perjalanan seorang pemuda mencari kebenaran dan jati diri di tengah-tengah perjalanan di lautan yang membawanya menemukan rahasia masa lalu dan perjuangan hidupnya. Melalui petualangannya, ia menemukan makna sejati dari hidup dan keberanian untuk menghadapi masa depannya.'
        ]);
    }
}
