<?php
  ini_set('display_errors', 'On');
  require __DIR__ . '/vendor/autoload.php';
  require_once('storage.php');

  // Use this class to deserialize error caught
  use XeroAPI\XeroPHP\AccountingObjectSerializer;

  // Storage Classe uses sessions for storing token > extend to your DB of choice
  $storage = new StorageClass();
  $xeroTenantId = (string)$storage->getSession()['tenant_id'];

  if ($storage->getHasExpired()) {
    $provider = new \League\OAuth2\Client\Provider\GenericProvider([
      'clientId'                => 'FCE3F105E0224C46BCB02B6BCD02DC94',
      'clientSecret'            => 'rVbpGwv883f01qb10J1bM9j3yhA43IVLSDjv0MzVWTg6I9fl-pCVkn',
      'redirectUri'             =>  'http://localhost/hoodsly/wp-admin/admin.php?page=woocommerce_wppool_oauth_callback',
      'urlAuthorize'            => 'https://login.xero.com/identity/connect/authorize',
      'urlAccessToken'          => 'https://identity.xero.com/connect/token',
      'urlResourceOwnerDetails' => 'https://identity.xero.com/resources'
    ]);

    $newAccessToken = $provider->getAccessToken('refresh_token', [
      'refresh_token' => $storage->getRefreshToken()
    ]);

    // Save my token, expiration and refresh token
    $storage->setToken(
        $newAccessToken->getToken(),
        $newAccessToken->getExpires(),
        $xeroTenantId,
        $newAccessToken->getRefreshToken(),
        $newAccessToken->getValues()["id_token"] );
  }

  $config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken( (string)$storage->getSession()['token'] );	
  //print_r($xeroTenantId);
  $accountingApi = new XeroAPI\XeroPHP\Api\AccountingApi(
    new GuzzleHttp\Client(),
    $config
  );

  $assetApi = new XeroAPI\XeroPHP\Api\AssetApi(
    new GuzzleHttp\Client(),
    $config
  );  

  $identityApi = new XeroAPI\XeroPHP\Api\IdentityApi(
    new GuzzleHttp\Client(),
    $config
  );  

  $projectApi = new XeroAPI\XeroPHP\Api\ProjectApi(
    new GuzzleHttp\Client(),
    $config
  );  

  $message = "no API calls";
  if (isset($_GET['action'])) {
    if ($_GET["action"] == 1) {
      // Get Organisation details
      $apiResponse = $accountingApi->getOrganisations($xeroTenantId);
      $message = 'Organisation Name: ' . $apiResponse->getOrganisations()[0]->getName();
    } else if ($_GET["action"] == 2) {
      // Create Contact
      try {
        $person = new XeroAPI\XeroPHP\Models\Accounting\ContactPerson;
        $person->setFirstName("John")
                ->setLastName("Smith")
                ->setEmailAddress("john.smith@24locks.com")
                ->setIncludeInEmails(true);

        $arr_persons = [];
        array_push($arr_persons, $person);

        $contact = new XeroAPI\XeroPHP\Models\Accounting\Contact;
        $contact->setName('FooBar')
                ->setFirstName("Foo")
                ->setLastName("Bar")
                ->setEmailAddress("ben.bowden@24locks.com")
                ->setContactPersons($arr_persons);
        
        $arr_contacts = [];
        array_push($arr_contacts, $contact);
        $contacts = new XeroAPI\XeroPHP\Models\Accounting\Contacts;
        $contacts->setContacts($arr_contacts);

        $apiResponse = $accountingApi->createContacts($xeroTenantId,$contacts);
        $message = 'New Contact Name: ' . $apiResponse->getContacts()[0]->getName();
      } catch (\XeroAPI\XeroPHP\ApiException $e) {
        $error = AccountingObjectSerializer::deserialize(
          $e->getResponseBody(),
          '\XeroAPI\XeroPHP\Models\Accounting\Error',
          []
        );
        $message = "ApiException - " . $error->getElements()[0]["validation_errors"][0]["message"];
      }
    } else if ($_GET["action"] == 3) {
      $if_modified_since = new \DateTime("2019-01-02T19:20:30+01:00"); // \DateTime | Only records created or modified since this timestamp will be returned
      $if_modified_since = null;
      $where = 'Type=="ACCREC"'; // string
      $where = null;
      $order = null; // string
      $ids = null; // string[] | Filter by a comma-separated list of Invoice Ids.
      $invoice_numbers = null; // string[] |  Filter by a comma-separated list of Invoice Numbers.
      $contact_ids = null; // string[] | Filter by a comma-separated list of ContactIDs.
      $statuses = array("DRAFT", "SUBMITTED");;
      $page = 1; // int | e.g. page=1 – Up to 100 invoices will be returned in a single API call with line items
      $include_archived = null; // bool | e.g. includeArchived=true - Contacts with a status of ARCHIVED will be included
      $created_by_my_app = null; // bool | When set to true you'll only retrieve Invoices created by your app
      $unitdp = null; // int | e.g. unitdp=4 – You can opt in to use four decimal places for unit amounts

      try {
        $apiResponse = $accountingApi->getInvoices($xeroTenantId, $if_modified_since, $where, $order, $ids, $invoice_numbers, $contact_ids, $statuses, $page, $include_archived, $created_by_my_app, $unitdp);
        if ( count($apiResponse->getInvoices()) > 0 ) {
          $message = 'Total invoices found: ' . count($apiResponse->getInvoices());
        } else {
          $message = "No invoices found matching filter criteria";
        }
      } catch (Exception $e) {
          echo 'Exception when calling AccountingApi->getInvoices: ', $e->getMessage(), PHP_EOL;
      }
    } else if ($_GET["action"] == 4) {
      // Create Multiple Contacts
      try {
        $contact = new XeroAPI\XeroPHP\Models\Accounting\Contact;
        $contact->setName('George Jetson')
                ->setFirstName("George")
                ->setLastName("Jetson")
                ->setEmailAddress("george.jetson@aol.com");

        // Add the same contact twice - the first one will succeed, but the
        // second contact will throw a validation error which we'll catch.
        $arr_contacts = [];
        array_push($arr_contacts, $contact);
        array_push($arr_contacts, $contact);
        $contacts = new XeroAPI\XeroPHP\Models\Accounting\Contacts;
        $contacts->setContacts($arr_contacts);

        $apiResponse = $accountingApi->createContacts($xeroTenantId,$contacts,false);
        $message = 'First contacts created: ' . $apiResponse->getContacts()[0]->getName();

        if ($apiResponse->getContacts()[1]->getHasValidationErrors()) {
          $message = $message . '<br> Second contact validation error : ' . $apiResponse->getContacts()[1]->getValidationErrors()[0]["message"];
        }
      } catch (\XeroAPI\XeroPHP\ApiException $e) {
        $error = AccountingObjectSerializer::deserialize(
          $e->getResponseBody(),
          '\XeroAPI\XeroPHP\Models\Accounting\Error',
          []
        );
        $message = "ApiException - " . $error->getElements()[0]["validation_errors"][0]["message"];
      }
    }else if ($_GET["action"] == 6) {
      // Create Invoices
      try {
		$summarizeErrors = true;
		$unitdp = 4;
		$dateValue = new DateTime('2020-11-10');
		$dueDateValue = new DateTime('2021-11-20');
		
		$contact = new XeroAPI\XeroPHP\Models\Accounting\Contact;
		$contact->setContactID('34594fcd-6ba2-4ff7-b7c8-b27721d7462a');
		
		$lineItemTracking = new XeroAPI\XeroPHP\Models\Accounting\LineItemTracking;
		$lineItemTracking->setTrackingCategoryID('00000000-0000-0000-0000-000000000000');
		$lineItemTracking->setTrackingOptionID('00000000-0000-0000-0000-000000000000');
		$lineItemTrackings = [];
		array_push($lineItemTrackings, $lineItemTracking);
		
		$lineItem = new XeroAPI\XeroPHP\Models\Accounting\LineItem;
		$lineItem->setDescription('Foobar');
		$lineItem->setQuantity(1.0);
		$lineItem->setUnitAmount(20.0);
		$lineItem->setAccountCode('000');
		$lineItem->setTracking($lineItemTrackings);
		$lineItems = [];
		array_push($lineItems, $lineItem);
		
		$invoice = new XeroAPI\XeroPHP\Models\Accounting\Invoice;
		$invoice->setType(XeroAPI\XeroPHP\Models\Accounting\Invoice::TYPE_ACCREC);
		$invoice->setContact($contact);
		$invoice->setDate($dateValue);
		$invoice->setDueDate($dueDateValue);
		$invoice->setLineItems($lineItems);
		$invoice->setReference('WordPress Plugin Development');
		$invoice->setStatus(XeroAPI\XeroPHP\Models\Accounting\Invoice::STATUS_DRAFT);
		
		$invoices = new XeroAPI\XeroPHP\Models\Accounting\Invoices;
		$arr_invoices = [];
		array_push($arr_invoices, $invoice);
		$invoices->setInvoices($arr_invoices);

		$apiResponse = $accountingApi->createInvoices($xeroTenantId, $invoices, $summarizeErrors, $unitdp);
        //$message = 'First contacts created: ' . $apiResponse->getContacts()[0]->getName();
		echo '<pre>';
		print_r($apiResponse);

        // if ($apiResponse->getContacts()[1]->getHasValidationErrors()) {
        //   $message = $message . '<br> Second contact validation error : ' . $apiResponse->getContacts()[1]->getValidationErrors()[0]["message"];
        // }
      } catch (\XeroAPI\XeroPHP\ApiException $e) {
        $error = AccountingObjectSerializer::deserialize(
          $e->getResponseBody(),
          '\XeroAPI\XeroPHP\Models\Accounting\Error',
          []
        );
        $message = "ApiException - " . $error->getElements()[0]["validation_errors"][0]["message"];
      }
    }else if ($_GET["action"] == 5) {
      // DELETE the org FIRST Connection returned
      $connections = $identityApi->getConnections();
      $id = $connections[0]->getId();
      $result = $identityApi->deleteConnection($id);
    }
  }
?>
<html>
  <body>
    <ul>
      <li><a href="authorizedResource.php?action=6">Create A Invoice</a></li>
      <li><a href="authorizedResource.php?action=1">Get Organisation Name</a></li>
      <li><a href="authorizedResource.php?action=2">Create one Contact</a></li>
      <li><a href="authorizedResource.php?action=3">Get Invoice with Filters</a></li>
      <li><a href="authorizedResource.php?action=4">Create multiple contacts and summarizeErrors</a></li>
      <li><a href="authorizedResource.php?action=5">Delete an organisation connection</a></li>
      
    </ul>
    <div>
    <?php
      echo($message );
    ?>
    </div>
  </body>
</html>