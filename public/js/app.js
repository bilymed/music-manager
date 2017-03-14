$(document).ready(function () {
    var dropSection = document.getElementById('drop-section');
    var files;

    $('#btn-upload').click(function () {
        $('#btn-upload-data').click();
    });

    dropSection.ondragover = function () {
        $(this).addClass("dragover");
        return false;
    };

    dropSection.ondragleave = function () {
        $(this).removeClass("dragover");
        return false;
    };

    /*
     * Drag and Drop
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
     * Drag and Drop
     */
    $('#btn-upload-data').change(function (e) {

        var files = e.currentTarget.files;

        var reader = new FileReader();

        reader.onload = function (e) {
            $('#audio_player').attr('src', e.target.result);
        }
        reader.readAsDataURL(files[0]);
    });

    $('#btn-upload-save').click(function (e) {

        $('#btn-upload').prop("disabled", true);
        $('#btn-upload').addClass("disable");

        upload(files);
    });

    function upload(files) {

        var form = document.getElementById('myform');
        var formData = new FormData(form);
        var xhr = new XMLHttpRequest();
        var x;

        formData.append("file", files[0]);


        xhr.upload.addEventListener("progress", function (e) {
            var p = Math.round(e.loaded / e.total * 100);
            $('.progress-bar').empty().css("width", p + "%");
        });

        $('#btn-cancel').click(function () {
            xhr.abort();
            $('.progress-bar').addClass('abort').empty().append("(aborted)");
        });

        xhr.onreadystatechange = function () {

            if (xhr.readyState == 4 && xhr.status == 200) {

                var result = this.responseText;

                if (result != '' && result != 'No Data Found') {

                    $('#btn-cancel').prop('disabled', true).addClass('disable');
                    $('#btn-upload').prop('disabled', false).removeClass('disable');

                    result = JSON.parse(result);

                    if (result.status == true) {

                    } else {

                        var template = $('#template-new-row').html();
                        var rendered = Mustache.render(template, result);
                        $('#music-table-body').append(rendered);
                    }
                } else {
                    alert("Data Not Found");
                }

                console.log(result);
            }
        };

        xhr.open("post", "/upload", true);
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        xhr.send(formData);
    }
});

