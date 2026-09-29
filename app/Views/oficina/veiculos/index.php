<h1>Veículos</h1>
<ul><?php foreach ($veiculos as $v): ?>
<li><?= e($v['placa']) ?> - <?= e($v['marca']) ?> <?= e($v['modelo']) ?></li>
<?php endforeach; ?></ul>
