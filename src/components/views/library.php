<aside class="menu">  
  <ul class="nav nav-pills nav-fill">
    <li class="nav-item">
      <a class="nav-link active" href="#">Populaires</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Récents</a>
    </li>
  </ul>
  <table class="menu--list table">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Author</th>
        <th scope="col">
          <i class="fa fa-code-fork" aria-hidden="true"></i>
        </th>
        <th scope="col">
          <i class="fa fa-star" aria-hidden="true"></i>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Super kick</td>
        <td>Michel</td>
        <td>14</td>
        <td>132</td>
      </tr>
      <tr>
        <td>Wow snares</td>
        <td>Thornton</td>
        <td>89</td>
        <td>692</td>
      </tr>
      <tr>
        <td>Beautiful drop</td>
        <td>The Bird</td>
        <td>2</td>
        <td>27</td>
      </tr>
    </tbody>
  </table>
  <div class="menu--new">
    <h4 class="mb-3">Créer un Gitdrum</h4>
    <form method="post" action="/library">
      <div class="form-group mr-2">
        <input class="form-control <? if (sizeof($errors) > 0) { ?>is-invalid <? } ?>" type="text" name="create--name" id="create--name" placeholder="Nom du gitdrum">
        <? foreach ($errors as $error) { ?>
        <div class="invalid-feedback">
          <?= $error ?>
        </div>
      <? } ?>
      </div>
      <div class="form-group">
        <button class="btn btn-primary" type="submit" name="create--submit">Créer</button>
      </div>
    </form>
  </div>
</aside>