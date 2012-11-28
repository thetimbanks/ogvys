<?
// Controller/ExampleController.php
App::import('Vendor', 'OAuth/OAuthClient');

class ExampleController extends AppController {
    public function index() {
        $client = $this->createClient();
        $requestToken = $client->getRequestToken('https://api.login.yahoo.com/oauth/v2/get_request_token', 'http://127.0.0.1/example/callback');
        //$requestToken = $client->getRequestToken('https://api.twitter.com/oauth/request_token', 'http://' . $_SERVER['HTTP_HOST'] . '/example/callback');
        if ($requestToken) {
            $this->Session->write('yahoo_request_token', $requestToken);
            $this->redirect('https://api.login.yahoo.com/oauth/v2/request_auth?oauth_token=' . $requestToken->key);
        } else {
            // an error occured when obtaining a request token
        }
    }

    public function callback() {
        $requestToken = $this->Session->read('yahoo_request_token');
        $client = $this->createClient();
        $accessToken = $client->getAccessToken('https://api.login.yahoo.com/oauth/v2/get_token', $requestToken);

        if ($accessToken) {
            echo($client->get($accessToken->key, $accessToken->secret, 'http://fantasysports.yahooapis.com/fantasy/v2/team/273.l.381794.t.1/matchups', array()));
        }
    }

    private function createClient() {
        return new OAuthClient('dj0yJmk9SjRUdjJBbFFKTndNJmQ9WVdrOWJYSmhUVTFoTjJVbWNHbzlPRGt3TkRRNU9EWXkmcz1jb25zdW1lcnNlY3JldCZ4PTBl', '83b121e576bb12aaed3bca4fff51614fa4c4a2d7');
    }
}