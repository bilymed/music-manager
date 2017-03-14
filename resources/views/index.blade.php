@extends('layouts.app')

@section('content')

    <div class="clearfix">
        <form class="form-inline pull-right">
            <div class="form-group">
                <input type="text" class="form-control" id="filter-by-name" placeholder="Filter By Name"
                       style="width: 300px">
            </div>
            <!--<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>-->
            <div class="form-group" style="margin-left: 50px">
                <select name="music-tag" class="form-control" id="music-tag" style="width: 200px">
                    <option value="0">Select All</option>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

        </form>


        <table id="music-table" class="table table-hover">
            <thead>
            <th>Music List</th>
            <th>Name</th>
            <th>Tag</th>
            </thead>
            <tbody id="music-table-body">

            @foreach ($musics as $music)
                <tr>
                    <td>
                        <audio controls="controls">
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

            </tbody>
        </table>
    </div>
    <hr>

    @include('partials.modal')
    @include('partials.table')
    @include('partials.row')


@endsection

@section('scripts')
    <script>

    </script>
@endsection