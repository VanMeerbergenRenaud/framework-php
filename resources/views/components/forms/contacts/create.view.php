<form action="/contact"
      method="post"
      class="flex flex-col gap-6 bg-slate-50 p-4">
    <?php
    csrf_token() ?>
    <div class="flex flex-col gap-2">
        <?php
        component('forms.controls.label-and-input', [
            'name' => 'name',
            'label' => 'Nom et prénon du contact<span class="block font-normal">au moins 3 caractères, au plus 255</span>',
            'type' => 'text',
            'value' => '',
            'placeholder' => 'Richard Durgan',
        ]);
        ?>

    </div>
    <div class="flex flex-col gap-2">
        <?php
        component('forms.controls.label-and-input', [
            'name' => 'email',
            'label' => 'Adresse email<span class="block font-normal">doit être valide. Elle permettra de l’inviter.</span>',
            'type' => 'text',
            'value' => '',
            'placeholder' => 'burt.jacobs@yahoo.com',
        ]);
        ?>

    </div>

    <div>
        <?php
        component('forms.controls.button', ['text' => 'Créer ce contact']) ?>
    </div>
    <?php
    $_SESSION['errors'] = [];
    $_SESSION['old'] = [];
    ?>
</form>