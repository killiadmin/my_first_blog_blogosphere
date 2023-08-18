<div class="container">
    <h1 class="my-4">Dashboard</h1>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Users registered</h5>
                    <p class="card-text">Total :</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Articles written</h5>
                    <p class="card-text">Total : </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Top article</h5>
                    <p class="card-text">Total : Premier article</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Users desactivate</h5>
                    <p class="card-text">Total : </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Comments create</h5>
                    <p class="card-text">Total : </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Top user</h5>
                    <p class="card-text">Total : killian filatre</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="col-md-12">
        <h2 class="mb-5 mt-5">List of registered users</h2>
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
                    <td><?= $user->name() ?></td>
                    <td><?= $user->username() ?></td>
                    <td><?= $user->mail() ?></td>
                    <td class="d-flex justify-content-between">
                        <?php if ($user->activated() == 1): ?>
                            <button class="btn btn-success" style="width: 105px;">Activate</button>
                        <?php else: ?>
                            <button class="btn btn-danger" style="width: 105px;">Deactivate</button>
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
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><input type="checkbox"></td>
                    <td><?= $post->chapo() ?></td>
                    <td><?= $post->title() ?></td>
                    <td><?= $post->dateUpdate() ?></td>
                    <td>
                        <a href="/modifypost&id=<?= $post->idPost() ?>">
                            <div class="form-group">
                                <input type="submit" name="modify" class="btn btn-warning" style=" width: 105px;" value="Modify">
                            </div>
                        </a>
                    </td>
                    <td>
                        <form action="post&status=delete&postToDelete=<?= $post->idPost() ?>" method="post">
                            <div class="form-group">
                                <label for="delete" id="delete"></label>
                                <input type="submit" name="delete" class="btn btn-danger" style=" width: 105px;" value="Delete">
                            </div>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

