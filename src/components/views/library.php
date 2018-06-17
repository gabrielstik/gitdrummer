<div class="flex between">  
  <aside class="menu">  
    <ul class="nav nav-pills nav-fill">
      <li class="nav-item">
        <a class="nav-link active" href="#">Populaires</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="#">Récents</a>
      </li> -->
    </ul>
    <table class="menu--list table">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Author</th>
        </tr>
      </thead>
      <tbody>
        <? if ($drums) foreach ($drums as $drum) { ?>
          <tr class="menu--drum" onclick="document.location = '/drummer?id=<?= $drum->id ?>'">
            <td><?= $drum->name ?></td>
            <td><?= $drum->author ?></td>
          </tr>
        <? } ?>
      </tbody>
    </table>
    <div class="menu--new">
      <form method="post" action="/library">
        <div class="form-group">
          <button class="btn btn-primary" type="submit" name="create--submit">Créer un gitdrum</button>
        </div>
      </form>
    </div>
  </aside>
  <div class="sign-out">
    <a href="/sign-out" title="Modifier">
      <button class="btn btn-primary">Se deconnecter</button>
    </a>
  </div>
</div>
<div class="flex between">
  <input type="hidden" name="drum_id" class="drum_id" id="drum_id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>">
</div>