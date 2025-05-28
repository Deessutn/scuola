<?php
// index.php – Versione con debug chiamata API e base URL dinamico

// Calcola dinamicamente il “base URL” per l’API
$scheme   = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host     = $_SERVER['HTTP_HOST'];              // es. 127.0.0.1:8000 oppure myapp.local
$apiBase  = "{$scheme}://{$host}/api";

// Funzione helper per GET JSON con debug
function apiGet(string $url): array {
    $opts  = ['http' => [
        'method'  => 'GET',
        'header'  => "Accept: application/json\r\n"
    ]];
    $ctx   = stream_context_create($opts);
    $json  = @file_get_contents($url, false, $ctx);
    // Debug: mostra l’URL chiamato e l’header di risposta
    echo "<!-- Chiamata API: {$url} -->\n";
    if (isset($http_response_header)) {
        echo "<!-- Risposta Header: " . htmlspecialchars(json_encode($http_response_header)) . " -->\n";
    }
    if ($json === false) {
        return []; // fallback a array vuoto
    }
    $data = json_decode($json, true);
    return is_array($data) ? $data : [];
}

// 1) Prendo tutti gli strumenti
$instruments = apiGet("{$apiBase}/instruments");

// 2) Se è stata selezionata una ID, prendo le band
$selectedId = $_GET['instrument_id'] ?? null;
$bands       = [];
if ($selectedId) {
    $bands = apiGet("{$apiBase}/bands/requests/{$selectedId}");
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Band Finder (API Debug)</title>
  <style>
    body { font-family: sans-serif; margin: 2rem; }
    label, select, button { font-size: 1rem; }
    select, button { padding: .4rem; margin-left: .5rem; }
    .debug { margin-top: 1rem; font-size: .85rem; color: #999; }
    .band-list { margin-top: 1.5rem; }
    .band-item { margin-bottom: .75rem; }
    .band-name { font-weight: bold; }
    .requests { margin-left: 1rem; color: #555; }
  </style>
</head>
<body>

  <h1>Trova band per strumento</h1>

  <form method="get" action="">
    <label for="instrument">Strumento:</label>
    <select name="instrument_id" id="instrument" onchange="this.form.submit()">
      <option value="">— Seleziona —</option>
      <?php if (empty($instruments)): ?>
        <option disabled>— Nessuno strumento caricato —</option>
      <?php else: ?>
        <?php foreach ($instruments as $inst): ?>
          <option
            value="<?= htmlspecialchars($inst['id']) ?>"
            <?= $selectedId == $inst['id'] ? 'selected' : '' ?>
          >
            <?= htmlspecialchars($inst['name']) ?>
          </option>
        <?php endforeach ?>
      <?php endif ?>
    </select>
    <noscript><button type="submit">Cerca</button></noscript>
  </form>

  <?php if ($selectedId): ?>
    <div class="band-list">
      <?php if (empty($bands)): ?>
        <p>Nessuna band con richieste per questo strumento.</p>
      <?php else: ?>
        <?php foreach ($bands as $band): ?>
          <div class="band-item">
            <div class="band-name"><?= htmlspecialchars($band['name']) ?></div>
            <?php if (!empty($band['requests'])): ?>
              <ul class="requests">
                <?php foreach ($band['requests'] as $req): ?>
                  <li>
                    Richiesta #<?= $req['id'] ?> —
                    <?= htmlspecialchars($req['description'] ?: 'Nessuna descrizione') ?>
                  </li>
                <?php endforeach ?>
              </ul>
            <?php endif ?>
          </div>
        <?php endforeach ?>
      <?php endif ?>
    </div>
  <?php endif ?>

  <div class="debug">
    <p><strong>API Base URL:</strong> <?= htmlspecialchars($apiBase) ?></p>
    <p>Se vedi “strumenti non caricati” assicura che `<code><?= htmlspecialchars($apiBase) ?>/instruments</code>` risponda con JSON valido dal tuo browser o da Postman.</p>
  </div>

</body>
</html>
