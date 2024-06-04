<form action="/register"
      method="post"
      class="flex flex-col gap-6">
    <?php
    csrf_token() ?>
    <div class="flex flex-col gap-2">
        <?php
        component('forms.controls.label-and-input', [
            'name' => 'email',
            'label' => 'Adresse email<small class="block font-normal">doit être valide et n’avoir jamais été utilisée dans notre système.</small>',
            'type' => 'email',
            'value' => '',
            'placeholder' => 'jon@doe.com',
        ]);
        ?>

    </div>
    <div class="flex flex-col gap-2">
        <?php
        component('forms.controls.label-and-input', [
            'name' => 'password',
            'label' => 'Mot de passe<small class="block font-normal">au moins 8 caractères, des lettres, des chiffres et des caractères spéciaux (+-*/%!?_)</small>',
            'type' => 'text',
            'value' => '',
            'placeholder' => 'ch4nge_th1s',

        ]);
        ?>
    </div>
    <div>
        <?php
        component('forms.controls.button', ['text' => 'S’enregistrer']) ?>
    </div>
    <?php
    $_SESSION['errors'] = [];
    $_SESSION['old'] = [];
    ?>
</form>