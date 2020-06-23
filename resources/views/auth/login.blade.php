@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-sm">
            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">

                <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                    {{ __('Login') }}
                </div>

                <form class="w-full p-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="flex flex-wrap mb-6">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('E-Mail Address') }}:
                        </label>

                        <input id="email" type="email"
                            class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal w-full @error('email') border-red-500 @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password"
                            class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal w-full @error('password') border-red-500 @enderror"
                            name="password" required>

                        @error('password')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex mb-6">
                        <label class="inline-flex items-center text-sm text-gray-700" for="remember">
                            <input type="checkbox" name="remember" id="remember" class="form-checkbox"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span class="ml-2">{{ __('Remember Me') }}</span>
                        </label>
                    </div>

                    <div class="flex flex-wrap items-center">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-gray-100 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                        <a class="text-sm text-blue-500 hover:text-blue-700 whitespace-no-wrap no-underline ml-auto"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif

                        @if (Route::has('register'))
                        <p class="w-full text-xs text-center text-gray-700 mt-8 -mb-4">
                            {{ __("Don't have an account?") }}
                            <a class="text-blue-500 hover:text-blue-700 no-underline" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        </p>
                        @endif
                    </div>
                </form>

                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm leading-5">
                            <span class="px-2 bg-white text-gray-500">
                                Or continue with
                            </span>
                        </div>
                    </div>
                    <div class="mb-6 mx-4">
                        <div class="mt-6 grid grid-cols-2 gap-3">



                            <div>
                                <span class="w-full inline-flex rounded-md shadow-sm">
                                <a type="button" href="auth/github"
                                        class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition duration-150 ease-in-out"
                                        aria-label="Sign in with GitHub">
                                        <svg class="h-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </span>
                            </div>
                            <div>
                                <span class="w-full inline-flex rounded-md shadow-sm">
                                <a type="button" href="auth/gitlab"
                                        class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition duration-150 ease-in-out"
                                        aria-label="Sign in with Gilab">
Gitlab
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection