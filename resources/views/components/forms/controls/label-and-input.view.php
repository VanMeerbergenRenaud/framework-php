<?php

/**
 * @var string $name
 * @var string $label
 * @var string $type
 * @var string $value
 * @var string $placeholder
 */
$name = $name ?? $label;
$type = $type ?? 'text';
$value = $value ?? '';
$placeholder = $placeholder ?? '';
?>
<label for="<?= $name ?>"
       class="font-bold"><?= $label ?></label>
<input id="<?= $name ?>"
       type="<?= $type ?>"
       value="<?= $_SESSION['old'][$name] ?? $value ?>"
       name="<?= $name ?>"
       placeholder="<?= $placeholder ?>"
       autocapitalize="none"
       autocorrect="off"
       spellcheck="false"
       class="border border-grey-700 focus:invalid:border-pink-500 invalid:text-pink-600 rounded-md p-2">
<?php
if (isset($_SESSION['errors'][$name])) { ?>
    <p class="text-red-500"><?= $_SESSION['errors'][$name] ?></p>
    <?php
} ?>
