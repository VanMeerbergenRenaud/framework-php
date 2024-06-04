<?php
/** @var string $id */ ?>
<form action="/jiri"
      method="post">
    <?php
    method('delete') ?>
    <?php
    csrf_token() ?>
    <input type="hidden"
           name="id"
           value="<?= $id ?>">
    <?php
    component('forms.controls.button-danger', ['text' => 'Supprimer ce jiri']); ?>
</form>