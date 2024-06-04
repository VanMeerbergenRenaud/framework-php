<?php
/** @var string $id */ ?>
<form action="/contact"
      method="post">
    <?php
    method('delete') ?>
    <?php
    csrf_token() ?>
    <input type="hidden"
           name="id"
           value="<?= $id ?>">
    <?php
    component('forms.controls.button-danger', ['text' => 'Supprimer ce contact']); ?>
</form>