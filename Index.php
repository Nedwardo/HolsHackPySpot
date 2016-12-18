<?php
error_reporting(-1);
ini_set('display_errors', 1);
require 'vendor/autoload.php';
$session = new SpotifyWebAPI\Session(
    '5a4349a1c5394929bf7064dae0747d12',
    '3c1700f1c4884f6781152b5745246967',
    'http://localhost/HolsHackPySpot/Index.php'
);
$api = new SpotifyWebAPI\SpotifyWebAPI();
if (isset($_GET['code'])) {
    $session->requestAccessToken($_GET['code']);
    $api->setAccessToken($session->getAccessToken());
    #print_r($api->me());
    $tracks = $api->search('christmas', 'playlist', [
      'limit' => 1,
  ]);
  #$var = $tracks->playlist;
  #$var2 = $var->uri;
  $uri = ($tracks->playlists->items[0]->uri);
  #  print_r($tracks->owner->uri);
  echo('<iframe src="https://embed.spotify.com/?uri='.$uri.'&view=list" frameborder="0" width="400" height="580" allowtransparency="true"></iframe>');
} else {
    $scopes = [
        'scope' => [
            'user-read-email',
            'user-library-modify',
        ],
    ];
    header('Location: ' . $session->getAuthorizeUrl($scopes));
}
?>
