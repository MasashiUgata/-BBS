<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    // ホーム画面表示
    public function index(Request $request)
    {
        $request->session()->forget('message');
        $list = DB::table('posts')->get();
        return view('posts.index', ['list' => $list]);
    }

    // あいまい検索実行時
    public function search(Request $request)
    {
        $request->session()->forget('message');
        $list = DB::table('posts')->get();
        $keyword = $request->input('keyword');

        if (!empty($keyword)) {
            $list = DB::table('posts')
                ->where('user_name', 'like', "%{$keyword}%")
                ->orWhere('contents', 'like', "%{$keyword}%")
                ->get();
        };

        if (!$list->isEmpty()) {
            return view('posts.index', ['list' => $list]);
        } else {
            session()->flash('message', '検索結果は0件です');
            return view('posts.index', ['list' => $list]);
        };
    }

    // 新規投稿ページ表示
    public function createForm()
    {
        return view('posts.createForm');
    }

    // 新規投稿（Create）処理
    public function create(Request $request)
    {
        $request->validate([
            'newName' => 'required|max:100|regex:/\s+/',
            'newContents' => 'required|max:100|regex:/\s+/',
        ], [
            'newName.required' => '投稿者名を入力してください',
            'newName.max' => '投稿者名は100文字以内にしてください',
            'newName.regex' => '投稿者名に全角スペースは使用しないでください',
            'newContents.required' => '投稿内容を入力してください',
            'newContents.max' => '投稿内容は100文字以内にしてください',
            'newContents.regex' => '投稿内容に全角スペースは使用しないでください',

        ]);

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
        $request->validate([
            'upName' => 'required|max:100|regex:/\s+/',
            'upContents' => 'required|max:100|regex:/\s+/',
        ], [
            'upName.required' => '投稿者名を入力してください',
            'upName.max' => '投稿者名は100文字以内にしてください',
            'upName.regex' => '投稿者名に全角スペースは使用しないでください',
            'upContents.required' => '編集内容を入力してください',
            'upContents.max' => '編集内容は100文字以内にしてください',
            'upContents.regex' => '編集内容に全角スペースは使用しないでください',
        ]);

        $id = $request->input('id');
        $up_name = $request->input('upName');
        $up_contents = $request->input('upContents');

        DB::table('posts')
            ->where('id', $id)
            ->update([
                'user_name' => $up_name,
                'contents' => $up_contents
            ]);
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
