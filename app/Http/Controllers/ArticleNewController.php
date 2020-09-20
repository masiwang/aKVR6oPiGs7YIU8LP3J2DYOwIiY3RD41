<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Session;

class ArticleNewController extends Controller
{
    public function new(){
        $user = DB::table('sii_users')
            ->where('id', Auth::id())
            ->select(
                'id',
                'name',
                'role'
            )
            ->first();

        return view('cpanel.article.new', ['user' => $user]);
    }

    public function new_save(Request $request){
        $image = $request->file('image');
        $image_name = Str::random(32).'.jpg';

        $query = [
            'image_url' => 'image/article/'.$image_name,
            'title' => $request->title,
            'body' => $request->body,
            'author' => Auth::id(),
            'created_at' => Carbon::now()
        ];

        if( $image->move('image/article/', $image_name) ){

            if( DB::table('sii_articles')->insert($query) ){
                
                return redirect('admin/article')->with('success', 'Artikel berhasil dibuat.');

            }else{

                Session::flash('error', 'Maaf, artikel gagal dibuat.');
                return redirect()->back();

            }

        }
    }
}
