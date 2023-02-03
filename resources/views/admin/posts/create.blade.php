@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="text-center">
            <h1>Crea nuovo post</h1>
        </div>


        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="my-3">
                <label class="form-label" for="">Titolo</label>
                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title">
                @error('title')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="my-3">
                <label class="form-label" for="">Testo</label>
                <textarea class="form-control @error('body') is-invalid @enderror" type="text" name="body">

            </textarea>
                @error('body')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- CATEGORY (relazione) --}}

            <div class="my-3">
                <label for="">Categories</label>
                <select class="form-control" name="category_id" id="">
                    <option value="">Seleziona la categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="my-3">
                <label for="">Tags: </label>
                @foreach ($tags as $tag)
                    <label>
                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}">
                        {{$tag->name}}
                    </label>
                @endforeach
            </div>


            {{-- UPLOAD IMMAGINI --}}

            <div class="my-3">
                <label for="">Aggiungi immagine</label>
                <input type="file" name="image" class="form-control-file">
            </div>



            <button type="submit" class="btn btn-primary">Crea</button>


        </form>

    </div>
@endsection
