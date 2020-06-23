@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-sm">


            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">
                <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                    {{ __('Verify Your Phone Number') }}
                </div>

                <div class="w-full flex flex-wrap p-6">


                    <form  method="POST" action="{{ route('verify/phone') }}">
                        @csrf

                    <div class="flex flex-wrap mb-6">
                        <label for="verification_code" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('Verification Token') }}:
                        </label>

                        <input id="verification_code" type="number"
                            class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal w-full @error('verification_code') border-red-500 @enderror" name="verification_code"
                            value="{{ old('verification_code') }}" required>

                        @error('verification_code')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="flex flex-wrap">
                        <button type="submit"
                            class="inline-block align-middle text-center select-none border font-bold whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700">
                            {{ __('Submit') }}
                        </button>


                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection