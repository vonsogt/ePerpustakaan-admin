<p align="center"><img src="https://user-images.githubusercontent.com/35516476/80088999-7b10d000-8587-11ea-80dd-0126cc18bebd.png" width="400"></p>

## Tentang ePerpustakaan-admin

ePerpustakaan-admin merupakan website yang dapat mengelola perpustakaan dengan fitur Web API yang membantu perangkat selain menggunakan browser agar dapat terintegrasi hanya pada SATU DATABASE saja.

## Cara menginstall

1. Unduh/Duplikat projek ini
   `git clone https://github.com/vonsogt/ePerpustakaan-admin.git`
2. Lalu pindah kedirektori `cd ePerpustakaan-admin`
3. Install paket yang dibutuhkan `composer install`
4. Konfigurasi database (MySQL) dengan cara:
   - Salin dan Tempel file `.env.example` dan ubah nama menjadi `.env` didirektori yang sama
   - Ubah setiap baris dibawah ini:
     ```
     DB_DATABASE=e_perpustakaan
     DB_USERNAME=root
     DB_PASSWORD=
     ```
     NB: Untuk data diatas bisa disesuaikan dengan data phpmyadmin
5. Jalankan service mysql
6. Ketik `php artisan migrate`
7. Buat Pengguna baru `php artisan backpack:user` dan isi sesuai formnya
8. Terakhir ketik `php artisan serve` (secara default buka link dibrowser: `localhost:8000`)

## Tampilan
![tampilan](https://user-images.githubusercontent.com/35516476/80281742-7e4abe00-8737-11ea-8bc6-c73f2cd0c38e.jpg)
<a target="_blank" href="http://www.freepik.com">Designed by Freepik</a>

## Demo (InProgress)

- [ePerpustakaan-demo](https://e-perpustakaan-demo.000webhostapp.com/)

  Upgrade to premium, left to be uploaded:
  - Upload vendor.zip to /vendor
  - Extract /vendor/backpack/crud.zip

## Kerentanan Keamanan

Jika Anda menemukan kerentanan keamanan dalam ePerpustakaan-admin ini, silakan kirim e-mail ke Alvonso [vonsogt18081999@gmail.com](mailto:vonsogt18081999@gmail.com). Semua kerentanan keamanan akan segera ditangani.

## Lisensi

ePerpustakaan-Admin ini adalah open source website dibawah [MIT license](https://opensource.org/licenses/MIT).
