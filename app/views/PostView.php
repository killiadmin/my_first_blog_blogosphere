<?php foreach ($posts ?? [] as $post):
    ?>
    <div class="card m-3 p-3">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h3 class="card-title"><?= $post->title() ?></h3>
            </div>
            <div class="d-flex justify-content-between">
                <p class="card-text maxWidth w-50"><?= $post->chapo() ?></p>
                <div class="d-flex flex-column">
                    <p>&nbsp;<strong>Modified the : <?= $post->dateUpdate() ?></strong></p>
                    <p><strong>Author : <?= $post->name() ?> <?= $post->username() ?></strong>&nbsp;</p>
                </div>
            </div>
            <div class="d-flex flex-row-reverse">
                <a href="/singlepost&id=<?= $post->idPost()?>" class="btn btn-secondary">Go somewhere</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>