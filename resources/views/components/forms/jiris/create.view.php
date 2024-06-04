<form action="/jiri"
      method="post"
      class="flex flex-col gap-8 bg-slate-50 p-4">
    <?php

    use Carbon\Carbon;

    csrf_token() ?>
    <div class="flex flex-col gap-2">
        <?php
        component('forms.controls.label-and-input', [
            'name' => 'name',
            'label' => 'Nom du jiri<span class="block font-normal">au moins 3 caractères, au plus 255</span>',
            'type' => 'text',
            'value' => '',
            'placeholder' => 'Mon examen de première session',
        ]);
        ?>

    </div>
    <div class="flex flex-col gap-2">
        <?php
        $date = Carbon::now()->format('Y-m-d H:i');
        component('forms.controls.label-and-input', [
            'name' => 'starting_at',
            'label' => 'Date et heure de début du jiri<span class="block font-normal">au format '.$date.'</span>',
            'type' => 'text',
            'value' => '',
            'placeholder' => $date,

        ]);
        ?>
    </div>
    <?php
    if (!empty($contacts)): ?>
        <fieldset>
            <legend class="font-bold mb-2 uppercase">Les participants</legend>
            <div class="flex flex-col gap-2">
                <?php
                /** @var array $contacts */
                foreach ($contacts as $contact): ?>
                    <div>
                        <input id="c-<?= $contact->id ?>"
                               type="checkbox"
                               name="contacts[]"
                               class="h-4 w-4"
                               value="<?= $contact->id ?>"
                        >
                        <label for="c-<?= $contact->id ?>"><?= $contact->name ?></label>
                        <select name="role-<?= $contact->id ?>"
                                id="role-<?= $contact->id ?>"
                                class="mx-2 p-2 rounded">
                            <option value="student">Étudiant</option>
                            <option value="evaluator">Évaluateur</option>
                        </select>
                        <label for="role-<?= $contact->id ?>"
                               class="font-bold sr-only">Rôle</label>
                    </div>
                <?php
                endforeach; ?>
            </div>
        </fieldset>
    <?php
    endif; ?>
    <div>
        <?php
        component('forms.controls.button', ['text' => 'Créer ce jiri']) ?>
    </div>
    <?php
    $_SESSION['errors'] = [];
    $_SESSION['old'] = [];
    ?>
</form>