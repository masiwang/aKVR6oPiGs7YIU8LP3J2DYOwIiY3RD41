<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{
    public function email_verification(){
        /**
         * method ini digunakan untuk menampilkan halaman verifikasi email
         */
        return view('cpanel.user.email_verification', ['user' => $this->get_auth_user()]);
    }
    public function verification_email_send(){
        /**
         * method ini digunakan untuk mengirimkan email verifikasi
         */ 
        $user = Auth::user();
        Mail::send('cpanel.template.email-verification', ['user' => $user, 'token' => $user->email_verification_token], function ($m) use ($user) {
            $m->from('siika.surakarta@gmail.com', 'Admin SIIKa Surakarta'); // mengirimkan email dat sii.surakarta@gmail.com dengan Nama Admin SIIKa Surakarta
            $m->to($user->email, $user->name)->subject('Verifikasi Email Admin'); // kepada email user terkait dengan subjek 'Verifikasi Email Admin
            // isi email didapatkan dari blade pada folder cpanel.template.email-verification, dengan token dari data email_verification_token user terkait
        });
        return back()->with('success', 'Cek email Anda untuk konfirmasi Email.');
    }

    public function verification_do($token){
        $user = DB::table('sii_users') // mengambil data user
            ->where('email_verification_token', $token); // berdasarkan token 
        if( !$user->first() ){ // jika user tidak ditemukan
            return 'Link verifikasi Anda tidak valid.'; // maka token tidak valid
        }
        if( $user->update(['email_verified_at' => Carbon::now()]) ){ //jika email sukses diverifikasi
            return redirect('login')->with('success', 'Email Anda berhasil di verifikasi.'); // redirect ke login
        }
    }
}
