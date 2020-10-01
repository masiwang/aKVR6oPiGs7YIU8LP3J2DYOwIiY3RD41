<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(){
        /**
         * method ini digunakan untuk menampilkan halaman daftar admin
         */
        $this->pimpinan_only(); // halaman ini hanya dapat diakses oleh pimpinan
        $admins = DB::table('sii_users')->get(); // mendapatkan seluruh data admin
        return view('cpanel.user.index', ['user' => $this->get_auth_user(), 'admins' => $admins]);
    }

    public function log(){
        /**
         * method ini digunakan untuk menampilkan halaman log aktivitas
         */
        if(Auth::user()->role == 'pimpinan'){ // jika role user yang login adalah pimpinan
            $logs = DB::table('sii_log') // maka dapatkan data log
            ->orderBy('id', 'desc') // untuk semua user, diurutkan berdasarkan id secara descending
            ->paginate(10); // sebanyak 10 data tiap halaman
        }
        if(Auth::user()->role == 'operator'){ // jika role user yang login adalah operator
            $logs = DB::table('sii_log') // maka dapatkan data log
            ->where('user_id', Auth::id()) // untuk user yang login saja
            ->orderBy('id', 'desc') // diurutkan berdasarkan id log secara descending
            ->paginate(10); // sebanyak 10 data tiap halaman
        }
        return view('cpanel.user.log', ['user' => $this->get_auth_user(), 'logs' => $logs]);
    }

    public function new(){
        /**
         * method ini digunakan untuk menampilkan halaman form penambahan admin baru
         */
        $this->pimpinan_only(); // hanya dapat diakses oleh pimpinan
        return view('cpanel.user.new', ['user' => $this->get_auth_user()]);
    }

    public function new_save(Request $request){
        /**
         * method ini digunakan untuk menyimpan data dari form penambahan admin baru
         */
        if( Str::length($request->password) < 6 ){ // jika panjang password kurang dari 6 karakter
            return back()->with('error', 'Password harus lebih dari 6 karakter.'); // redirect kembali ke halaman sebelumnya dengan notifikasi error
        }
        $image_name = $this->upload_image('profile', $request->file('image')); //upload gambar admin baru ke directory 'profile'
        $query = [ // inisiasi query
            'image' => 'image/profile/'.$image_name,
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password), // hash:make digunakan untuk mengenkripsi password user
            'email_verification_token' => Str::random(32), // token verifikasi email user adalah random string sepanjang 32 karakter
            'remember_token' => Str::random(64), // token lupa password user adalah string random sepanjang 64 karakter
            'created_at' => Carbon::now()
        ];
        DB::table('sii_users')->insert($query); // eksekusi penambahan user baru dengan data $query
        $this->new_log('menambah', 'admin', $request->name); // menuliskan log baru
        return redirect('admin/list')->with('success', 'Admin baru berhasil ditambahkan.'); // redirect ke halaman list admin dengan notifikasi sukses
    }

    
}
