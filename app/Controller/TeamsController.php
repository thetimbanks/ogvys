<?
App::import('Vendor', 'OAuth/OAuthClient');

class TeamsController extends AppController {

    public function retrieve() {
        $client = $this->createClient();
        $requestToken = $client->getRequestToken('https://api.login.yahoo.com/oauth/v2/get_request_token', 'http://127.0.0.1/scores/callback');
        
        if ($requestToken) {
            $this->Session->write('yahoo_request_token', $requestToken);
            $this->redirect('https://api.login.yahoo.com/oauth/v2/request_auth?oauth_token=' . $requestToken->key);
        } else {
            // an error occured when obtaining a request token
        }
    }
    
    public function callback() {
    	// import XML class 
    	App::import('Utility', 'Xml');
    
        $requestToken = $this->Session->read('yahoo_request_token');
        $client = $this->createClient();
        $accessToken = $client->getAccessToken('https://api.login.yahoo.com/oauth/v2/get_token', $requestToken);

        if ($accessToken) {
            $teams = $client->get($accessToken->key, $accessToken->secret, 'http://fantasysports.yahooapis.com/fantasy/v2/league/273.l.381794/teams', array());
            
            $xml = Xml::toArray(Xml::build($teams["body"]));
            $teams = $xml["fantasy_content"]["league"]["teams"]["team"];
            
            foreach($teams as $team) {
	            $newTeam = array(
	            	"Team" => array (
	            		"name" => $team["name"],
	            		"owner" => "a",
	            		"yahoo_team_id" => $team["team_id"],
	            		"team_key" => $team["team_key"],
	            		"is_og" => 0,
	            		"is_ys" => 0,
	            		"wins" => 0,
	            		"losses" => 0,
	            		"score_total" => 0
	            	)
	            );
	            $this->Team->create();
	            $this->Team->save($newTeam);
            }
        }
    }
    
    public function updateScores() {
        $this->loadModel('Score');
        
        $allTeams = $this->Team->find('all');
        
        foreach($allTeams as $team) {
	        $team = $team["Team"];
	        
	        $this->Team->read(null, $team["id"]);
	        $this->Team->set("score_total", 0);
	        $this->Team->save();
	        
	        $allScores = $this->Score->find('all', array('conditions' => array('team_id' => $team["id"])));
	        
	        $totalScore = 0;
	        
	        foreach($allScores as $score) {
		        $totalScore += $score["Score"]["score"];
	        }
	        
	        $this->Team->set("score_total", $totalScore);
	        $this->Team->save();
        }
    }

    private function createClient() {
        return new OAuthClient('dj0yJmk9SjRUdjJBbFFKTndNJmQ9WVdrOWJYSmhUVTFoTjJVbWNHbzlPRGt3TkRRNU9EWXkmcz1jb25zdW1lcnNlY3JldCZ4PTBl', '83b121e576bb12aaed3bca4fff51614fa4c4a2d7');
    }
}