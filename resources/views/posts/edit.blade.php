@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <br><br><br><br>
        <h1 class="text-3xl mb-6">
            แก้ไขข้อมูลปัญหา
        </h1>

        <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="relative z-0 mb-6 w-full group">
                <label for="title" class="block mb-2 text-sm font-bold text-green-700 dark:text-gray-300">
                    ปัญหาที่ต้องการแจ้ง
                </label>
                @if ($errors->has('title'))
                    <p class="text-red-500">
                        {{ $errors->first('title') }}
                    </p>
                @endif
                <input type="text" name="title" id="title"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ old('title', $post->title) }}"
                       placeholder="" required>
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label for="tags" class="block mb-2 text-sm font-bold text-green-700">
                    หมวดหมู่ปัญหา
                </label>
                <input type="text" name="tags" id="tags"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ $tags }}"
                       placeholder="" autocomplete="off">
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label for="description" class="block mb-2 text-sm font-bold text-green-700 text-gray-900 dark:text-gray-400">
                คำอธิบายปัญหา (หากไม่เป็นการรบกวน กรุณาใส่ช่องทางการติดต่อ)
                </label>
                @if ($errors->has('description'))
                    <p class="text-red-500">
                        {{ $errors->first('description') }}
                    </p>
                @endif
                <textarea rows="4" type="text" name="description" id="description"
                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          required >{{ old('description', $post->description) }}</textarea>
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label for="place" class="block mb-2 text-sm font-bold text-green-700 dark:text-gray-400">
                    สถานที่ที่พบเจอปัญหา
                </label>
                @if ($errors->has('place'))
                    <p class="text-red-500">
                        {{ $errors->first('place') }}
                    </p>
                @endif
                <textarea rows="4" type="text" name="place" id="place"
                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          required >{{ old('place', $post->place) }}</textarea>
            </div>

    @can('delete', $post)
            <div>
                <x-label for="following" class="font-bold text-green-700" :value="__('สถานะการดำเนินการ')" />
                <select name="following" id="following" class="form-control">
                    <@php($followings = ['รับเรื่องร้องเรียน','กำลังดำเนินการ','ดำเนินการเสร็จสมบูรณ์'])>
                    @foreach($followings as $following)
                        <option value="{{ $following }}">{{$following}}</option>
                    @endforeach
                </select>
            </div>
    @endcan
            <div>
                <button class="app-button mt-6" type="submit">แก้ไขข้อมูลปัญหา</button>
            </div>

        </form>
    </section>


    @can('delete', $post)
        <section class="mx-8 mt-16">
            <div class="relative py-4">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-b border-red-300"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-white px-4 text-sm text-red-500">Danger Zone</span>
                </div>
            </div>

            <div>
                <h3 class="text-red-600 mb-4 text-2xl">
                    ลบข้อมูลปัญหา
                    <p class="text-gray-800 text-xl">
                        ถ้าลบข้อมูลปัญหานี้แล้ว ปัญหาจะหายไป !
                    </p>
                </h3>

                <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="relative z-0 mb-6 w-full group">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            ปัญหาที่คุณต้องการลบ 
                        </label>
                        <input type="text" name="title" id="title"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="" required>
                    </div>
                    <button class="app-button red" type="submit">ลบข้อมูลปัญหา</button>
                </form>
            </div>
        </section>
    @endcan

@endsection
