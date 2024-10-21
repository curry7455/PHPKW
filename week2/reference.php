
//Init variables
$teamName = '';
$wins = '';
$losses = '';
$otLosses = '';

//Assign values to variables on POST back
if (isset($_POST["nhl_standings_submit"])){
    $teamName = filter_input(INPUT_POST, 'team_name');
    $wins = filter_input(INPUT_POST, 'wins', FILTER_VALIDATE_FLOAT);
    $losses = filter_input(INPUT_POST, 'losses', FILTER_VALIDATE_FLOAT);
    $otLosses = filter_input(INPUT_POST, 'ot_losses', FILTER_VALIDATE_FLOAT);
}

//NHL Points Calculation
function calculateStandings($wins, $otLosses){

    $points = ($wins*2)+$otLosses;

    return $points;
}

?>

<h1>Fun with Forms!</h1>
<p class="intro-text">This example with demonstrate the use of a basic form to process information using the POST method.</p>

<hr />

<p>In this example, I will be using Hockey standings to calculate a teams total points based on Wins/Losses</p>

<!-- NHL Points Criteria for calculatings NHL Standings -->
<h2>Criteria</h2>
<ul>
    <li>Win = 2 points</li>
    <li>Loss = 0 points</li>
    <li>Overtime Loss = 1 point</li>
</ul>

<!-- NHL Standings Form -->
<div class="form-wrapper">
    <form name="nhl_standings" method="post">
       
        <div class="form-control">
            <label for="team_name">Team Name:</label><br />
            <input type="text" id="team_name" name="team_name" value="<?= $teamName; ?>">
        </div>

        <div class="form-control">
            <label for="wins">Wins:</label><br />
            <input type="text" name="wins" value="<?= $wins; ?>">
        </div>

        <div class="form-control">
            <label for="losses">Losses:</label><br />
            <input type="text" name="losses" value="<?= $losses; ?>">
        </div>

        <div class="form-control">
            <label for="ot_losses">Overtime Losses:</label><br />
            <input type="text" name="ot_losses" value="<?= $otLosses; ?>">
        </div>
       
        <div class="form-submit">
            <input type="submit" name="nhl_standings_submit" value="Submit">
        </div>
    </form>
</div>

<!-- NHL Standings Results -->
<!-- Only display on POST back -->
<?php if (isset($_POST["nhl_standings_submit"])): ?>
    <hr />
    <h2>Results</h2>
    <p><span class="result-label">Team Name:</span> <?= $teamName; ?></p>
    <p><span class="result-label">Wins:</span> <?= $wins; ?></p>
    <p><span class="result-label">Losses:</span> <?= $losses; ?></p>
    <p><span class="result-label">Overtime Losses:</span> <?= $otLosses; ?></p>
    <p class="grand-total"><span class="result-label">Total Points:</span> <?= calculateStandings($wins, $otLosses); ?></p>
<?php endif; ?>

<?php include __DIR__ . '/../includes/footer.php'; ?>