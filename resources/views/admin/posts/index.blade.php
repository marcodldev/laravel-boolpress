@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Posts</h1>

        <a href="{{route('admin.posts.create')}}">Crea nuovo post</a>


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col"> Titolo</th>
                    <th scope="col">Messaggio</th>
                    <th scope="col">category_id</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            <a href="{{ route('admin.posts.show', $post->id) }}">
                                {{ $post->title }}
                            </a>
                        </td>
                        <td>{{ $post->body }}</td>

                        {{-- STAMPA DEI DATI DELLA TABELLA MESSA IN RELAZIONE --}}

                        <td>
                            @if ($post->category)
                            {{ $post->category['name'] }}
                            @endif
                        </td>

                        {{-- (N) a (N) --}}

                        <td>
                            @foreach ($post->tags as $singoloTag)
                            {{ $singoloTag->name }}
                            @endforeach
                        </td>


                       {{-- ------------------------------------------------------------ --}}

                        <td class="">
                            <a class="btn btn-primary my-1" href="{{route('admin.posts.edit',$post->id)}}">
                                edit
                            </a>
                            <form method="POST" action="{{route('admin.posts.destroy',$post->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger my-1">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>




    </div>
@endsection
