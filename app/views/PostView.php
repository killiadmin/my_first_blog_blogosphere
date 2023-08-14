<?php foreach ($posts ?? [] as $post):
    ?>
    <div class="card m-3 p-3">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h3 class="card-title"><?= $post->title() ?></h3>
                <a href="#">
                    <i class="fa-solid fa-trash fa-lg" style="color: #3C4245"></i>
                </a>
            </div>
            <div class="d-flex justify-content-between">
                <p class="card-text maxWidth"><?= $post->chapo() ?></p>
                <div class="d-flex flex-column">
                    <p>&nbsp;<strong>Posted the : <?= $post->dateCreate() ?></strong></p>
                    <p><strong>Author :</strong>&nbsp;</p>
                </div>
            </div>
            <div class="d-flex flex-row-reverse">
                <a href="/singlepost&id=<?= $post->id()?>" class="btn btn-secondary">Go somewhere</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>