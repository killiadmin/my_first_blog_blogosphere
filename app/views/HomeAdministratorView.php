<?php
$usersDesactivated = 0;
$mailReader = 'Mail reader';

foreach ($users ?? [] as $user){
    if ($user->activated() == 0) {
    $usersDesactivated++;
    }
}
?>
<div class="container">
    <h1 class="my-4">Dashboard</h1>
</div>
    <div class="container d-flex gap-3 align-items-center">
        <div class="card w-50">
            <div class="card-body text-center">
                <h5 class="card-title">Users registered</h5>
                <p class="card-text">Total : <?= htmlspecialchars(count($users ?? '')) ?></p>
            </div>
        </div>
        <div class="card w-50">
            <div class="card-body text-center">
                <h5 class="card-title">&nbsp;Articles written&nbsp;</h5>
                <p class="card-text">Total : <?= htmlspecialchars(count($posts ?? '')) ?></p>
            </div>
        </div>
    </div>
    <div class="container d-flex gap-3 mt-3 align-items-center">
        <div class="card w-50">
            <div class="card-body text-center">
                <h5 class="card-title">Users desactivate</h5>
                <p class="card-text">Total : <?= htmlspecialchars($usersDesactivated) ?></p>
            </div>
        </div>
        <div class="card w-50">
            <div class="card-body text-center">
                <h5 class="card-title">Comments create</h5>
                <p class="card-text">Total : <?= htmlspecialchars(count($comments ?? '')) ?></p>
            </div>
        </div>
    </div>


<!-- Version Desktop -->

<div class="container">
    <div class="col-md-12">
        <h2 class="mb-5 mt-5">List of registered users</h2>

        <div class="d-none d-md-block">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Mail</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><?= htmlspecialchars($user->name()) ?></td>
                        <td><?= htmlspecialchars($user->username()) ?></td>
                        <td><?= htmlspecialchars($user->mail()) ?></td>
                        <td class="d-flex justify-content-between">
                            <?php if ($user->activated() == 1): ?>
                                <button class="btn btn-success common-button">Activate</button>
                            <?php else: ?>
                                <button class="btn btn-danger common-button">Deactivate</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <hr>

            <h2 class="mb-5 mt-5">List of my posts</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th class="w-25">Chapo</th>
                    <th class="w-25">Title</th>
                    <th>Date Update</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($posts as $post):
                    $dateFormat = "d/m/Y H:i:s";
                    $timeStamp = strtotime($post->dateUpdate());

                    if ($timeStamp !== false) {
                        $formatDateFr = date($dateFormat, $timeStamp);
                    }
                    ?>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><?= htmlspecialchars($post->chapo()) ?></td>
                        <td><?= htmlspecialchars($post->title()) ?></td>
                        <td><?= htmlspecialchars($formatDateFr) ?></td>
                        <td>
                            <a href="post&modify&id=<?= htmlspecialchars($post->idPost()) ?>">
                                <div class="form-group">
                                    <input type="submit" name="modify" class="btn btn-warning common-button"
                                           value="Modify">
                                </div>
                            </a>
                        </td>
                        <td>
                            <form action="post&status=delete&postToDelete=<?= htmlspecialchars($post->idPost()) ?>"
                                  method="post">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                <div class="form-group">
                                    <label for="delete" id="delete"></label>
                                    <input type="submit" name="delete" class="btn btn-danger common-button"
                                           value="Delete">
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <hr>

            <h2 class="mb-5 mt-5">List of unvalidated comments</h2>
            <table id="validateComments" class="table table-striped">
                <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th class="w-25">Reader's email</th>
                    <th class="w-25">Content</th>
                    <th>Date Create</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($comments as $comment):
                    if ($comment->validate() === 0) {
                        foreach ($users as $user) {
                            if ($user->idUser() === $comment->idUserAssociated()) {
                                $mailReader = $user->mail();
                            }
                        }

                    $dateFormat = "d/m/Y H:i:s";
                    $timeStamp = strtotime($comment->dateUpdate());

                    if ($timeStamp !== false) {
                        $formatDateFr = date($dateFormat, $timeStamp);
                    }
                    ?>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><?= htmlspecialchars($mailReader) ?></td>
                        <td><?= htmlspecialchars($comment->content()) ?></td>
                        <td><?= htmlspecialchars($formatDateFr) ?></td>
                        <td>
                            <a href="singlepost&validateComment&id=<?= htmlspecialchars($comment->idComment()) ?>">
                                <div class="form-group">
                                    <input type="submit" name="validate" class="btn btn-success common-button"
                                           value="Validate">
                                </div>
                            </a>
                        </td>
                        <td>
                            <a href="singlepost&id=<?= htmlspecialchars($comment->idPostAssociated()) ?>">
                                <div class="form-group">
                                    <input type="submit" name="See Article" class="btn btn-secondary common-button"
                                           value="See Article">
                                </div>
                            </a>
                        </td
                    </tr>
                <?php } endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!------------------------------------ Version Mobile -------------------------------------->

