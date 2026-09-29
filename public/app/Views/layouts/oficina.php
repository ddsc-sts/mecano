<!doctype html>
<html lang="pt-BR"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mecano - Oficina</title><link rel="stylesheet" href="/css/app.css">
</head><body>
<header><strong>Mecano</strong>
<form method="post" action="/logout"><?= csrf_field() ?><button>Sair</button></form></header>
<main><?= $content ?></main>
</body></html>
