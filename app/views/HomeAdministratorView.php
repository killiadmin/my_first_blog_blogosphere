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
        <h2>List of registered users</h2>
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
                    <?php if ($user->activated() == 1) { ?>
                        <button class="btn btn-success" style="width: 105px;">Activate</button>
                        <?php
                    } else { ?>
                        <button class="btn btn-danger" style="width: 105px;">Desactivate</button>
                        <?php
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
