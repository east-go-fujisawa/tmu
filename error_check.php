<?php
$results = glob('./uploads/news/*.json');

foreach ($results as $path) {
    $raw = file_get_contents($path);
    $json = json_decode($raw, true);
    $item = $json[0];
    $count = count($item["article"]);
?>
    <div class="news-item">
        <h1><?= htmlspecialchars($item["title"]) ?></h1>
        <p><?= htmlspecialchars($item["date_train"]) ?></p>
        <p><?= htmlspecialchars($item["date_write"]) ?></p>
    </div>

    <?php for($i=0; $i<$count; $i++): ?>
        <?php 
            $value = $item["article"][$i];
            $isImage = preg_match('/\.(jpg|jpeg|png|gif)$/i', $value);
        ?>

        <?php if($isImage): ?>
            <img src="./uploads/photos/<?= htmlspecialchars($value) ?>">
        <?php else: ?>
            <p><?= htmlspecialchars($value) ?></p>
        <?php endif; ?>
    <?php endfor; ?>

<?php
} // ← foreach の閉じタグ
?>
