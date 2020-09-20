<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ArticleEditController extends Controller
{
    public function edit($id){
        $user = DB::table('sii_users')
            ->where('id', Auth::id())
            ->select(
                'id',
                'name',
                'role'
            )
            ->first();
        
        $article = DB::table('sii_articles')
            ->where('id', $id)
            ->first();
        
        return view('cpanel.article.edit', ['user' => $user, 'article' => $article]);
    }

    public function edit_save(Request $request){
        $article = DB::table('sii_articles')
            ->where('id', $request->id);
        
        $query = [
            'title' => $request->title,
            'body' => $request->body,
            'updated_at' => Carbon::now(),
            'updated_by' => Auth::id()
        ];

        if( $article->update($query) ){

            $log_query = [
                'user_id' => Auth::id(),
                'action' => 'mengubah',
                'object' => 'artikel',
                'name' => $request->name,
                'created_at' => Carbon::now()
            ];
            DB::table('sii_log')->insert($log_query);

            return redirect('admin/article')->with('success', 'Artikel berhasil diubah.');

        }else{

            Session::flash('error', 'Maaf, artikel gagal diubah.');
            return redirect()->back();

        }
    }

    public function edit_image(Request $request){
        $image = $request->file('image');
        $image_name = Str::random(32).'.jpg';

        $article = DB::table('sii_articles')
            ->where('id', $request->id);

        $old_file = $article->select('image_url')->first();
        
        $query = [
            'image_url' => 'image/article/'.$image_name,
            'updated_at' => Carbon::now()
        ];

        if( $image->move('image/article/', $image_name) ){

            if( $article->update($query) ){

                if(!File::exists(public_path().$old_file->image)){
                    File::delete($old_file->image_url);
                }

                $log_query = [
                    'user_id' => Auth::id(),
                    'action' => 'mengubah',
                    'object' => 'artikel',
                    'name' => $request->title,
                    'created_at' => Carbon::now()
                ];
                DB::table('sii_log')->insert($log_query);

                Session::flash('success', 'Gambar artikel berhasil diubah.');
                return redirect()->back();

            }else{

                Session::flash('error', 'Maaf, gambar artikel gagal diubah.');
                return redirect()->back();

            }
        }
    }
}
