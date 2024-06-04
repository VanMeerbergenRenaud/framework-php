<form action="/login"
      method="post"
      class="flex flex-col gap-8">
    <?php
    csrf_token() ?>
    <div class="flex flex-col gap-2">
        <?php
        component('forms.controls.label-and-input', [
            'name' => 'email',
            'label' => 'Adresse email<small class="block font-normal">doit être valide et enregistrée dans notre système</small>',
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
            'type' => 'password',
            'value' => '',
            'placeholder' => 'ch4nge_th1s',

        ]);
        ?>
    </div>
    <div>
        <?php
        component('forms.controls.button', ['text' => 'S’identifier']) ?>
    </div>
    <?php
    $_SESSION['errors'] = [];
    $_SESSION['old'] = [];
    ?>
</form>