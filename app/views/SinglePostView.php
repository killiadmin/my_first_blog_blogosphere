<?php
if ($post[0] ?? []) {
    $dateFormat = "d/m/Y H:i:s";
    $timeStamp = strtotime($post[0]->dateUpdate());

    if ($timeStamp !== false) {
        $formatDateFr = date($dateFormat, $timeStamp);
    }
    ?>
    <!--Bloc post begin-->
    <article class="d-flex flex-column align-items-center m-3">
        <header>
            <h2 class="text-center mb-5 mt-5"><?= htmlspecialchars($post[0]->title()) ?></h2>
            <p class=" text-center metadata">Publié le <?= htmlspecialchars($formatDateFr) ?>
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
        foreach ($comment ?? [] as $deployComment):
            $timeStampComment = strtotime($deployComment->dateUpdate());

            if ($timeStampComment !== false) {
                $formatDateFrComment = date($dateFormat, $timeStampComment);
            }
            ?>
            <div class="comment" style="width: 500px;">
                <div class="bg-light bg-gradient rounded p-3">
                    <div class="comment-info d-flex gap-2">
                        <p class="comment-author"><strong>Author: </strong><?= htmlspecialchars($deployComment->name()) ?> <?= htmlspecialchars($deployComment->username()) ?></p>
                        <p class="comment-date"><strong>Publié le: </strong><?= htmlspecialchars($formatDateFrComment) ?></p>
                    </div>
                    <div class="comment-content d-flex align-center ">
                        <p class="text-light mt-3 bg-success bg-gradient rounded p-3"><?= htmlspecialchars($deployComment->content()) ?></p>
                    </div>
                </div>
                <div class="m-3"></div>
            </div>
        <?php endforeach; ?>
    </div>
</section>


<form id="commentForm" class="p-3" action="singlepost&id=<?= $post[0]->idPost() ?>&status=comment" method="post" onsubmit="scrollToComments()">
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





