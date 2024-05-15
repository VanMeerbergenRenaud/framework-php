<form action="/logout"
      method="post">
    <?php
    method('delete');
    csrf_token();
    component('forms.controls.button-danger', ['text' => 'Me déconnecter']); ?>
</form>