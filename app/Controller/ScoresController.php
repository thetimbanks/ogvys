<?
App::import('Vendor', 'OAuth/OAuthClient');

class ScoresController extends AppController {
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
        	//truncate the scores data
        	$this->Score->query('TRUNCATE TABLE scores;');
        	
        	for ($i = 1; $i < 13; $i++) {
	        	$response = $client->get($accessToken->key, $accessToken->secret, 'http://fantasysports.yahooapis.com/fantasy/v2/league/273.l.381794/scoreboard?week=' . $i, array());
	        	
	        	$xml = Xml::toArray(Xml::build($response["body"]));
	        	$matchups = $xml["fantasy_content"]["league"]["scoreboard"]["matchups"]["matchup"];
	        		
	        	foreach($matchups as $matchup) {
	        		foreach ($matchup["teams"]["team"] as $team) {
		        		$newScore = array(
			            	"Score" => array (
			            		"team_id" => $team["team_id"],
			            		"week" => $matchup["week"],
			            		"score" => $team["team_points"]["total"],
			            		"projected_score" => $team["team_projected_points"]["total"]
			            	)
			            );
			            $this->Score->create();
			            $this->Score->save($newScore);
	        		}
	        	}
        	}
        }
        
        /*$specificallyThisOne = $this->Article->find('first', array(
	        'conditions' => array('Article.id' => 1)
	    ));*/
    }

    private function createClient() {
        return new OAuthClient('dj0yJmk9SjRUdjJBbFFKTndNJmQ9WVdrOWJYSmhUVTFoTjJVbWNHbzlPRGt3TkRRNU9EWXkmcz1jb25zdW1lcnNlY3JldCZ4PTBl', '83b121e576bb12aaed3bca4fff51614fa4c4a2d7');
    }
}