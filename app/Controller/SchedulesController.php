<?
App::import('Vendor', 'OAuth/OAuthClient');

class SchedulesController extends AppController {
    

    public function updateSchedule() {
	    $this->loadModel('Score');
	    $this->loadModel('Team');
	    
		    $allMatchups = $this->Schedule->find("all");
		    
		    foreach($allMatchups as $matchup) {
			    $ogScore = $this->Score->find("first", array("conditions" => array("week" => $matchup["Schedule"]["week"], "team_id" => $matchup["Schedule"]["og_id"])));
			    $ysScore = $this->Score->find("first", array("conditions" => array("week" => $matchup["Schedule"]["week"], "team_id" => $matchup["Schedule"]["ys_id"])));
			    
			    //Set default to ys
			    $winner_id = $ysScore["Score"]["team_id"];
			    $loser_id = $ogScore["Score"]["team_id"];
			    $winner_score = $ysScore["Score"]["score"];
			    $loser_score = $ogScore["Score"]["score"];
			    
			    if ($ogScore["Score"]["score"] > $ysScore["Score"]["score"]) {
				    $winner_id = $ogScore["Score"]["team_id"];
				    $loser_id = $ysScore["Score"]["team_id"];
				    $winner_score = $ogScore["Score"]["score"];
				    $loser_score = $ysScore["Score"]["score"];
			    }
			    
			    $this->Schedule->read(null, $matchup["Schedule"]["id"]);
			    $this->Schedule->set("winner", $winner_id);
			    $this->Schedule->set("loser", $loser_id);
			    $this->Schedule->set("winner_score", $winner_score);
			    $this->Schedule->set("loser_score", $loser_score);
			    $this->Schedule->save();
		    }
		    
		    $allTeams = $this->Team->find("all");
		    
		    foreach($allTeams as $team) {
		    	$wins = $this->Schedule->find("count", array("conditions" => array("winner" => $team["Team"]["id"])));
		    	$losses = $this->Schedule->find("count", array("conditions" => array("loser" => $team["Team"]["id"])));
		    	$this->Team->read(null, $team["Team"]["id"]);
		    	$this->Team->set("wins", $wins);
		    	$this->Team->set("losses", $losses);
		    	$this->Team->save();
		    }

    }
}