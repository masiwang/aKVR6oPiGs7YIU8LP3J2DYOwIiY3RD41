<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index(Request $request){
        $user = DB::table('sii_users')
            ->where('id', Auth::id())
            ->select(
                'id',
                'name',
                'role'
            )
            ->first();

        $articles = DB::table('sii_articles')
            ->select(
                'id',
                'image_url',
                'title',
                'body',
                'author',
                'created_at'
            );
        if($request->title){
            $articles = $articles->where('title', 'like', '%'.$request->title.'%');
        }
        $articles = $articles->paginate(10);

        return view('cpanel.article.index', ['user' => $user, 'articles' => $articles]);
    }
}
