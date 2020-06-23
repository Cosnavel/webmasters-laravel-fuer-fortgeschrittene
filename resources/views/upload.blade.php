@extends('layouts.app')

@section('content')

<div class="flex items-center">

    <div class="md:w-1/2 md:mx-auto">

        <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">

            <div class="w-full p-6">

                <form action="upload" method="post" enctype="multipart/form-data">

                    @csrf

                    <div class="sm:col-span-6 mt-6">

                        <input type="file" name="image" accept="image/*" />

                        @error('image')

                        <p class="text-red-500 text-xs italic">{{ $message }}</p>

                        @enderror

                    </div>
                    <div
                        class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">

                        <label for="disk" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">

                            Disk

                        </label>

                        <div class="mt-1 sm:mt-0 sm:col-span-2">

                            <div class="max-w-xs rounded-md shadow-sm">

                                <select id="disk" name="disk"
                                    class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">

                                    <option>Local</option>

                                    <option>Dropbox</option>

                                    <option>FTP</option>

                                </select>

                            </div>

                        </div>

                    </div>


                    <div class="mt-8 border-t border-gray-200 pt-5">

                        <div class="flex justify-end">

                            <span class="ml-3 inline-flex rounded-md shadow-sm">

                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">

                                    Save

                                </button>

                            </span>

                        </div>

                    </div>

                </form>
                <form method="POST" action="directory">
                    @csrf

                    <input type="text" name="directory" required />
                    <button type="submit">Submit</button>
                </form>

                <div>
                    <ul>
                        @foreach ($files as $file)
                        <li>{{$file}}</li>
                        @endforeach
                        @foreach ($directories as $directory)
                        <li>{{$directory}}</li>
                        @endforeach
                    </ul>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection