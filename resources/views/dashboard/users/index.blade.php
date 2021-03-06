@extends('layouts.dashboard')

@section('content')
    <div class="w-75">
        <h1>顧客一覧</h1>

        <div class="w-75">
            <form method="GET" action="{{ route('dashboard.users.index') }}">
                <div class="d-flex flex-inline form-group">
                    <div class="d-flex align-items-center">
                        ID・氏名など
                    </div>
                    <textarea name="keyword" id="search-products" class="form-control mx-2 w-50">{{ $keyword }}</textarea>
                </div>
                <button type="submit" class="btn samazon-submit-button">検索</button>
            </form>
        </div>

        <table class="table mt-5">
            <thead>
                <tr>
                    <th scope="col" class="w-25">ID</th>
                    <th scope="col">名前</th>
                    <th scope="col">メールアドレス</th>
                    <th scope="col">電話番号</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            @if($user->delete_flag)
                                <form action="/dashboard/users/{{ $user->id }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn dashboard-delete-link">復帰</button>
                                </form>
                            @else
                                <form action="/dashboard/users/{{ $user->id }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn dashboard-delete-link">削除</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links('vendor.pagination.bootstrap-5') }}
    </div>
@endsection
