<div class="bg-image d-flex justify-content-center p-3 text-center mb-5 mt-5">
    <h1>Sign up to express yourself ...</h1>
</div>

<form class="container mb-5 mt-5" method="POST" action="singleuser&id=1&status=signup" style="width: 600px;">

    <div class="mb-3">
        <label class="form-label" for="name">Name :</label>
        <input class="form-control" type="text" name="name" id="name" required>
    </div>

    <div class="mb-3">
        <label class="form-label" for="username">Username :</label>
        <input class="form-control" type="text" name="username" id="username" required>
    </div>

    <div class="mb-3">
        <label class="form-label" for="mail">Mail :</label>
        <input class="form-control" type="email" name="mail" id="mail" required>
    </div>

    <div class="mb-3">
        <label  class="form-label" for="password">Password :</label>
        <input class="form-control" type="password" name="password" id="password" required>
    </div>

    <div class="d-flex justify-content-between mt-5 mb-5">
        <a href="/login">
            <i class="fa-solid fa-arrow-left fa-2xl" title="Return to login menu" style="color: #3C4245"></i>
        </a>
        <button class="btn btn-secondary" type="submit" name="validateSignUp">Sign Up</button>
    </div>
</form>