<?php $_title = 'Login'; ?>

<div class="bg-image d-flex justify-content-center p-3 text-center mb-5 mt-5">
    <h1>Connect to express yourself ...</h1>
</div>

<?php if (isset($msg)) {
    ?>
    <div class=" container mt-1 mb-1 w-50">
        <span class="form-control bg-danger rounded text-light">
            <?= $msg ?>
        </span>
    </div>
    <?php
}  ?>

<form method="post" action="singleuser&id=1&status=login" class="container d-flex flex-column w-50 mb-5 mt-5">
    <div class="mb-3">
        <label for="mail" class="form-label">Your mail</label>
        <input id="mail" type="email" class="form-control" placeholder="my.adress@blogorama.fr" name="mail" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id ="password" type="password" class="form-control" placeholder="Mypass123..." name="password" required>
    </div>
    <div class="d-flex" >
        <p>You do not have an account ? </p>
        <a href="signup" class="text-decoration-none text-secondary">&nbsp;Sign Up</a>
    </div>
    <div class="d-flex flex-row-reverse">
        <button type="submit" class="btn btn-secondary p-2" name="validate">Sign In</button>
    </div>
    <br><br>
</form>