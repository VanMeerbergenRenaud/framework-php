<form action="/jiri"
      method="post"
      class="flex flex-col gap-6">
    <?php

    use Carbon\Carbon;

    csrf_token() ?>
    <div class="flex flex-col gap-2">
        <?php
        component('forms.controls.label-and-input', [
            'name' => 'name',
            'label' => 'Nom <small>au moins 3 caractères, au plus 255</small>',
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
            'label' => "Date et heure de début <small>au format {$date}</small>",
            'type' => 'text',
            'value' => '',
            'placeholder' => $date,

        ]);
        ?>
    </div>
    <fieldset>
        <legend>Les participants</legend>
        <div>
            <?php
            /** @var array $contacts */
            foreach ($contacts as $contact): ?>
                <div>
                    <input id="c-<?= $contact->id ?>"
                           type="checkbox"
                           name="contacts[]"
                           value="<?= $contact->id ?>"
                    >
                    <label for="c-<?= $contact->id ?>"><?= $contact->name ?></label>
                    <select name="role-<?= $contact->id ?>"
                            id="role-<?= $contact->id ?>">
                        <option value="student">Étudiant</option>
                        <option value="evaluator">Évaluateur</option>
                    </select>
                    <label for="role-<?= $contact->id ?>">Rôle</label>
                </div>
            <?php
            endforeach; ?>
        </div>
    </fieldset>
    <div>
        <?php
        component('forms.controls.button', ['text' => 'Créer ce jiri']) ?>
    </div>
    <?php
    $_SESSION['errors'] = [];
    $_SESSION['old'] = [];
    ?>
</form>