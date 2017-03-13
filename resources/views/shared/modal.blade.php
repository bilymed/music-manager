<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="progress">
                <div class="progress-bar" role="progressbar">
                </div>
            </div>
            <div class="modal-body clearfix">

                <form id="myform" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="inputName">Music Name </label>
                        <input type="text" name="music-name" class="form-control" id="inputName" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <label for="music-tag">Select list:</label>
                        <select name="music-tag" class="form-control" id="music-tag">
                            <option value="1">Country</option>
                            <option value="2">Rock</option>
                            <option value="3">Bla</option>
                        </select>
                    </div>

                    <div class="form-group">

                        <div id="drop-section">Drop here</div>
                        <input type="file" name="file" id="btn-upload-data">
                        <button id="btn-upload" class="btn btn-primary">Upload</button>

                        <audio controls="controls" id="audio_player">
                            <source src="#" type="audio/ogg"/>
                            <source src="#" type="audio/mpeg"/>
                            Your browser does not support the audio element.
                        </audio>
                    </div>

                    <div class="result"></div>
                    <div class="clear"></div>
                    <hr>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="btn-upload-save" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>