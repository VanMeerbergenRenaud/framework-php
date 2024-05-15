<?php
/** @var string $name */

/** @var string $label */
/** @var string $type */
/** @var string $value */
/** @var string $placeholder */
?>
<label for="<?= $name ?>"
       class="font-bold"><?= $label ?></label>
<input id="<?= $name ?>"
       type="<?= $type ?>"
       value="<?= $_SESSION['old'][$name] ?? $value ?>"
       name="<?= $name ?>"
       placeholder="<?= $placeholder ?>"
       class="border border-grey-700 rounded-md px-2">
<?php
if (isset($_SESSION['errors'][$name])) { ?>
    <p class="text-red-500"><?= $_SESSION['errors'][$name] ?></p>
    <?php
} ?>
