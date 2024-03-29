<?php $view->component('header')?>
<h1>Add movie page</h1>

<form action="/admin/movies/add" method="POST">
  <label class="form-labal" for="">
    <div class="form-text mb-1">Name</div>
    <input class="form-control" type="text" name="name">
  </label>

  <button class='btn btn-primary'>Add</button>
</form>
<?php $view->component('footer') ?>