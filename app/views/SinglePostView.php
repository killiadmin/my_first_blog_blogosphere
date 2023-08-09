<?php
if ($post[0] ?? []) {
    ?>
    <!--Begin Construct the bloc article-->
    <article class="d-flex flex-column align-items-center m-3">
        <header>
            <h2 class="text-center"><?= $post[0]->title() ?></h2>
            <p class="metadata">Publié le <?= $post[0]->dateCreate() ?> par John Doe</p>
        </header>

        <p class="m-3 p-3" style="max-width: 800px;"><?= $post[0]->content() ?></p>

        <footer class="d-flex justify-content-evenly" style="width: 100%;">
            <p>Author's social network :
                <a href="#" class="badge bg-secondary">Github</a>,
                <a href="#" class="badge bg-secondary">Twitter</a>,
                <a href="#" class="badge bg-secondary">Linkedin</a>
            </p>
            <a href="" style="color: #3C4245;">
                <i class="fa-regular fa-pen-to-square xl"></i>
            </a>
        </footer>
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
<section id="comments">
    <div class="d-flex flex-column align-items-center">
        <h3>Comments</h3>
        <?php
        /*foreach ($commentsCreate ?? [] as $comment):
            foreach ($usersRegistered ?? [] as $user):
                if ($comment['idPostAssociated'] === $post['id'] && $comment['idUserAssociated'] === $user['id']) {*/
        ?>
        <div class="comment" style="width: 500px;">
            <div class="comment-info d-flex gap-2">
                <p class="comment-author"><strong>Author : </strong>KILLIAN</p>
                <p class="comment-date"><strong>Publié le : </strong>aaaa/mm/dd</p>
            </div>
            <div class="comment-content d-flex flex-row-reverse">
                <p>Mon contenu</p>
            </div>
            <hr>
        </div>
        <?php
        /*}*/
        ?>
        <?php /*endforeach;
                endforeach; */ ?>
    </div>
</section>
<?php
/*}
endforeach;*/
?>
<form class="p-3">
    <h4>Express yourself</h4>

    <div class="form-group">
        <label for="message">Your comment :</label>
        <textarea id="message" name="message" class="form-control"></textarea>
    </div>
    <div class="d-flex flex-row-reverse m-3">
        <button type="submit" class="btn btn-secondary">Send my comment</button>
    </div>
</form>


