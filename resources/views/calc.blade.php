@extends('layouts.app')

@section('content')

@if($errors->any())

<div class="rounded-md bg-red-100 p-4 m-10">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <div class="mt-2 text-sm leading-5 text-red-700">
                <ul class="list-disc pl-5">

                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</div>
@endif



<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-1 mx-10">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="/calc" method="POST">
                @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="x" class="block text-sm font-medium leading-5 text-gray-700">X
                                </label>
                                <input id="x"
                                    class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                    name="x" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="y" class="block text-sm font-medium leading-5 text-gray-700">Y
                                </label>
                                <input id="y"
                                    class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                    name="y" />
                            </div>



                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button
                            class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                            Calc
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection