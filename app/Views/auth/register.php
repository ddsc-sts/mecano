<main class="auth-card">
<p class="eyebrow">COMECE A USAR O MECANO</p>
<h1>Cadastre sua oficina</h1>
<p class="muted">Crie sua conta de administrador para organizar a oficina.</p>
<?php if (!empty($erro)): ?><p class="form-error" role="alert"><?= e($erro) ?></p><?php endif; ?>
<form method="post" action="/cadastro">
  <?= csrf_field() ?>
  <label>Nome da oficina<input name="empresa" value="<?= e($dados['empresa'] ?? '') ?>" required minlength="2" maxlength="150" autocomplete="organization"></label>
  <label>Seu nome<input name="nome" value="<?= e($dados['nome'] ?? '') ?>" required minlength="2" maxlength="150" autocomplete="name"></label>
  <label>E-mail<input type="email" name="email" value="<?= e($dados['email'] ?? '') ?>" required maxlength="150" autocomplete="email"></label>
  <label>Telefone <span class="optional">(opcional)</span><input type="tel" name="telefone" value="<?= e($dados['telefone'] ?? '') ?>" maxlength="30" autocomplete="tel"></label>
  <label>Senha<input type="password" name="senha" required minlength="12" maxlength="200" autocomplete="new-password"><small>Use pelo menos 12 caracteres.</small></label>
  <label>Confirme sua senha<input type="password" name="confirmar_senha" required minlength="12" maxlength="200" autocomplete="new-password"></label>
  <button type="submit">Criar conta</button>
</form>
<p class="auth-footer">Já tem uma conta? <a href="/login">Entrar</a></p>
</main>
