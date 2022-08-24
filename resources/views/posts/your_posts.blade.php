{{-- resources/views/posts/your_posts.blade.php --}}
@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <br><br><br><br>
        <h1 class="text-3xl mx-6 mt-6">
            ปัญหาทั้งหมดของคุณ
        </h1>
        <div class="my-1 px-8 py-2 flex flex-wrap justify-between space-y-6">
            @foreach($posts as $post)
                <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="app-box-full">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">
                        {{ $post->title }}
                    </h5>

                    @if($post->status == 1)
                        <span class="bg-pink-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">By Anonymous</span>
                    @elseif($post->status == 0)
                        <span class="bg-pink-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">By {{ $post->user->name }}</span>
                    @endif

                    @foreach($post->tags as $tag)
                        <span class="bg-blue-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">{{ $tag->name }}</span>
                    @endforeach
                    <span class="bg-yellow-50 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">{{ $post->following }}</span>
                </a>
            @endforeach
        </div>
    </section>
@endsection

