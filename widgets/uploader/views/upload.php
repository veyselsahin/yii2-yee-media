<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <div class="quick-file">
        <div class="preview" ></div>
        <div class="error text-danger"></div>
        <div class="size"><?= \Yii::t('yee', 'Processing') ?>...</div>
        <div class="progress active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-primary" style="width:0%;"></div>
        </div>
    </div>
{% } %}

</script>