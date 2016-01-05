<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | https://github.com/hybridauth/hybridauth
*  (c) 2009-2012 HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

class Hybrid_Providers_Upperroom extends Hybrid_Provider_Model_OAuth2
{
  // default permissions
  // public $scope = "basic";

  /**
  * IDp wrappers initializer
  */
  function initialize()
  {
    parent::initialize();

    // Provider api end-points
    $this->api->api_base_url  = "https://upperroom-sso-server-staging.herokuapp.com/api/v1/";
    $this->api->authorize_url = "https://upperroom-sso-server-staging.herokuapp.com/oauth/authorize";
    $this->api->token_url     = "https://upperroom-sso-server-staging.herokuapp.com/oauth/token";
  }

  /**
  * load the user profile from the IDp api client
  */
  function getUserProfile(){
    $data = $this->api->api("me" );

    //if ( $data->meta->code != 200 ){
    //  throw new Exception( "User profile request failed! {$this->providerId} returned an invalid response.", 6 );
    //}

    $this->user->profile->identifier  = $data->id;
    $this->user->profile->email = $data->email;
    $this->user->profile->displayName = $data->first_name;
    $this->user->profile->firstName = $data->first_name;
    $this->user->profile->lastName = $data->last_name;

    return $this->user->profile;
  }
}