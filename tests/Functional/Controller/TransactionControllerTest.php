<?php

namespace App\Tests\Functional\Controller;

use App\Tests\BaseWebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TransactionControllerTest extends BaseWebTestCase
{

    protected bool $purge = true;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testSuccessfulUserCredit()
    {
        $data = array(
            'user_id' => '1adfe3-56bcae-367dde-446aed',
            'amount' => 10000
        );

        self::$client->request('POST', '/credit', $data);

        $responseData = json_decode(self::$client->getResponse()->getContent(), true);
        $statusCode = self::$client->getResponse()->getStatusCode();

        $this->assertEquals(true, $responseData['success']);
        $this->assertEquals(200, $statusCode);
    }

    public function testSuccessfulUserDebit()
    {

        $data = array(
            'user_id' => '1adfe3-56bcae-367dde-446aed',
            'amount' => 10000
        );

        self::$client->request('POST', '/credit', $data);

        $data = array(
            'user_id' => '1adfe3-56bcae-367dde-446aed',
            'amount' => 5000
        );

        self::$client->request('POST', '/debit', $data);

        $responseData = json_decode(self::$client->getResponse()->getContent(), true);
        $statusCode = self::$client->getResponse()->getStatusCode();

        $this->assertEquals(true, $responseData['success']);
        $this->assertEquals(200, $statusCode);
    }

    public function testInvalidUserDebitAmount()
    {
        $data = array(
            'user_id' => '1adfe3-56bcae-367dde-446aed',

        );

        self::$client->request('POST', '/debit', $data);

        $responseData = json_decode(self::$client->getResponse()->getContent(), true);
        $statusCode = self::$client->getResponse()->getStatusCode();

        $this->assertEquals(false, $responseData['success']);
        $this->assertEquals(Response::HTTP_EXPECTATION_FAILED, $statusCode);
    }
}
