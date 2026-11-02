# Hasil dan Dokumentasi (8.4.5)

Screenshot diambil dari aplikasi `testing_hmvc` yang berjalan di `http://127.0.0.1:8123`
(`php artisan serve`), viewport 1280x900, setelah `php artisan migrate:fresh --seed`.

| Gambar modul | File | Keterangan |
|---|---|---|
| 8.40 | `8_40_guest_redirect_login.png` | Tamu membuka `/pendaftaran`, diarahkan middleware `auth` ke halaman login. |
| 8.41 | `8_41_register_validation.png` | Register dengan password kurang dari 8 karakter dan konfirmasi berbeda, error tampil di bawah input. |
| 8.42 | `8_42_register_success.png` | Form register terisi benar sebelum dikirim. |
| 8.43 | `8_43_dashboard_user.png` | Dashboard akun hasil register, badge role User, tanpa menu Kelola User. |
| 8.46 | `8_46_user_403.png` | User membuka `/admin/users` lewat address bar, muncul 403 dengan pesan `Anda tidak memiliki hak akses ke halaman ini.` |
| 8.44 | `8_44_login_after_logout.png` | Halaman login setelah logout. |
| 8.48 | `8_48_dashboard_admin.png` | Dashboard admin, kartu Total User tampil. |
| 8.49 | `8_49_user_list.png` | Daftar user; akun yang sedang login diberi badge Anda tanpa tombol Hapus. |
| 8.50 | `8_50_user_create_validation.png` | Form tambah user kosong, pesan error di bawah tiap input. |
| 8.51 | `8_51_user_create_filled.png` | Form tambah user terisi. |
| 8.52 | `8_52_user_created.png` | Redirect ke daftar user dengan alert `User berhasil ditambahkan.` |
| 8.53 | `8_53_user_edit.png` | Form edit user. |
| 8.55 | `8_55_user_search.png` | Pencarian user berdasarkan kata kunci. |
| 8.58 | `8_58_admin_cannot_demote_self.png` | Admin mengubah role akunnya sendiri menjadi User, ditolak. |
| 8.59 | `8_59_pendaftaran_empty.png` | Halaman Pendaftaran saat data masih kosong. |
| 8.60 | `8_60_ajax_validation.png` | Simpan modal kosong, balasan 422, error per input, modal tetap terbuka. |
| 8.61 | `8_61_modal_filled.png` | Modal terisi beserta berkas. |
| 8.62 | `8_62_ajax_saved.png` | Tabel diperbarui dan alert sukses tanpa reload. |
| 8.63 | `8_63_ajax_list.png` | Beberapa data pendaftar, kolom Berkas menampilkan nama asli file. |
| 8.65 | `8_65_zip_rejected.png` | Unggah `.zip` ditolak, pesan `Berkas harus berformat jpg, jpeg, png, atau pdf.` |
| 8.66 | `8_66_ajax_search.png` | Pencarian instan, tabel tersaring saat mengetik. |
| 8.67 | `8_67_modal_edit.png` | Modal edit menampilkan tautan Berkas saat ini. |
| 8.69 | `8_69_confirm_delete.png` | Modal konfirmasi hapus. |
| 8.70 | `8_70_after_delete.png` | Baris hilang setelah konfirmasi, tanpa reload. |
| 8.71 | `8_71_json.png` | Respons mentah `GET /pendaftaran/data` berisi `berkas`, `nama_berkas`, `berkas_url`. |

Catatan: teks validasi bawaan Laravel tampil dalam Bahasa Inggris (`The nama field is required.`)
karena modul hanya mengganti pesan `no_hp` dan `berkas` lewat `messages()`. Itu sesuai modul,
bukan kekurangan.

Berkas di storage diperiksa terpisah lewat filesystem: `storage/app/public/berkas_pendaftaran`
hanya berisi berkas aktif, berkas lama terhapus saat diganti, dan ikut terhapus saat data dihapus.
