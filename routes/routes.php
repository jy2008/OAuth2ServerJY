<?php
use League\OAuth2\Server\Middleware\AuthorizationServerMiddleware;
use League\OAuth2\Server\Middleware\ResourceServerMiddleware;


$app->get('/authorize/{client_id}/{response_type}/{scope}', 'UserFrosting\Sprinkle\OAuth2ServerJY\Controller\ApiAuthController:authorizePage')->add('authGuard');
$app->get('/oauth', 'UserFrosting\Sprinkle\OAuth2ServerJY\Controller\ApiAuthController:authorizePage')->add('authGuard');
$app->get('/finish_authorize', 'UserFrosting\Sprinkle\OAuth2ServerJY\Controller\ApiAuthController:finish_authorize')->add('authGuard');



//$app->get('/oauth2/change', 'UserFrosting\Sprinkle\OAuth2Server\Controller\ApiAuthController:oAuth2ChangeRequest');
$app->get('/apps', 'UserFrosting\Sprinkle\OAuth2ServerJY\Controller\ApiAuthController:renderClients')->add('authGuard');
$app->get('/modals/client/create', 'UserFrosting\Sprinkle\OAuth2ServerJY\Controller\ApiAuthController:getModalCreateClient')->add('authGuard');
//$app->get('/app/new/scope', 'UserFrosting\Sprinkle\OAuth2Server\Controller\ApiAuthController:newScope');

$app->post('/authorize_vertify', 'UserFrosting\Sprinkle\OAuth2ServerJY\Controller\ApiAuthController:validateAuthRequest')->add('authGuard');

$app->group('/api', function () {
    $this->get('/clients', 'UserFrosting\Sprinkle\OAuth2ServerJY\Controller\ApiAuthController:getClients');

    $this->post('/client/new', 'UserFrosting\Sprinkle\OAuth2ServerJY\Controller\ApiAuthController:addNewClient');
})->add('authGuard');
$app->post('/oauth2/access_token', 'UserFrosting\Sprinkle\OAuth2ServerJY\Controller\ApiAuthController:AccessToken');
// This is a test api endpoint to try it :)
// IMPORTANT! YOU NEED TO ADD ALL YOUR API ENDPOINTS TO THE CSRF.BLACKLIST IN YOUR config file
// OTHERWISE THE CSRF MIDDLEWARE WILL BLOCK THEM! You can find an example in the README
$app->post('/api/userinfo', 'UserFrosting\Sprinkle\OAuth2ServerJY\Controller\ApiAuthController:getUserInfo')->add(new ResourceServerMiddleware($this->ci->ResourceServer));
