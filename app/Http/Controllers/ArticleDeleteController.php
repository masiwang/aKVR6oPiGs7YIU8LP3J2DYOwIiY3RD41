<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class ArticleDeleteController extends Controller
{
    public function delete(Request $request){
        $article = DB::table('sii_articles')
            ->where('id', $request->id);
        
        if($article->delete()){
            Session::flash('success', 'Artikel berhasil dihapus');
            return redirect('admin/article');
        }else{
            Session::flash('error', 'Maaf, artikel gagal dihapus');
            return redirect()->back();
        }
    }
}
