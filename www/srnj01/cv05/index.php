<?php

require_once('./database.php');

include('./includes/header.php') ?>

<div class="m-4 mx-auto w-fit">
  <h2 class="text-xl bold max-w-fit mb-4">Test</h2>
  <?php
  $playersDB = new PlayersDB();
  $playersDB->create([]);
  $playersDB->read(1);
  $playersDB->update(1, []);
  $playersDB->delete(1);

  $teamsDB = new TeamsDB();
  $teamsDB->create([]);
  $teamsDB->read(1);
  $teamsDB->update(1, []);
  $teamsDB->delete(1);

  $matchesDB = new MatchesDB();
  $matchesDB->create([]);
  $matchesDB->read(1);
  $matchesDB->update(1, []);
  $matchesDB->delete(1);
  ?>
</div>

<?php include('./includes/footer.php') ?>
<?php require('../hotreloader.php') ?>
