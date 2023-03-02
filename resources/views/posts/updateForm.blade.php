@extends('layouts.app')

@section('content')

<body>
  <header>
    <h1 class="page-header">内容編集</h1>
  </header>

  <div class="container">
    <h2 class="page-header">投稿内容の変更</h2>
    {!! Form::open(['url' => '/post/update']) !!}
    <div class="form-group">
      {!! Form::hidden('id',$post->id) !!}
      {!! Form::input('text','upContents',$post->contents,['required','class'=>'form-control']) !!}
    </div>
    <button type="submit" class="btn btn-primary pull-right">更新</button>
    {!! Form::close() !!}
  </div>


  @endsection