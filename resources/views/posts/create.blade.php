@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <h1 class="text-3xl mb-6">
            Appeal & Track Problem 
        </h1>

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="relative z-0 mb-6 w-full group">
                <label  class="block mb-2 text-sm font-medium dark:text-gray-300">
                    Add Image
                </label>

                <input 
                    type="file" 
                    class="form-control" 
                    name="image">



                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Report Problem
                </label>

                @if ($errors->has('title'))
                    <p class="text-red-500">
                        {{ $errors->first('title') }}
                    </p>
                @endif

                <input type="text" name="title" id="title"
                       class="bg-gray-50 border @if($errors->has('title')) border-red-300 @else border-gray-300 @endif text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ old('title') }}"
                       placeholder="" required>
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Tags 
                </label>
                <input type="text" name="tags" id="tags"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ old('tags') }}"
                       placeholder="" autocomplete="off">
            </div>


            <div class="relative z-0 mb-6 w-full group">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                    Description
                </label>

                @if($errors->has('description'))
                    <p class="text-red-500">
                        {{ $errors->first('description') }}
                    </p>
                @endif
                <textarea rows="4" type="text" name="description" id="description"
                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          required >{{ old('description') }}</textarea>
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label for="place" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Place 
                </label>
                <input type="text" name="place" id="place"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ old('place') }}"
                       placeholder="" autocomplete="off">
            </div>

            <select name="role" class="form-control custom-select">
                    <option value="">Select Role</option
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" @if(old('role') == $role->id ) selected @endif>{{ $role->name }}</option>
                    @endforeach
            </select>

            <div class="relative z-0 mb-6 w-full group">
                <label for="agency" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Agency
                </label>
                <input type="text" name="agency" id="agency"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ old('agency') }}"
                       placeholder="" autocomplete="off">
            </div>

            <div>
                <button class="app-button" type="submit">Create</button>
            </div>

        </form>
    </section>

@endsection
