<?

$ogWinsLosses = array(0,0);
foreach($ogTeams as $ogTeam) {
	$ogWinsLosses[0] += $ogTeam["Team"]["wins"];
	$ogWinsLosses[1] += $ogTeam["Team"]["losses"];
}

$ysWinsLosses = array(0,0);
foreach($ysTeams as $ysTeam) {
	$ysWinsLosses[0] += $ysTeam["Team"]["wins"];
	$ysWinsLosses[1] += $ysTeam["Team"]["losses"];
}

?>

<?

$ogWinsLosses = array(0,0);
foreach($ogTeams as $ogTeam) {
	$ogWinsLosses[0] += $ogTeam["Team"]["wins"];
	$ogWinsLosses[1] += $ogTeam["Team"]["losses"];
}

$ysWinsLosses = array(0,0);
foreach($ysTeams as $ysTeam) {
	$ysWinsLosses[0] += $ysTeam["Team"]["wins"];
	$ysWinsLosses[1] += $ysTeam["Team"]["losses"];
}

?>

<div class="row rankings">
	<span class="span6">
		<h3>Old Guys</h3>
		<div class="wins">X <span>wins</span></div>
		<? buildTables($ogTeams) ?>
	</span>
	<span class="span6">
		<h3>Young Studs</h3>
		<div class="wins">X <span>wins</span></div>
		<? buildTables($ysTeams) ?>
	</span>
</div>

<div class="row">
	<div class="span12">
		<h3>Overall</h3>
		<? buildTables($allTeams) ?>
	</div>
</div>


<? function buildTables($teams) { 
	$prevWins = 0;
	$place = 0;
	$ties = 0;
?>
	<table class="table table-bordered table-striped table-hover">
		<thead>
		  <tr>
		    <th>#</th>
		    <th>Team Name</th>
		    <th>W-L</th>
		    <th>Points</th>
		  </tr>
		</thead>
		<tbody>
		  <? foreach($teams as $team) { 
			 	if ($team["Team"]["wins"] != $prevWins) {
				 	$place = $place + 1 + $ties;
				 	$prevWins = $team["Team"]["wins"];
				 	$ties = 0;
			 	} else {
				 	$ties++;
			 	}
		  ?>
				<tr>
			    	<td><?= $place ?></td>
			    	<td><?= $team["Team"]["name"] ?></td>
			    	<td><?= "X-X" ?></td>
			    	<td><?= $team["Team"]["score_total"] ?></td>
			    </tr>
			<? } ?>
		</tbody>
	</table>
<? } ?>

<!--
<div class="row rankings">
	<span class="span6">
		<h3>Old Guys</h3>
		<div class="wins"><?= $ogWinsLosses[0] ?> <span>wins</span></div>
		<? buildTable($ogTeams) ?>
	</span>
	<span class="span6">
		<h3>Young Studs</h3>
		<div class="wins"><?= $ysWinsLosses[0] ?> <span>wins</span></div>
		<? buildTable($ysTeams) ?>
	</span>
</div>

<div class="row">
	<div class="span12">
		<h3>Overall</h3>
		<? buildTable($allTeams) ?>
	</div>
</div>


<? function buildTable($teams) { 
	$prevWins = 0;
	$place = 0;
	$ties = 0;
?>
	<table class="table table-bordered table-striped table-hover">
		<thead>
		  <tr>
		    <th>#</th>
		    <th>Team Name</th>
		    <th>W-L</th>
		    <th>Points</th>
		  </tr>
		</thead>
		<tbody>
		  <? foreach($teams as $team) { 
			 	if ($team["Team"]["wins"] != $prevWins) {
				 	$place = $place + 1 + $ties;
				 	$prevWins = $team["Team"]["wins"];
				 	$ties = 0;
			 	} else {
				 	$ties++;
			 	}
		  ?>
				<tr>
			    	<td><?= $place ?></td>
			    	<td><?= $team["Team"]["name"] ?></td>
			    	<td><?= $team["Team"]["wins"] . "-" . $team["Team"]["losses"] ?></td>
			    	<td><?= $team["Team"]["score_total"] ?></td>
			    </tr>
			<? } ?>
		</tbody>
	</table>
<? } ?>
-->