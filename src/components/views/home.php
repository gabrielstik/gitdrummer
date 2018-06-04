<div class="flex evenly">
  <form class="sign-in" action="/" method="post">
    <h2 class="sign-in--title">Se connecter</h2>
    <div class="form-group">
      <label for="mail">Adresse email</label>
      <input class="form-control" type="text" name="sign-in--mail" id="sign-in--mail" placeholder="gabriel.stik@gmail.com">
      <? foreach ($errors_sign_in['mail'] as $error) { ?>
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
        </div>
      <? } ?>
    </div>
    <div class="form-group">
      <label for="password">Mot de passe</label>
      <input class="form-control" type="password" name="sign-in--password" id="sign-in--password" placeholder="••••••">
      <small class="form-text text-muted">Mot de passe oublié ?</small>
      <? foreach ($errors_sign_in['password'] as $error) { ?>
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
        </div>
      <? } ?>
    </div>
    <button class="btn btn-primary" type="submit" name="sign-in--submit">Se connecter</button>
  </form>

  <form class="sign-up" action="/" method="post">
    <h2 class="sign-up--title">Créer un compte</h2>
    <div class="form-group">
      <label for="mail">Adresse email</label>
      <input class="form-control" type="text" name="mail" id="mail" placeholder="gabriel.stik@gmail.com">
    </div>
    <div class="form-group">
      <label for="password">Mot de passe</label>
      <input class="form-control" type="password" name="password" id="password" placeholder="••••••">
    </div>
    <div class="form-group">
      <label for="password">Confirmer le mot de passe</label>
      <input class="form-control" type="password" name="password" id="password" placeholder="••••••">
    </div>
    <button class="btn btn-primary" type="submit">Créer le compte</button>
  </form>
</div>