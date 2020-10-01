<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Session;

class AuthController extends Controller
{
    public function login(){
        /**
         * method ini digunakan untuk menampilkan halaman login
         */
        if(Auth::user()){ // jika ada user yang sudah login
            return redirect('admin'); // maka redirect ke halaman admin
        }
        return view('auth.login'); //jika tidak, maka tampilkan halaman login
    }

    public function login_do(Request $request){
        /**
         * method ini digunakan untuk eksekusi perintah login
         */
        if(Auth::attempt($request->only('email', 'password'))){ // jika email dan password benar
            $user = DB::table('sii_users')->where('id', Auth::id())->first(); // dapatkan data user yang login
            if( !$user->email_verified_at ){ // jika email belum user belum diverifikasi
                return redirect('admin/profile/email_verification'); // redirect user ke halaman verifikasi email
            }
            $this->new_log('masuk', 'panel', ''); // menuliskan log baru
            return redirect('admin'); // redirect ke halaman admin
        }else{
            return back()->with('auth-error', ''); // jika email dan password salah, redirect ke halaman login kembali dengan notifikasi error
        }
    }
    public function logout(){
        /**
         * method ini digunakan untuk eksekusi logout
         */
        Auth::logout(); // eksekusi logout user
        Session::flush(); // menghapus semua session user
        return redirect('login'); // redirect user ke halaman login
    }

    public function profile(){
        /**
         * method ini digunakan untuk menampilkan halaman profile user yang sedang login
         */
        $logs = DB::table('sii_log') // mendapatkan data log user
            ->where('user_id', Auth::id()) // berdasarkan id user yang sedang login
            ->orderBy('id', 'desc') // urutkan berdasarkan id log secara descending
            ->limit(10) // ambil hanya 10 data saja
            ->get();
        return view('cpanel.user.profile', ['user' => $this->get_auth_user(), 'logs' => $logs]);
    }

    public function update(Request $request){
        /**
         * method ini digunakan untuk menyimpan update data profile
         */
        $query = [ // inisiasi query update awal
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'updated_at' => Carbon::now()
        ];
        if($request->password){ // cek jika user memasukkan password baru
            if(Str::length($request->password) < 6){ // jika panjang password baru kurang dari 6 karakter
                return back()->with('error', 'Maaf password Anda sangat lemah'); // redirect kembali ke halaman sebelumnya dengan notifikasi error
            }
            $query = array_merge($query, ['password' => Hash::make($request->password)]); // jika password kuat, inisiasi query dengan password baru
        }

        DB::table('sii_users')->where('id', Auth::id())->update($query); // eksekusi update data user
        $this->new_log('mengubah', 'profil admin', Auth::id()); // menuliskan log baru
        return back()->with('success', 'Profil berhasil diubah'); // redirect ke halaman sebelumnya dengan notifikasi sukses
    }

    public function update_image(Request $request){
        /**
         * method ini digunakan untuk menyimpan data update foto profile
         */
        $user = DB::table('sii_users')->where('id', Auth::id());
        $old_image = $user->first()->image; // mengambil data image_url dari artikel dengan id = $request->id
        $image_name = $this->upload_image('profile', $request->file('image')); // melakukan upload gambar $request->file('image') pada folder 'article'
        $query = [
            'image' => 'image/profile/'.$image_name, // update alamat gambar baru
            'updated_at' => Carbon::now()
        ];
        $article = $user->update($query); // eksekusi update artikel dengan id = $request->id
        if(!File::exists(public_path().$old_image)){
            File::delete($old_image); // menghapus gambar artikel lama, jika ada
        }
        $this->new_log('mengubah', 'profile admin', Auth::id()); // menuliskan log baru
        return back()->with('success', 'Foto profil berhasil diubah.'); // kembali ke halaman sebelumnya dengan notifikasi sukses
    }
}
