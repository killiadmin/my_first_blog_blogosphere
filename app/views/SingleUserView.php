<?php
echo '<pre>';
var_dump($user);
echo '</pre>';
exit();
?>

<article class="d-flex flex-column align-items-center m-3">
    <header>
        <h2 class="text-center"> Mon Post</h2>
        <p class="metadata">Publié le blabla par truc muche</p>
    </header>

    <p class="m-3 p-3" style="max-width: 800px;"></p>

    <footer class="d-flex justify-content-evenly" style="width: 100%;">
        <p>Author's social network : <a href="#" class="badge bg-secondary">Github</a>, <a href="#"
                                                                                           class="badge bg-secondary">Twitter</a>,
            <a href="#" class="badge bg-secondary">Linkedin</a></p>
        <a href="#" style="color: #3C4245;"><i
                    class="fa-regular fa-pen-to-square xl"></i></a>
    </footer>
</article>
<hr>
<section id="comments">
    <div class="d-flex flex-column align-items-center">
        <h3>Comments</h3>
        <div class="comment" style="width: 500px;">
            <div class="comment-info d-flex gap-2">
                <p class="comment-author"><strong>Author : </strong> name </p>
                <p class="comment-date"><strong>Publié le : </strong>username</p>
            </div>
            <div class="comment-content d-flex flex-row-reverse">
                <p>mon contenu </p>
            </div>
            <hr>
        </div>
    </div>
</section>
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