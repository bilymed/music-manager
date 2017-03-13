@extends('layouts.app')

@section('content')

    @include('shared.modal')

    <hr>

    <table id="music-table" class="table table-hover">
        <th>Music List</th>
        <th>Name</th>
        <th>Tag</th>
        @foreach ($musics as $music)
            <tr>
                <td>
                    <audio controls="controls" id="audio_player">
                        <source src="{{ $music->url }}" type="audio/mpeg"/>
                    </audio>
                </td>
                <td>
                    {{ $music->name }}
                </td>
                <td>
                    {{ $music->tag->name }}
                </td>
            <tr>
        @endforeach
    </table>




@endsection

@section('scripts')
    <script>

    </script>
@endsection