<div class="d-block d-md-none">
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Mail</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user->mail()) ?></td>
                    <td class="d-flex justify-content-between">
                        <?php if ($user->activated() == 1): ?>
                            <button class="btn btn-success common-button"><i class="fa-solid fa-check"></i></button>
                        <?php elseif ($user->activated() == 0): ?>
                            <button class="btn btn-danger common-button"><i class="fa-solid fa-x"></i></button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <hr>

    <div class="container">
        <h2 class="mb-5 mt-5">List of my posts</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="w-25">Title</th>
                <th>Date Update</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($posts as $post):
                $dateFormat = "d/m/Y H:i:s";
                $timeStamp = strtotime($post->dateUpdate());

                if ($timeStamp !== false) {
                    $formatDateFr = date($dateFormat, $timeStamp);
                }
                ?>
                <tr>
                    <td><?= htmlspecialchars($post->title()) ?></td>
                    <td class="align-middle"><?= htmlspecialchars($formatDateFr) ?></td>
                    <td class="align-middle">
                        <a href="post&modify&id=<?= htmlspecialchars($post->idPost()) ?>">
                            <div class="form-group">
                                <button class="btn btn-warning"><i class="fa-solid fa-pen"></i>
                                </button>
                            </div>
                        </a>
                    </td>
                    <td class="align-middle">
                        <form action="post&status=delete&postToDelete=<?= htmlspecialchars($post->idPost()) ?>"
                              method="post">
                            <input type="hidden" name="csrf_token"
                                   value="<?php echo $_SESSION['csrf_token']; ?>">
                            <div class="form-group d-table">
                                <label for="delete" id="delete"></label>
                                <button class="btn btn-danger"><i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <hr>

        <h2 class="mb-5 mt-5">List of unvalidated comments</h2>
        <table id="validateComments" class="table table-striped">
            <thead>
            <tr>
                <th class="w-25">Reader's email</th>
                <th class="w-25">Content</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($comments as $comment):
                if ($comment->validate() === 0) {
                    foreach ($users as $user) {
                        if ($user->idUser() === $comment->idUserAssociated()) {
                            $mailReader = $user->mail();
                        }
                    }

                    $dateFormat = "d/m/Y H:i:s";
                    $timeStamp = strtotime($comment->dateUpdate());

                    if ($timeStamp !== false) {
                        $formatDateFr = date($dateFormat, $timeStamp);
                    }
                    ?>
                    <tr>
                        <td><?= htmlspecialchars('mail reader') ?></td>
                        <td><?= htmlspecialchars($comment->content()) ?></td>
                        <td>
                            <a href="singlepost&validateComment&id=<?= htmlspecialchars($comment->idComment()) ?>">
                                <div class="form-group">
                                    <button class="btn btn-success"><i class="fa-solid fa-check"></i>
                                    </button>
                                </div>
                            </a>
                        </td>
                        <td>
                            <a href="singlepost&id=<?= htmlspecialchars($comment->idPostAssociated()) ?>">
                                <div class="form-group">
                                    <button class="btn btn-secondary"><i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </a>
                        </td
                    </tr>
                <?php } endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



