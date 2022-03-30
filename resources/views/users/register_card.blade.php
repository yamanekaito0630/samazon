<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js', true) }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css', true) }}" rel="stylesheet">
    <link href="{{ asset('css/samazon.css', true)}}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/3723f06c66.js" crossorigin="anonymous"></script>

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    @component('components.header')
    @endcomponent
    <main class="py-4 mb-5">
        <div class="d-flex justify-content-center">
            <div class="container w-50">
                @if(!empty($card))
                    <h3>登録済みのクレジットカード</h3>

                    <hr>
                    <h4>{{ $card["brand"] }}</h4>
                    <p>有効期限: {{ $card["exp_year"] }}/{{ $card["exp_month"] }}</p>
                    <p>カード番号: ************{{ $card["last4"] }}</p>
                @endif

                <form action="/users/mypage/token" method="POST">
                    @csrf
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                    @if(empty($card))
                        <script type="text/javascript" src="https://checkout.pay.jp/" class="payjp-button" data-key="{{ env('PAYJP_PUBLIC_KEY') }}" data-on-created="onCreated" data-text="カードを登録する" data-submit-text="カードを登録する"></script>
                    @else
                        <script type="text/javascript" src="https://checkout.pay.jp/" class="payjp-button" data-key="{{ env('PAYJP_PUBLIC_KEY') }}" data-on-created="onCreated" data-text="カードを更新する" data-submit-text="カードを更新する"></script>
                    @endif
                </form>
            </div>
        </div>
    </main>

@component('components.footer')
@endcomponent
</body>
</html>
