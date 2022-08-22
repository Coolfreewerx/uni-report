<?php
    use App\models\Sector;
    $sectors = Sector::all();
?>

@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <br><br><br><br><br><br>
        <h1 class="text-3xl mb-6">
            ร้องเรียนและติดตามปัญหาของนิสิต 
        </h1>

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="relative z-0 mb-6 w-full group">
                <label  class="block mb-2 text-sm font-bold text-green-700 dark:text-gray-300">
                    เพิ่มรูปภาพ
                </label>

                <input 
                    type="file" 
                    class="form-control" 
                    name="image">
            </div>

            <div>
                <label for="title" class="block mb-2 text-sm font-bold text-green-700 dark:text-gray-300">
                    ปัญหาที่ต้องการแจ้ง
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
                <label for="tags" class="block mb-2 mt-2 text-sm font-bold text-green-700 dark:text-gray-300">
                    หมวดหมู่ปัญหา
                </label>
                <input type="text" name="tags" id="tags"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ old('tags') }}"
                       placeholder="" autocomplete="off">
            </div>


            <div class="relative z-0 mb-6 w-full group">
                <label for="description" class="block mb-2 text-sm font-bold text-green-700 dark:text-gray-400">
                    คำอธิบายปัญหา (หากไม่เป็นการรบกวน กรุณาใส่ช่องทางการติดต่อ)
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
                <label for="place" class="block mb-2 text-sm font-bold text-green-700 dark:text-gray-300">
                    สถานที่ที่พบเจอปัญหา
                </label>
                <input type="text" name="place" id="place"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ old('place') }}"
                       placeholder="" autocomplete="off">
            </div>


            <div>
                <x-label for="sector" class="font-bold text-green-700" :value="__('หน่วยงานที่ต้องการแจ้ง')" />
                <select name="sector" id="sector" class="form-control">
                    @foreach($sectors as $sector)
                        
                    <option value="{{ $sector->name }}"

                        @if(old('sector') == $sector->id) 
                            selected 
                        @endif>{{ $sector->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mx-3 my-4">
                <input type = "checkbox" name="status">
                <label for="status"> โหมดไม่ระบุตัวตน </label>

                @if($errors->has('status'))
                    <p class="text-red-500">
                        {{ $errors->first('status') }}
                    </p>    
                @endif
            </div>

            <div>
                <button class="app-button my-6" type="submit">แจ้งปัญหา</button>
            </div>

        </form>
    </section>

@endsection
