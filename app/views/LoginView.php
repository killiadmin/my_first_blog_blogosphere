<div class="bg-image d-flex justify-content-center p-3 text-center mb-5 mt-5">
    <h1>Connect to express yourself ...</h1>
</div>

<?php if (isset($_SESSION['id']) && $_SESSION['id']) {
    $_SESSION = [];
    session_destroy();
}
?>

<form class="container d-flex flex-column w-50 mb-5 mt-5">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Your mail</label>
        <input type="text" class="form-control" placeholder="my.adress@blogorama.fr" name="mail">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" placeholder="Mypass123..." name="password">
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