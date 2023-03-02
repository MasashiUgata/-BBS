<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    //ホーム画面表示
    // public function index()
    // {
    //     $list = DB::table('posts')->get();
    //     return view('posts.index', ['list' => $list]);
    // }

    // トップページ兼あいまい検索
    public function index(Request $request)
    {
        $list = DB::table('posts')->get();
        $keyword = $request->input('keyword');

        if (!empty($keyword)) {
            $list->where('user_name', 'like', "%{$keyword}%")
                ->orWhere('contents', 'like', "%{$keyword}%");
        }

        return view('posts.index', ['list' => $list]);
    }

    // 新規投稿ページ表示
    public function createForm()
    {
        return view('posts.createForm');
    }

    // 新規投稿（Create）処理
    public function create(Request $request)
    {
        $user_name = $request->input('newName');
        $contents = $request->input('newContents');

        DB::table('posts')->insert([
            'user_name' => $user_name,
            'contents' => $contents,
        ]);

        return redirect('/index');
    }

    //編集ページ表示
    public function updateForm($id)
    {
        $post = DB::table('posts')
            ->where('id', $id)
            ->first();
        return view('posts.updateForm', ['post' => $post]);
    }

    // 編集(update)処理
    public function update(Request $request)
    {
        $id = $request->input('id');
        $up_contents = $request->input('upContents');
        DB::table('posts')
            ->where('id', $id)
            ->update(
                ['contents' => $up_contents],
            );
        return redirect('/index');
    }

    // 削除(delete)処理
    public function delete($id)
    {
        DB::table('posts')
            ->where('id', $id)
            ->delete();
        return redirect('/index');
    }

    // コンストラクタ設定
    // ログイン状態でないとログイン画面に戻る設定
    public function __construct()
    {
        $this->middleware('auth');
    }
}