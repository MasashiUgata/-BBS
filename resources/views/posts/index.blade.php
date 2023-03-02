<?php
class PostsController
{
  public function index()
  {
  }
}
?>

@extends('layouts.app')

@section('content')

<div class="container">
  <!-- 新規登録 -->
  <p class="pull-right"><a href="/create-form" class="btn btn-success">新規投稿</a></p>

  <!-- あいまい検索 -->
  <div class="search">
    {!! Form::open(['url' => 'index']) !!}
    <div class="form-group">
      {!! Form::input('search','keyword',null,['class'=>'form-search','placeholder'=>'キーワードを入力']) !!}
    </div>
    <button type="submit" class="btn btn-success">検索</button>
    {!! Form::close() !!}
  </div>

  <!-- リスト一覧 -->
  <h2 class="page-header">投稿一覧</h2>
  <table class="table table-hover">
    <tr>
      <th>投稿No.</th>
      <th>投稿者名</th>
      <th>投稿内容</th>
      <th>投稿日時</th>
    </tr>

    @foreach($list as $list)
    <tr>
      <td>{{ $list->id }}</td>
      <td>{{ $list->user_name }}</td>
      <td>{{ $list->contents }}</td>
      <td>{{ $list->created_at }}</td>

      <!-- 編集ページ -->
      <td><a href="/post/{{ $list->id }}/update-form" class="btn btn-primary">編集</a></td>
      <!-- 削除処理 -->
      <td><a href="/post/{{ $list->id }}/delete" class="btn btn-danger" onclick="return confirm('こちらの投稿を削除しますか？')">削除</a></td>
    </tr>
    @endforeach
  </table>

</div>

@endsection