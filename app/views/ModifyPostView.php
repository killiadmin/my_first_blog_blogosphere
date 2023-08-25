<?php
if ($post[0] ?? []) {
    ?>
    <div class="container mt-4">
        <h1>Update your post ...</h1>
        <form action="singlepost&id=<?= htmlspecialchars($post[0]->idPost()) ?>&status=update" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required
                       value="<?= htmlspecialchars($post[0]->username()) ?>">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required
                       value="<?= htmlspecialchars($post[0]->name()) ?>">
            </div>
            <div class="form-group">
                <label for="title">Title :</label>
                <input type="text" class="form-control" id="title" name="title" required
                       value="<?= htmlspecialchars($post[0]->title()) ?>">
            </div>

            <div class="form-group">
                <label for="chapo">Chapo :</label>
                <textarea class="form-control" id="chapo" name="chapo" rows="4" required><?= htmlspecialchars($post[0]->chapo()) ?></textarea>
            </div>

            <div class="form-group">
                <label for="content">Content :</label>
                <textarea class="form-control" id="content" name="content" rows="10" required><?= htmlspecialchars($post[0]->content()) ?></textarea>
            </div>
            <div class="d-flex flex-row-reverse m-3">
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
        </form>
    </div>

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
<!-- Bloc post end -->



