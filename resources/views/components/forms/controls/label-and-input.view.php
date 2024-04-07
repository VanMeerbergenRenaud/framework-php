<?php
/** @var string $name */
/** @var string $label */
/** @var string $type */
/** @var string $value */
/** @var string $placeholder */
?>
<label for="<?= $name ?>"
       class="font-bold mr-2">
    <?= $label ?>
</label>
<input id="<?= $name ?>"
       type="<?= $type ?>"
       value="<?= $_SESSION['old'][$name] ?? $value ?>"
       name="<?= $name ?>"
       placeholder="<?= $placeholder ?? '' ?>"
       class="border rounded-md p-2 w-full">
<?php if(isset($_SESSION['errors'][$name])): ?>
        <p class="text-red-500 text-xs italic"><?= $_SESSION['errors'][$name] ?></p>
<?php endif; ?>