<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <div class="quick-file template-download">
        <div class="preview">
            {% if (file.thumbnailUrl) { %}
                <img src="{%=file.thumbnailUrl%}">
            {% } %}
        </div>
        {% if (file.error) { %}
            <div class="error text-danger">{%=file.error%}</div>
        {% } %}
        <div class="size">{%=o.formatFileSize(file.size)%}</div>
        <div class="actions">
            {% if (file.deleteUrl) { %}
                <i class="fa fa-lg fa-close delete" title="Click to remove this item" data-id="{%=file.id%}" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}></i>
            {% } %}
        </div>
    </div>
{% } %}

</script>
