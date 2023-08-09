<?php
/*
foreach ($users ?? [] as $user):
    */?><!--
<h1>
    <?php /*= $user->name() */?> - <?php /*= $user->username() */?> - <?php /*= $user->quote() */?>
</h1>
<?php
/*    endforeach
    */?>

-->
<?php
$title = 'My home';
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 p-3 mt-3 d-flex flex-column align-items-center justify-content-center">
            <img src="./assets/photo_default.jpeg" alt="Photo de profil" class="img-fluid rounded-circle" style="width: 290px;">
            <form action="" method="post" enctype="multipart/form-data" class="p-3">
                <input type="file" name="file" id="file" class="d-none">
                <input type="submit" value="Change my image">
            </form>
        </div>
        <div class="col-md-6 mt-3 d-flex flex-column justify-content-center">
            <h2>Name Username</h2>
            <p>"Iam an author and i like read"</p>

            <hr>

            <h4>My CV : </h4>
            <form action="" method="post" enctype="multipart/form-data" class="p-3">
                <input type="file" name="file" id="file" class="d-none">
                <input type="submit" value="Change my CV">
            </form>

            <div class="p-3">
                <a href="" class="btn btn-secondary">See the CV</a>&nbsp;<i class="fa-regular fa-pen-to-square fa-xl"></i></li>
            </div>
            <hr>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
            <!-- Lien réseaux sociaux -->
            <h4>My Socials Networks</h4>
            <ul class="list-unstyled fs-3" style="color: #3C4245;">
                <li><a id="github" href="#" style="color: #3C4245;"><i class="fab fa-github"></i> Github&nbsp;</a><i class="fa-regular fa-pen-to-square fa-sm"></i></li>
                <li><a id="twitter" href="#" style="color: #3C4245;"><i class="fab fa-twitter"></i> Twitter&nbsp;</a><i class="fa-regular fa-pen-to-square fa-sm"></i></li>
                <li><a id="linkedin" href="#" style="color: #3C4245;"><i class="fab fa-linkedin"></i> Linkedin&nbsp;</a><i class="fa-regular fa-pen-to-square fa-sm"></i></li>
            </ul>
        </div>
        <div class="col-md-6">
            <!-- Formulaire de contact -->
            <h4>Send message</h4>
            <form>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Your name">
                </div>
                <div class="form-group">
                    <label for="prenom">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Your username">
                </div>
                <div class="form-group">
                    <label for="email">Mail recipient</label>
                    <input type="email" class="form-control" id="email" placeholder="Recipient's mail">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" rows="3" placeholder="Your message"></textarea>
                </div>
                <div class="d-flex flex-row-reverse p-2">
                    <button type="submit" class="btn btn-secondary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

