<?php
/** @var TYPE_NAME $label */ ?>
<form action="/">
    <label for="search"
           class="font-bold"><?= $label ?></label>
    <input type="text"
           id="search"
           name="search"
           class="border rounded-md px-2">
    <?php
    component('forms.controls.button', ['text' => 'Chercher']) ?>
</form>