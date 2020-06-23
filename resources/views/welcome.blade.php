<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/main.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen antialiased leading-none">
    <div class="flex flex-col">
        @if(Route::has('login'))
        <div class="absolute top-0 right-0 mt-4 mr-4">
            @auth
            <a href="{{ url('/home') }}"
                class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase">{{ __('Home') }}</a>
            @else
            <a href="{{ route('login') }}"
                class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase pr-6">{{ __('Login') }}</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase">{{ __('Register') }}</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="min-h-screen flex items-center justify-center">
            <div class="flex flex-col justify-around h-full">
                <div>
                    <h1 class="text-gray-600 text-center font-light tracking-wider text-5xl mb-6">
                        {{ config('app.name', 'Laravel') }}
                    </h1>
                    <ul class="list-reset">
                        <li class="inline pr-8">
                            <a href="https://laravel.com/docs"
                                class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase"
                                title="Documentation">Documentation</a>
                        </li>
                        <li class="inline pr-8">
                            <a href="https://laracasts.com"
                                class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase"
                                title="Laracasts">Laracasts</a>
                        </li>
                        <li class="inline pr-8">
                            <a href="https://laravel-news.com"
                                class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase"
                                title="News">News</a>
                        </li>
                        <li class="inline pr-8">
                            <a href="https://nova.laravel.com"
                                class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase"
                                title="Nova">Nova</a>
                        </li>
                        <li class="inline pr-8">
                            <a href="https://forge.laravel.com"
                                class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase"
                                title="Forge">Forge</a>
                        </li>
                        <li class="inline pr-8">
                            <a href="https://vapor.laravel.com"
                                class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase"
                                title="Vapor">Vapor</a>
                        </li>
                        <li class="inline pr-8">
                            <a href="https://github.com/laravel/laravel"
                                class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase"
                                title="GitHub">GitHub</a>
                        </li>
                    </ul>
                </div>
                @can('delete-user', auth()->user())
                <a href="user/{{auth()->user()->id}}/delete">delete account</a>
                @endcan
            </div>
        </div>
        @can('viewAny', 'App\Post')

        <div>
            @foreach($posts as $post)
            <h3>{{$post->title}} | active: @if($post->active) ✅ @else ❌ @endif</h3>
            <p>{{$post->body}}</p>
            <p>created by: {{$post->user->name}}</p>
            @canany(['togglePost', 'always-toggle-post'], $post)
            <a href="post/{{$post->id}}/toggle">toggle activity</a>
            @endcanany

            @endforeach
        </div>
        @endcan
    </div>
</body>

</html>