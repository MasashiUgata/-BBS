@extends('layouts.app')

@section('content')

<div class="container">

  <h2 class="page-header">新しく投稿する</h2>

  {!! Form::open(['url' => 'post/create']) !!}
  <div class="form-group">
    <p class="form-name">投稿者名</p>
    {!! Form::input('text','newName',null,['required','class'=>'form-control','placeholder'=>'名前']) !!}
  </div>

  <div class="form-group">
    <p class="form-content">投稿内容</p>
    {!! Form::input('text','newContents',null,['required','class'=>'form-control','placeholder'=>'投稿内容']) !!}
  </div>

  <button type="submit" class="btn btn-success pull-right">追加する</button>
  {!! Form::close() !!}
</div>

@endsection