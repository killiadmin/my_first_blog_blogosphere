

<?php if (isset($php_errormsg)) {
    ?>
    <div class=" container mt-1 mb-1 w-50">
        <span class="form-control bg-danger rounded text-light">
            <?= $php_errormsg ?>
        </span>
    </div>
    <?php
}  ?>


<div class="error-container d-flex flex-column align-items-center gap-3 m-5">
    <h1 class="display-4">Error 404 - Page not found </h1>
    <p class="lead">Sorry the page you are looking for could not be found.</p>
    <p>You can return to the <a href="/login" class="text-decoration-underline" style="color: #3C4245;">homepage</a>.</p>
</div>