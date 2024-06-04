<form action="/">
    <label for="search"
           class="font-bold">Nom du jiri</label>
    <input type="text"
           id="search"
           name="search"
           class="border rounded-md px-2">
    <?php
    component('forms.controls.button', ['text' => 'Chercher']) ?>
</form>