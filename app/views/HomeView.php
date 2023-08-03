<?php

foreach ($users ?? [] as $user):
    ?>
<h1>
    <?= $user->name() ?> - <?= $user->username() ?> - <?= $user->quote() ?>
</h1>
<?php
    endforeach
    ?>