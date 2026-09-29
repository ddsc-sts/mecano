<main class="auth-card">
<p class="eyebrow">SUA CONTA</p>
<h1>Escolha uma oficina</h1>
<p class="muted">Sua conta tem acesso a mais de uma oficina.</p>
<?php if (!$empresas): ?><p role="alert">Sua conta não tem vínculo ativo com uma oficina. Peça ao administrador para adicionar seu acesso.</p><?php else: ?>
<div class="company-list">
<?php foreach ($empresas as $empresa): ?>
  <form method="post" action="/selecionar-empresa">
    <?= csrf_field() ?>
    <input type="hidden" name="empresa_id" value="<?= (int) $empresa['id'] ?>">
    <button class="company-choice" type="submit"><span><?= e($empresa['nome']) ?></span><small><?= e(ucfirst($empresa['papel'])) ?></small></button>
  </form>
<?php endforeach; ?>
</div>
<?php endif; ?>
<form method="post" action="/logout" class="logout-form"><?= csrf_field() ?><button class="text-button" type="submit">Sair</button></form>
</main>
