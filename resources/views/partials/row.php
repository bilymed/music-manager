<script id="template-new-row" type="x-tmpl-mustache">
<tr>
    <td>
        <audio controls="controls">
            <source src="{{track.url}}" type="audio/mpeg"/>
        </audio>
    </td>
    <td>
        {{track.music-name}}
    </td>
    <td>
        {{track.tag.name}}
    </td>
<tr>

</script>