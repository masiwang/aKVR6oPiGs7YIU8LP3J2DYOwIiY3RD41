<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleDetailController extends Controller
{
    public function detail($id){
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

        return view('cpanel.article.detail', ['user' => $user, 'article' => $article]);
    }
}
