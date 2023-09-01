<?php
$postCounter = 0;
?>

<?php foreach ($posts ?? [] as $post):

    $dateFormat = "d/m/Y H:i:s";
    $timeStamp = strtotime($post->dateUpdate());

    if ($timeStamp !== false) {
        $formatDateFr = date($dateFormat, $timeStamp);
    }

    ?>
    <div class="card m-3 p-3" <?= $postCounter % 2 === 0 ? 'style="background-color: #dbdbdb"' : '' ?>>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h3 class="card-title"><?= htmlspecialchars($post->title()) ?></h3>
            </div>
            <div class="d-flex justify-content-between flex-column">
                <p class="card-text"><?= htmlspecialchars($post->chapo()) ?></p>
                <div class="d-flex flex-column">
                    <p>&nbsp;Modified the : <strong><?= htmlspecialchars($formatDateFr) ?></strong></p>
                    <p>Author : <strong><?= htmlspecialchars($post->name()) ?> <?= htmlspecialchars($post->username()) ?></strong>&nbsp;</p>
                </div>
            </div>
            <div class="d-flex flex-row-reverse">
                <a href="/singlepost&id=<?= htmlspecialchars($post->idPost()) ?>" class="btn btn-secondary">Go somewhere</a>
            </div>
        </div>
    </div>
    <?php
    $postCounter++;
endforeach; ?>