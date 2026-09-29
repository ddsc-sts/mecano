<h1>Mecano</h1>
<?php if (!empty($erro)): ?><p role="alert"><?= e($erro) ?></p><?php endif; ?>
<form method="post" action="/login">
  <?= csrf_field() ?>
  <label>E-mail <input type="email" name="email" required autocomplete="username"></label>
  <label>Senha <input type="password" name="senha" required autocomplete="current-password"></label>
  <button type="submit">Entrar</button>
</form>
