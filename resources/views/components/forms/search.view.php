<?php
/** @var string $label */ ?>
<form action="/">
    <?php
    component('forms.controls.label-and-input', ['label' => $label]);
    ?>
    <?php
    component('forms.controls.button', ['text' => 'Chercher']) ?>
</form>