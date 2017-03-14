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