@extends('layouts.app')

@section('content')


    <div class="d-flex align-items-center justify-content-center vh-100 flex-column">
        <h1>ポートフォリオ</h1>
        <h2>ToDo管理アプリ</h2>
        <p>右上のログインボタンを押してください</p>
    </div>

    <style>
        h1 {
            font-size: 40px;
        }

        h2 {
            font-size: 70px;
        }

        p {
            padding-top:100px;
            font-size: 40px;
        }
    </style>
@endsection

@section('scripts')
    <script src="/js/app.js"></script>
@endsection

