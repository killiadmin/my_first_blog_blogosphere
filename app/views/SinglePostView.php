<?php
if ($post[0] ?? []) {
    ?>
    <!--Bloc post begin-->
    <article class="d-flex flex-column align-items-center m-3">
        <header>
            <h2 class="text-center mb-5 mt-5"><?= htmlspecialchars($post[0]->title()) ?></h2>
            <p class=" text-center metadata">Publié le <?= htmlspecialchars($post[0]->dateUpdate()) ?>
                par <?= htmlspecialchars($post[0]->name()) ?> <?= htmlspecialchars($post[0]->userName()) ?> </p>
        </header>

        <p class="m-3 p-3 bg-light rounded" style="max-width: 800px;">
            <?= nl2br(htmlspecialchars($post[0]->chapo())) ?>
        </p>
        <hr>
        <p class="m-3 p-3 bg-light rounded" style="max-width: 800px;">
            <?= nl2br(htmlspecialchars($post[0]->content())) ?>
        </p>
    </article>
    <?php
} else {
    ?>
    <article class="d-flex flex-column align-items-center m-3">
        <header>
            Il y a eu une erreur !
        </header>

        <p class="m-3 p-3" style="max-width: 800px;">This post not exist</p>

        <footer class="d-flex justify-content-evenly" style="width: 100%;">
            <a href="/post">
                <input type="button" value="Go back">
            </a>
        </footer>
    </article>
    <?php
}
?>
<hr>

<!-- Bloc post end -->

<!-- Bloc comment begin -->

<section id="comments">
    <div class="d-flex flex-column align-items-center mb-5 mt-5">
        <h3 class="mb-5">Comments</h3>
        <?php
        foreach ($comment as $deployComment):
            ?>
            <div class="comment" style="width: 500px;">
                <div class="bg-light bg-gradient rounded p-3">
                    <div class="comment-info d-flex gap-2">
                        <p class="comment-author"><strong>Author
                                : </strong><?= $deployComment->name() ?> <?= $deployComment->username() ?></p>
                        <p class="comment-date"><strong>Publié le : </strong> <?= $deployComment->dateUpdate() ?></p>
                    </div>
                    <div class="comment-content d-flex align-center ">
                        <p class="text-light mt-3 bg-success bg-gradient rounded p-3"><?= $deployComment->content() ?></p>
                    </div>
                </div>
                <div class="m-3"></div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<form class="p-3" action="singlepost&id=<?= $post[0]->idPost() ?>&status=comment" method="post">
    <h4>Express yourself</h4>
    <div class="form-group">
        <label for="contentComment">Your comment :</label>
        <textarea id="contentComment" name="contentComment" class="form-control"></textarea>
    </div>
    <div class="d-flex flex-row-reverse m-3">
        <button type="submit" class="btn btn-secondary">Send my comment</button>
    </div>
</form>

<!-- Bloc comment end -->



