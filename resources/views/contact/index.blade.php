@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="GET" action="{{route('contact.create')}}">
                    <button type="submit" class="btn btn-primary">
                        新規登録
                    </button>
                    </form>
                    <form method="GET" action="{{route('contact.index')}}" actionclass="form-inline my-2 my-lg-0" >
                        <input class="form-control mr-sm-2" name="search" type="search" placeholder="名前検索" aria-label="Search" style="width:200px;">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索する</button>
                    </form>
                    HERE IS INDEX
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">id</th>
                            <th scope="col">氏名</th>
                            <th scope="col">件名</th>
                            <th scope="col">登録日時</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                            <tr>
                            <th>{{ $contact->id }}</th>
                            <td>{{ $contact->your_name }}</td>
                            <td>{{ $contact->title }}</td>
                            <td>{{ $contact->created_at }}</td>
                            <td><a href="{{ route('contact.show', ['id' => $contact->id ]) }}">詳細を見る</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- 未指定だとLaravelのページネーションがデフォルトでTailwind(cssフレームワーク)互換になってると崩れる -->
                    <!-- インスタンスメソッドを使えばページとページ内アイテムの取得の仕方を変えれる(古い順、IDの順など)-->
                    {{ $contacts ->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection