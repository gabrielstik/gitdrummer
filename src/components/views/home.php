<div class="flex evenly">
  <form class="sign-in" action="/" method="post">
    <h2 class="sign-in--title">Se connecter</h2>
    <div class="form-group">
      <label for="mail">Adresse email</label>
      <input class="form-control <? if (sizeof($errors_sign_in['mail']) > 0) { ?>is-invalid <? } ?>" type="text" name="sign-in--mail" id="sign-in--mail" placeholder="gabriel.stik@gmail.com" value="<? if (isset($_POST['sign-in--mail'])) echo $_POST['sign-in--mail'] ?>">
      <? foreach ($errors_sign_in['mail'] as $error) { ?>
        <div class="invalid-feedback">
          <?= $error ?>
        </div>
      <? } ?>
    </div>
    <div class="form-group">
      <label for="password">Mot de passe</label>
      <input class="form-control <? if (sizeof($errors_sign_in['password']) > 0) { ?>is-invalid <? } ?>" type="password" name="sign-in--password" id="sign-in--password" placeholder="••••••">
      <? foreach ($errors_sign_in['password'] as $error) { ?>
        <div class="invalid-feedback">
          <?= $error ?>
        </div>
      <? } ?>
      <small class="form-text text-muted">Mot de passe oublié ?</small>
    </div>
    <button class="btn btn-primary" type="submit" name="sign-in--submit">Se connecter</button>
  </form>

  <form class="sign-up" action="/" method="post">
    <h2 class="sign-up--title">Créer un compte</h2>
    <div class="form-group">
      <label for="mail">Adresse email</label>
      <input class="form-control <? if (sizeof($errors_sign_up['mail']) > 0) { ?>is-invalid <? } ?>" type="text" name="sign-up--mail" id="sign-up--mail" placeholder="gabriel.stik@gmail.com" value="<? if (isset($_POST['sign-up--mail'])) echo $_POST['sign-up--mail'] ?>">
      <? foreach ($errors_sign_up['mail'] as $error) { ?>
        <div class="invalid-feedback">
          <?= $error ?>
        </div>
      <? } ?>
    </div>
    <div class="form-group">
      <label for="password">Mot de passe</label>
      <input class="form-control <? if (sizeof($errors_sign_up['password']) > 0) { ?>is-invalid <? } ?>" type="password" name="sign-up--password" id="sign-up--password" placeholder="••••••">
      <? foreach ($errors_sign_up['password'] as $error) { ?>
        <div class="invalid-feedback">
          <?= $error ?>
        </div>
      <? } ?>
    </div>
    <div class="form-group">
      <label for="password">Confirmer le mot de passe</label>
      <input class="form-control <? if (sizeof($errors_sign_up['password-confirm']) > 0) { ?>is-invalid <? } ?>" type="password" name="sign-up--password-confirm" id="sign-up--password-confirm" placeholder="••••••">
      <? foreach ($errors_sign_up['password-confirm'] as $error) { ?>
        <div class="invalid-feedback">
          <?= $error ?>
        </div>
      <? } ?>
    </div>
    <button class="btn btn-primary" type="submit" name="sign-up--submit">Créer le compte</button>
  </form>
</div>

<div class="sign-out">
  <a href="/sign-out" title="Se déconnecter">
    <button class="btn btn-primary">Se déconnecter</button>
  </a>
</div>

<div class="background">
  <div class="background--circle"></div>
</div>