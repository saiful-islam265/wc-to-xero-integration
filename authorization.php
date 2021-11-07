<?php
ini_set('display_errors', 'On');
require __DIR__ . '/vendor/autoload.php';
require_once('storage.php');

$storage = new StorageClass();

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
  'clientId'                => 'FCE3F105E0224C46BCB02B6BCD02DC94',
  'clientSecret'            => 'rVbpGwv883f01qb10J1bM9j3yhA43IVLSDjv0MzVWTg6I9fl',
  'redirectUri'             =>  'http://localhost/hoodsly/wp-admin/admin.php?page=woocommerce_wppool_oauth_callback',
  'urlAuthorize'            => 'https://login.xero.com/identity/connect/authorize',
  'urlAccessToken'          => 'https://identity.xero.com/connect/token',
  'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Organisation'
]);

// Scope defines the data your app has permission to access.
// Learn more about scopes at https://developer.xero.com/documentation/oauth2/scopes
$options = [
    'scope' => ['openid email profile offline_access assets projects accounting.settings accounting.transactions accounting.contacts accounting.journals.read accounting.reports.read accounting.attachments']
];

// This returns the authorizeUrl with necessary parameters applied (e.g. state).
$authorizationUrl = $provider->getAuthorizationUrl($options);

// Save the state generated for you and store it to the session.
// For security, on callback we compare the saved state with the one returned to ensure they match.
$_SESSION['oauth2state'] = $provider->getState();

// Redirect the user to the authorization URL.
header('Location: ' . $authorizationUrl);
exit();
?>