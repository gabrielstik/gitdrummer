<input class="drum_json" type="hidden" value="<?= str_replace('"', '%quote%', $json) ?>">
<div class="inventory">
  <h2 class="inventory--title">Inventory</h2>
  <ul class="inventory--list">
    <li class="inventory--sound" data-sound="kick">
      <div class="inventory--sound-image">
        <img src="assets/images/kick.svg" alt="Kick">
      </div>
      <div class="inventory--sound-label">Kick</div>
    </li>
    <li class="inventory--sound" data-sound="snare">
      <div class="inventory--sound-image">
        <img src="assets/images/kick.svg" alt="Kick">
      </div>
      <div class="inventory--sound-label">Snare</div>
    </li>
    <li class="inventory--sound" data-sound="hihat">
      <div class="inventory--sound-image">
        <img src="assets/images/kick.svg" alt="Kick">
      </div>
      <div class="inventory--sound-label">Hi-hat</div>
    </li>
    <li class="inventory--sound" data-sound="clave">
      <div class="inventory--sound-image">
        <img src="assets/images/kick.svg" alt="Kick">
      </div>
      <div class="inventory--sound-label">Clave</div>
    </li>
    <li class="inventory--sound" data-sound="conga">
      <div class="inventory--sound-image">
        <img src="assets/images/kick.svg" alt="Kick">
      </div>
      <div class="inventory--sound-label">Conga</div>
    </li>
    <li class="inventory--sound" data-sound="cowbell">
      <div class="inventory--sound-image">
        <img src="assets/images/kick.svg" alt="Kick">
      </div>
      <div class="inventory--sound-label">Cowbell</div>
    </li>
    <li class="inventory--sound" data-sound="maracas">
      <div class="inventory--sound-image">
        <img src="assets/images/kick.svg" alt="Kick">
      </div>
      <div class="inventory--sound-label">Maracas</div>
    </li>
    <li class="inventory--sound" data-sound="stick">
      <div class="inventory--sound-image">
        <img src="assets/images/kick.svg" alt="Kick">
      </div>
      <div class="inventory--sound-label">Stick</div>
    </li>
  </ul>
</div>
<div class="settings">
  <button onclick="document.location = '/library'" type="button" class="settings--leave btn btn-primary">Quitter</button>
  <button type="button" class="settings--play-pause btn btn-primary">Play</button>
  <form class="form-inline" method="post" action="/drummer<?= isset($_GET['id']) ? '?id='.$_GET['id'] : '' ?>">
    <div class="form-group settings--save">
      <label style="margin: 0 10px" for="commit--name">Nom du commit</label>
      <input class="form-control <? if (sizeof($errors) > 0) { ?>is-invalid <? } ?>" type="text" name="commit--name" id="commit--name" placeholder="Funny drum" value="<? if (isset($_POST['commit--name'])) echo $_POST['commit--name'] ?>">
      <? foreach ($errors as $error) { ?>
        <div class="invalid-feedback">
          <?= $error ?>
        </div>
      <? } ?>
      <input type="hidden" name="commit--json" class="commit--json" id="commit--json" value="">
      <button style="margin: 0 10px" class="btn btn-primary" type="submit" name="commit--submit">Sauvegarder la version</button>
    </div>
  </form>
</div>
<canvas class="drummer"></canvas>