<?php
/** @var string $label */ ?>
<form action="/jiri/search" method="get">
    <?php /*csrf_token(); */?>
    <?php component('forms.controls.label-and-input', ['label' => $label, 'name' => 'query']); ?>
    <?php component('forms.controls.button', ['text' => 'Chercher']) ?>
</form>