<?php
/*define('API_USER', 'a847669765140ba252eb1743c9b29396');
define('API_LOGIN', 'abf1c232ed1081bfb6def81e6a8850c1');

$mj = new \Mailjet\Client(API_USER,API_LOGIN,true,['version' => 'v3.1']);

if (isset($_POST['mailForm'])) {
    $name = htmlspecialchars($_POST['name']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => $email,
                        'Name' => "Me"
                    ],
                    'To' => [
                        [
                            'Email' => "support@chaletsetcaviar.killianfilatre.fr",
                            'Name' => "You"
                        ]
                    ],
                    'Subject' => "My first Mailjet Email!",
                    'TextPart' => "De $name $username, Contenu du mail : $message",
                ]
            ]
        ];

        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();

        $msg = "Votre message a bien été envoyé !";

    } else {
        $msg = "L'email n'est pas valide.";
    }
}
*/?>

<div class="container">
    <div class="row">
        <div class="col-md-6 p-3 mt-3 d-flex flex-column align-items-center justify-content-center">
            <img src="./assets/photo_profil.png" alt="Photo de profil" class="img-fluid rounded-circle" style="width: 290px;">
        </div>
        <div class="col-md-6 mt-3 d-flex flex-column justify-content-center">
            <h2><?= $user[0]->name() ?> <?= $user[0]->username() ?></h2>
            <p><?= $user[0]->quote() ?></p>

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
            <form method="POST" action="">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="Your name">
                </div>
                <div class="form-group">
                    <label for="prenom">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required placeholder="Your username">
                </div>
                <div class="form-group">
                    <label for="email">Mail recipient</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Your mail">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="3" required placeholder="Your message"></textarea>
                </div>
                <div class="d-flex flex-row-reverse p-2">
                    <input type="submit" class="btn btn-secondary" name="mailForm" value="Send" >
                </div>
            </form>
            <?php
            if(isset($msg)) {
                echo $msg;
            }
            ?>
        </div>
    </div>
</div>

