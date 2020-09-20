<?php

namespace App\Http\Controllers;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;

class ArticleController2 extends Controller
{
    public function index_desktop(){
        $articles = \App\Article::orderBy('title', 'asc')->paginate(7);
        return view('admin.desktop.article_list', ['articles'=>$articles]);
    }
    public function new_desktop(){
        return view('admin.desktop.article_new');
    }
    public function store(Request $request){
        if($request->file()){
            $file_name = time().'.'.$request->file->extension();
            $request->file->move(public_path('image/article/'), $file_name);
            $query = [
                'image_url' => 'image/article/'.$file_name,
                'title'     => $request->title,
                'body'      => $request->body,
                'author'    => Session::get('userid'),
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'updated_by'=> Session::get('userid'),
            ];
        }else{
            $query = [
                'title'     => $request->title,
                'body'      => $request->body,
                'author'    => Session::get('userid'),
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'updated_by'=> Session::get('userid'),
            ];
        };
        if(\App\Article::insert($query)){
            $log = new LogController();
            $log->new('membuat', 'artikel', $request->title);
            return redirect('admin/article')->with('success');
        }else{
            return back();
        }
    }

    public function update_view($id){
        $article = \App\Article::find($id);
        return view('admin.desktop.article_edit', ['article' => $article]);
    }

    public function update(Request $request){
        $article = \App\Article::find($request->id);
        $query = [
            'title'     => $request->title,
            'body'      => $request->body,
            'author'    => Session::get('userid'),
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            'updated_by'=> Session::get('userid'),
        ];
        if($article->update($query)){
            return redirect('admin/article')->with('success');
        }else{
            return back();
        }
    }
    public function update_image(Request $request, $id){
        $article = \App\Article::find($id);
        $old_image = $article->image_url;
        File::delete($old_image);

        $file_name = time().'.'.$request->file->extension();
        $request->file->move(public_path('image/article/'), $file_name);
        $query = [
            'image_url' => 'image/article/'.$file_name,
            'updated_at'=> Carbon::now(),
            'updated_by'=> Session::get('userid'),
        ];
        if($article->update($query)){
            return redirect('admin/article/'.$id.'/edit');
        }else{
            return back()->with('error');
        }
    }
    public function delete_view($id){
        $article = \App\Article::find($id);
        return view('admin.desktop.article_delete', ['article'=>$article]);
    }
    public function delete(Request $request){
        if(\App\Article::find($request->id)->delete()){
            return redirect('admin/article');
        };
    }

    public function show($id){
        $article = \App\Article::find($id);
        if(!$article){
            return view('admin/pages/article/view_404');
        }
        return view('admin/pages/article/view', ['article' => $article]);
    }
}
