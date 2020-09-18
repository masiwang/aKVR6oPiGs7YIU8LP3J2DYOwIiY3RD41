<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Imports\IndustriImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Hash;

class AdminController extends Controller
{
    public function index_desktop(){
        $logs = \App\Log::orderBy('id', 'desc')->limit(10)->get();
        $perusahaan = new \App\Perusahaan;
        $perusahaan = $perusahaan->leftJoin('sii_industri_tipe', 'sii_industri_tipe.id', 'sii_perusahaan.tipe_industri');
        $perusahaan = $perusahaan->leftJoin('sii_kelurahan', 'sii_kelurahan.id', 'sii_perusahaan.kelurahan');
        $perusahaan = $perusahaan->leftJoin('sii_kecamatan', 'sii_kecamatan.id', 'sii_perusahaan.kecamatan');
        $perusahaan = $perusahaan->select(
            'sii_perusahaan.id as id',
            'badan_usaha',
            'nama_perusahaan',
            'nama_pemilik',
            'telepon',
            'tipe_industri as tipe_id',
            'sii_industri_tipe.name as tipe_industri',
            'komoditas',
            'jalan',
            'sii_kelurahan.name as kelurahan',
            'sii_kecamatan.name as kecamatan',
            'karyawan_laki',
            'karyawan_perempuan',
            'latitude',
            'longitude'
        );
        $map_data = $perusahaan->get();
        $get_five = $perusahaan->orderBy('id', 'desc')->limit(5)->get();
        // $map_data = $industri->get();
        return view('admin.desktop.index', ['logs'=>$logs, 'industri' => $get_five, 'map_data' => $map_data]);
    }

    public function profile(){
        $admin_id = \Session::get('userid');
        $admin = \App\User::find($admin_id);
        $activity = \App\Log::where('user_id', $admin_id)->orderBy('id', 'desc')->limit(10)->get();
        return view('admin/pages/admin/profile', ['admin' => $admin, 'activity' => $activity]);
    }

    public function profile_update(Request $request){
        $admin_id = \Session::get('userid');
        $admin = \App\User::where('id', $admin_id);
        $old_password = $admin->first();
        if(strlen($request->email) < 8){
            return redirect('admin/profile')->with('error', 'Email anda tidak boleh kosong!');
        }
        if($request->new_password){
            if(Hash::check($request->old_password, $old_password['password'])){
                if($request->new_password == $request->new_password_2){
                    if(strlen($request->new_password) < 8){
                        return redirect('admin/profile')->with('error', 'Password tidak boleh kurang dari 8 karakter.');
                    }else{
                        $query = [
                            'first_name' => $request->first_name,
                            'last_name' => $request->last_name,
                            'phone' => $request->phone,
                            'email' => $request->email,
                            'password' => Hash::make($request->new_password)
                        ];
                        if($admin->update($query)){
                            return redirect('admin/profile')->with('success', 'Profile berhasil di perbaharui.');
                        }
                    }
                }else{
                    return redirect('admin/profile')->with('error', 'Konfirmasi password baru salah.');
                }
            }else{
                return redirect('admin/profile')->with('error', 'Password lama tidak tepat.');
            }
        }else{
            $query = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email
            ];
            if($admin->update($query)){
                return redirect('admin/profile')->with('success', 'Profile berhasil diperbaharui.');
            }else{
                return redirect('admin/profile')->with('error', 'Profile gagal diperbaharui.');
            }
        }
        
    }

    public function admin_list(Request $request){
        $all_admin = new \App\User();
        if($request->role){
            $all_admin = $all_admin->where('role', $request->role);
        }
        $all_admin = $all_admin->get();
        return view('admin/pages/admin/list', ['all_admin' => $all_admin]);
    }

    public function admin_new_view(){
        return view('admin/pages/admin/new');
    }

    public function admin_new_save(Request $request){
        $validated_data = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'max:255',
            'email' => 'required|email|unique:sii_users,email',
            'new_password' => 'required|min:8',
            'new_password_2' => 'required|min:8',
            'role' => 'required'
        ]);
        $query = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->new_password,
            'role' => $request->role,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        if(($request->new_password) == ($request->new_password_2)){
            if(\App\User::insert($query)){
                return redirect('admin/list')->with('success', 'Admin baru berhasil ditambahkan.');
            }else{
                return redirect('admin/list')->with('error', 'Terdapat kesalahan.');
            }
        }else{
            return redirect('admin/new')->with('error', 'Konfirmasi password salah.');
        }
    }
}
