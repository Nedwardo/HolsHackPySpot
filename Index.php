<?php
require("vendor/autoload.php");
$session = new SpotifyWebAPI\Session(
    '5a4349a1c5394929bf7064dae0747d12',
    '3c1700f1c4884f6781152b5745246967',
    'http://localhost/HolsHackPySpot/Index.php'
);
$api = new SpotifyWebAPI\SpotifyWebAPI();
if (isset($_GET['code'])) {
    $session->requestAccessToken($_GET['code']);
    $api->setAccessToken($session->getAccessToken());
    print_r($api->me());
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
