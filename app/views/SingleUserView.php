<div class="container">
    <div class="row">
        <div class="col-md-6 p-3 mt-3 d-flex flex-column align-items-center justify-content-center">
            <img src="./assets/photo_profil.png" alt="Photo de profil" class="img-fluid rounded-circle" style="width: 290px;">
        </div>
        <div class="col-md-6 mt-3 d-flex flex-column justify-content-center">
            <h2><?= htmlspecialchars($user[0]->name()) ?> <?= htmlspecialchars($user[0]->username()) ?></h2>
            <p><?= htmlspecialchars($user[0]->quote()) ?></p>

            <hr>

            <h4>My CV : </h4>
            <div class="p-3">
                <a href="/assets/CV_Developpeur.pdf" class="btn btn-secondary">See my CV</a></li>
            </div>
            <hr>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
            <!-- Lien réseaux sociaux -->
            <h4>My Socials Networks</h4>
            <ul class="list-unstyled fs-3" style="color: #3C4245;">
                <li><a id="github" href="https://github.com/killiadmin" style="color: #3C4245;"><i class="fab fa-github"></i> Github&nbsp;</a></li>
                <li><a id="linkedin" href="https://www.linkedin.com/in/killian-fil%C3%A2tre-3104a9206/" style="color: #3C4245;"><i class="fab fa-linkedin"></i> Linkedin&nbsp;</a></li>
                <li><a id="github" href="https://killianfilatre.fr" style="color: #3C4245;"><i class="fa-solid fa-user"></i> Portfolio&nbsp;</a></li>

            </ul>
        </div>
        <div class="col-md-6">
            <!-- Formulaire de contact -->
            <h4>Contact Me</h4>
            <form method="POST" action="singleuser&id=1&status=sendemail">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="Your name">
                </div>
                <div class="form-group">
                    <label for="prenom">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required placeholder="Your username">
                </div>
                <div class="form-group">
                    <label for="mail">Mail recipient</label>
                    <input type="email" class="form-control" id="mail" name="mail" required placeholder="Your mail">
                </div>
                <div class="form-group">
                    <label for="subject">Object</label>
                    <input type="text" class="form-control" id="subject" name="subject" required placeholder="The subject of your mail">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="3" required placeholder="Your message"></textarea>
                </div>
                <div class="d-flex flex-row-reverse p-2">
                    <input type="submit" class="btn btn-secondary" name="mailForm" value="Send" >

                    <?php if (isset($msg)) {
                        ?>
                        <div class="container mt-1 mb-1 w-50">
                            <span class="form-control bg-success rounded text-light">
                                <?= $msg ?>
                            </span>
                        </div>
                        <?php
                        }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>

