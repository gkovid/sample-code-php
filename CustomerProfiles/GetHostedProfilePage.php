<?php
  require 'vendor/autoload.php';
  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;
  define("AUTHORIZENET_LOG_FILE", "phplog");

    // Common Set Up for API Credentials
  $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
  $merchantAuthentication->setName( "556KThWQ6vf2"); 
  $merchantAuthentication->setTransactionKey("9ac2932kQ7kN2Wzq");

  $hostedProfileSettings1 = new AnetAPI\SettingType();
  $hostedProfileSettings1->setSettingName("hostedProfileReturnUrl");
  $hostedProfileSettings1->setSettingValue("https://returnurl.com/return/");

  $hostedProfileSettings2 = new AnetAPI\SettingType();
  $hostedProfileSettings2->setSettingName("hostedProfileReturnUrlText");
  $hostedProfileSettings2->setSettingValue("Continue to confirmation page.");

  $hostedProfileSettings3 = new AnetAPI\SettingType();
  $hostedProfileSettings3->setSettingName("hostedProfilePageBorderVisible");
  $hostedProfileSettings3->setSettingValue("true");

  $hostedProfileSettings = [$hostedProfileSettings1, $hostedProfileSettings2, $hostedProfileSettings3];

  $request = new AnetAPI\GetHostedProfilePageRequest();
  $request->setMerchantAuthentication($merchantAuthentication);
  $request->setCustomerProfileId("YourProfileID");
  $request->setHostedProfileSettings($hostedProfileSettings);

  $controller = new AnetController\GetHostedProfilePageController($request);

  $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
  
  if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
  {
      echo "SUCCESS: " . $response->getToken() . "\n";
   }
  else
  {
      echo "ERROR :  Invalid response\n";
      echo "Response : " . $response->getMessages()->getMessage()[0]->getCode() . "  " .$response->getMessages()->getMessage()[0]->getText() . "\n";   
  }
  ?>