$(document).ready(function () {

    var dropSection = $('#drop-section').get(0);
    var files;

    /*
     * Drag over
     */
    dropSection.ondragover = function () {
        $(this).addClass("dragover");
        return false;
    };

    /*
     * Drag outside section
     */
    dropSection.ondragleave = function () {
        $(this).removeClass("dragover");
        return false;
    };

    /*
     * Drop On
     */
    dropSection.ondrop = function (e) {

        e.preventDefault();
        $(this).removeClass("dragover");

        console.log(e.dataTransfer.files);

        files = e.dataTransfer.files;

        var reader = new FileReader();

        reader.onload = function (e) {
            $('#audio_player').attr('src', e.target.result);
        }
        reader.readAsDataURL(files[0]);
    };

    /*
     * Upload-button click
     */

    $('#btn-upload').click(function () {
        $('#btn-upload-data').click();
    });

    $('#btn-upload-data').change(function (e) {

        files = e.currentTarget.files;

        console.log(files[0]);

        var reader = new FileReader();

        reader.onload = function (e) {
            $('#audio_player').attr('src', e.target.result);
        }
        reader.readAsDataURL(files[0]);
    });

    /*
     * Save Changes
     */

    $('#btn-upload-save').click(function (e) {

        var form = $('#myform').get(0);
        var data = new FormData(form);
        data.append("file", files[0]);
        console.log(data);

        $('#btn-upload').prop("disabled", true);
        $('#btn-upload').addClass("disable");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/upload',
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (e) {
                    var p = Math.round(e.loaded / e.total * 100);
                    $('.progress-bar').empty().css("width", p + "%");
                }, false);
                return xhr;
            },
            success: function (result) {
                if (result != '' && result != 'No Data Found') {

                    $('#btn-cancel').prop('disabled', true).addClass('disable');
                    $('#btn-upload').prop('disabled', false).removeClass('disable');


                    var template = $('#template-new-row').html();
                    var rendered = Mustache.render(template, result);
                    $('#music-table-body').append(rendered);

                } else {
                    alert("Data Not Found");
                }
            },
        });
    });
});

