{{-- resources/views/posts/show.blade.php --}}
@extends('layouts.main')

@section('content')
    <article class="mx-8">
        <br><br><br><br>
        <h1 class="text-3xl mb-1">
            {{ $post->title }}
        </h1>

        <p>
            <a class="text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2"
                href="{{ route('your_posts') }}">

                @if($post->status == 1)
                    <span class="bg-pink-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">By Anonymous</span>
                @else
                    <span class="bg-pink-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">By {{ $post->user->name }}</span>
                @endif    
            </a>
        </p>

        <div>
            @foreach($post->tags as $tag)
                <a class="bg-pink-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2"
                    href="{{ route('tags.show', $tag->name) }}">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>

        <div class="my-4">
            <img src="{{ asset('images/'.$post->image_path) }}" alt="post image" width=300 hieght=200>
        </div>

        <p class="text-gray-900 font-normal p-2 mb-8">
            {{ $post->description }}
        </p>

        <p class="">
            <label class="block mb-2 text-sm font-bold text-green-700 dark:text-black-700">
                    สถานที่ที่พบเจอปัญหา
            </label>

            <label class="rounded-Ig text-gray-900 font-normal p-2 mb-8 p-2.5">
                {{ $post->place }}
            </label>     
        </p>

        <p class="">
            <label class="block mb-2 text-sm font-bold text-green-700 dark:text-black-700 mt-4">
                หน่วยงานที่รับเรื่อง
            </label>
            @foreach($post->sectors as $sector)
                <label class="rounded-Ig text-gray-900 font-normal p-2 mb-8 p-2.5">
                        {{ $sector->name }}
                </label>
            @endforeach
        </p>

        <p class="">
            <label class="block mb-2 text-sm text-green-700 font-bold dark:text-black-700 mt-4">
                สถานะการจัดการปัญหา
            </label>

            <label class="rounded-Ig text-gray-900 font-normal p-2 mb-8 p-2.5">
                {{ $post->following }}
            </label>
        </p>

        <div class="relative py-4">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-b border-gray-300"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="bg-white px-4 text-sm text-gray-500">Action</span>
            </div>
        </div>

        @can('update', $post)
            <div>
                <a class="app-button" href="{{ route('posts.edit', ['post' => $post->id]) }}">
                    แก้ไขข้อมูลปัญหา
                </a>
            </div>
        @endcan

    </article>

    <section class="mx-16 mt-8">
        <form action="{{ route('posts.comments.store', ['post' => $post->id]) }}" method="post">
            @csrf
            <div>
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Your message</label>
                <textarea name="message" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your message..."></textarea>
            </div>
            <div class="mt-2">
                <button type="submit" class="app-button">Comment</button>
            </div>

        </form>
    </section>

    @if ($post->comments)
        <section class="mt-8 mx-16">
            <h1 class="text-3xl mb-2">{{ $post->comments->count() }} Comments</h1>

            @foreach($post->comments->sortByDesc('created_at') as $comment)
                <div class="mb-2 block p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 ">
                    <p class="bg-orange-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                        {{ $comment->created_at->diffForHumans() }}
                    </p>
                    <div class="text-lg pl-3">
                        {{ $comment->message }}
                    </div>
                </div>
            @endforeach
        </section>
    @endif
@endsection
