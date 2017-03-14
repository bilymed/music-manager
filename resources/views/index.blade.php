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


@endsection

@section('scripts')
    <script>

        $(document).ready(function () {

            /*
             * Filter By Tag
             */
            var tag_id;

            $('#music-tag').on('change', function (e) {
                tag_id = e.target.value;

                //Ajax
                $.get('/music/tag/' + tag_id, function (data) {
                    $('#music-table-body').empty();
                    $('#filter-by-name').val("");
                    console.log(data);
                    var template = $('#template').html();
                    var rendered = Mustache.render(template, data);
                    $('#music-table-body').html(rendered);
                });
            });

            /*
             * Filter By Name
             */

            $('#filter-by-name').keyup(function () {
                var name = $(this).val();

                /*if (name.length == 0) {
                    alert('The box is empty');
                }*/




                $.get('/music-by-name?name=' + name + '&tag_id=' + tag_id, function (data) {
                    console.log(data);
                    $('#music-table-body').empty();
                    var template = $('#template').html();
                    var rendered = Mustache.render(template, data);
                    $('#music-table-body').html(rendered);

                });

                $('#filter-by-name').focus();

            });
        });
    </script>
@endsection