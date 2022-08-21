@extends('layouts.main')

@section('content')
<section class="mx-8">
    <br><br><br><br>
        <div class="my-1 px-8 py-2 flex flex-wrap justify-between space-y-6">
            @foreach($notes as $note)
                <h1 class="text-3xl mx-4 mt-6">
                    {{ $note->sector->name }}
                </h1>
                <p class="app-box">
                    {{ $note->description }}
                </p>
            @endforeach
        </div>
    </section>
    
@endsection