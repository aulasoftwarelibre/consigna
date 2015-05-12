<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 8/10/14
 * Time: 9:57.
 */

namespace AppBundle\Behat;

use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;
use Guzzle;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;

class CoreContext extends DefaultContext
{
    /**
     * Opens specified page.
     *
     * @Given /^(?:|I )am on (?:|the )main folder$/
     * @When /^(?:|I )go to (?:|the )main folder$/
     */
    public function visitMainFolder()
    {
        $this->getSession()->visit($this->generatePageUrl('homepage'));
    }

    /**
     * Opens specified page.
     *
     * @Then /^(?:|I )should be on (?:|the )main folder$/
     */
    public function iShouldBeOnMainFolder()
    {
        $this->assertSession()->addressEquals($this->generatePageUrl('homepage'));
    }

    /**
     * Checks, that current page PATH is equal to specified.
     *
     * @Then /^(?:|I )should be now on "(?P<page>[^"]+)"$/
     */
    public function iShouldBeNowOn($page)
    {
        $this->assertSession()->addressEquals($this->generatePageUrl($page));
    }

//    /**
//     * @When /^I try to download "([^"]*)"$/
//     */
//     public function iTryToDownload($url)
//     {
////         $cookies = $this->getSession()->getDriver()->getCookie('PHPSESSID');
////         $cookie = new \Guzzle\Plugin\Cookie\Cookie();
////         $cookie->setName($cookies[0]['name']);
////         $cookie->setValue($cookies[0]['value']);
////         $cookie->setDomain($cookies[0]['domain']);
////
////         $jar = new \Guzzle\Plugin\Cookie\CookieJar\ArrayCookieJar();
////         $jar->add($cookie);
////
////         $client = $this->getSession()->getCurrentUrl();
////         $client->addSubscriber(new \Guzzle\Plugin\Cookie\CookiePlugin($jar));
//
//         $request = new \Symfony\Component\HttpFoundation\Request();
//         $request->get($url);
//
////         $request = $client->get($url);
////         $this->response = $request->send();
//     }

    /**
     * @Then /^I should see response status code "([^"]*)"$/
     */
     public function iShouldSeeResponseStatusCode($statusCode)
     {
         $response = new Response();
         $responseStatusCode = $response->getStatusCode();

         if (!$responseStatusCode == intval($statusCode)) {
            throw new \Exception(sprintf("Did not see response status code %s, but %s.", $statusCode, $responseStatusCode));
         }
     }

     /**
     * @Then /^I should see in the header "([^"]*)":"([^"]*)"$/
     */
     public function iShouldSeeInTheHeader($header, $value)
     {
         $request = new \Symfony\Component\HttpFoundation\Request();
         $headers =$request->headers->get('content_type');
         if ($headers != $value) {
             throw new \Exception(sprintf("Did not see %s with value %s.", $header, $value));
         }
     }
 }
