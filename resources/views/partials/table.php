<script id="template" type="x-tmpl-mustache">

    {{#musics}}
    <tr>
        <td>
            <audio controls="controls">
                <source src="{{url}}" type="audio/mpeg"/>
            </audio>
        </td>
        <td>
            {{name}}
        </td>
        <td>
            {{tag.name}}
        </td>
    <tr>
   {{/musics}}

   {{^musics}}
   <tr>
        <td colspan="3"><em>No matches found</em></td>
   </tr>
   {{/musics}}


</script>
