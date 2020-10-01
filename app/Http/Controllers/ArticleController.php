<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * $this->get_auth_user() adalah method yang didapatkan dari App\Http\Controllers\Controller
     * method ini digunakan untuk mendapatkan informasi user yang sedang login
     * 
     * $this->upload_image adalah method yang didapatkan dari App\Http\Controllers\Controller
     * method ini digunakan untuk upload image ke folder tertentu dengan me-return nama image tersebut
     * 
     * $this->operator_only() adalah method yang didapatkan dari App\Http\Controllers\Controller
     * method ini digunakan untuk mengembalikan user selain 'operator' (melarang user dengan
     * role operator untuk mengakses method terkait)
     */
    private function article($where_id=null, $where_title=null, $select=null){
        $article = DB::table('sii_articles'); // inisiasi tabel sii_articles
        // jika $where_id tidak null
        if($where_id){
            $article = $article->where('id', $where_id);
        }
        //jika $where_title tidak null
        if($where_title){
            $article = $article->where('title', 'like', $where_title);
        }
        // jika opsi select
        if($select){
            $article = $article->select('id', 'image_url', 'title', 'body', 'author', 'created_at');
        }
        return $article;
    }

    public function index(Request $request){
        $articles = $this->article(null, $request->title, 1)->paginate(10); // mengambil data artikel sebanyak 10 per halaman
        return view('cpanel.article.index', ['user' => $this->get_auth_user(), 'articles' => $articles]);
    }

    public function index_guest(Request $request){
        $articles = $this->article(null, $request->title, 1)->paginate(10); // mengambil data artikel sebanyak 10 per halaman
        return view('guest.article', ['user' => $this->get_auth_user(), 'articles' => $articles]);
    }

    public function delete(Request $request){
        $this->operator_only(); // hanya operator yang dapat akses fungsi ini
        $this->article($request->id, null, null)->delete(); // menghapus artikel dengan id = $request->id
        $this->new_log('menghapus', 'artikel', 'id '.$request->id); // menuliskan log baru
        return redirect('admin/article')->with('success', 'Artikel berhasil dihapus.'); // kembali ke list artikel dengan notifikasi sukses
    }

    public function detail($id){
        $article = $this->article($id, null, 1)->first(); // mengambil data artikel dengan id = $request->id
        return view('cpanel.article.detail', ['user' => $this->get_auth_user(), 'article' => $article]);
    }

    public function detail_guest($id){
        $article = $this->article($id, null, 1)->first(); // mengambil data artikel dengan id = $request->id
        return view('guest.article_detail', ['user' => $this->get_auth_user(), 'article' => $article]);
    }

    public function edit($id){
        $this->operator_only(); // hanya operator yang dapat akses fungsi ini
        $article = $this->article($id, null, 1)->first(); // mengambil data artikel dengan id = $request->id
        return view('cpanel.article.edit', ['user' => $this->get_auth_user(), 'article' => $article]);
    }

    public function edit_image(Request $request){
        $this->operator_only(); // hanya operator yang dapat akses fungsi ini
        $old_image = $this->article($request->id, null, 1)->first()->image_url; // mengambil data image_url dari artikel dengan id = $request->id
        $image_name = $this->upload_image('article', $request->file('image')); // melakukan upload gambar $request->file('image') pada folder 'article'
        $query = [
            'image_url' => 'image/article/'.$image_name, // update alamat gambar baru
            'updated_at' => Carbon::now()
        ];
        $article = $this->article($request->id, null, null)->update($query); // eksekusi update artikel dengan id = $request->id
        if(!File::exists(public_path().$old_image)){
            File::delete($old_image); // menghapus gambar artikel lama, jika ada
        }
        $this->new_log('mengubah', 'artikel', $request->id); // menuliskan log baru
        return back()->with('success', 'Gambar artikel berhasil diubah.'); // kembali ke halaman sebelumnya dengan notifikasi sukses
    }

    public function edit_save(Request $request){
        $this->operator_only(); // hanya operator yang dapat akses fungsi ini
        $query = [
            'title' => $request->title, // update judul
            'body' => $request->body, // update isi artikel
            'updated_at' => Carbon::now(),
            'updated_by' => Auth::id()
        ];
        $this->article($request->id, null, null)->update($query); // eksekusi update artikel
        $this->new_log('mengubah', 'artikel', 'id '.$request->id); // menuliskan log baru
        return redirect('admin/article')->with('success', 'Artikel berhasil diubah.'); // redirect ke list artikel dengan notifikasi sukses
    }

    public function new(){
        $this->operator_only(); // hanya operator yang dapat akses fungsi ini
        return view('cpanel.article.new', ['user' => $this->get_auth_user()]); // menampilkan form pembuatan artikel baru
    }

    public function new_save(Request $request){
        $this->operator_only(); // hanya operator yang dapat akses fungsi ini
        $image_name = $this->upload_image('article', $request->file('image')); // upload gambar $request->file('image) ke folder 'article
        $query = [
            'image_url' => 'image/article/'.$image_name,
            'title' => $request->title,
            'body' => $request->body,
            'author' => Auth::id(),
            'created_at' => Carbon::now()
        ];
        $this->article()->insert($query); // eksekusi tambah artikel baru
        $this->new_log('menambah', 'artikel', $request->title); // menambah log baru
        return redirect('admin/article')->with('success', 'Artikel berhasil dibuat.'); // kembali ke list article dengan notifikasi sukses
    }
}
