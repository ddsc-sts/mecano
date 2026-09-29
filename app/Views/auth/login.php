<main class="auth-card">
<p class="eyebrow">GESTÃO PARA OFICINAS</p>
<h1>Bem-vindo ao Mecano</h1>
<p class="muted">Entre na sua conta para continuar.</p>
<?php if (!empty($erro)): ?><p role="alert"><?= e($erro) ?></p><?php endif; ?>
<form method="post" action="/login">
  <?= csrf_field() ?>
  <label>E-mail<input type="email" name="email" required autocomplete="username"></label>
  <label>Senha<input type="password" name="senha" required autocomplete="current-password"></label>
  <button type="submit">Entrar</button>
</form>
<p class="auth-footer">Ainda não tem uma conta? <a href="/cadastro">Cadastre sua oficina</a></p>
</main>
