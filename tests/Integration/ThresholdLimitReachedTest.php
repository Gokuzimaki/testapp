<?php

namespace App\Tests\Integration;

use App\Tests\BaseWebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ThresholdLimitReachedTest extends BaseWebTestCase
{
    protected bool $purge = true;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testThresholdLimitReachedResponse()
    {

        // set a threshold
        $data = array(
            'user_id' => '1adfe3-56bcae-367dde-446aed',
            'amount' => 4500
        );

        self::$client->request('POST', '/threshold', $data);

        // credit the user
        $data = array(
            'user_id' => '1adfe3-56bcae-367dde-446aed',
            'amount' => 10000
        );

        self::$client->request('POST', '/credit', $data);

        // debit the user just right
        $data = array(
            'user_id' => '1adfe3-56bcae-367dde-446aed',
            'amount' => 6000
        );

        self::$client->request('POST', '/debit', $data);

        $responseData = json_decode(self::$client->getResponse()->getContent(), true);
        $statusCode = self::$client->getResponse()->getStatusCode();

        $this->assertEquals(Response::HTTP_OK, $statusCode);
        $this->assertEquals(true, $responseData['success']);
        $this->assertEquals('1adfe3-56bcae-367dde-446aed', $responseData['userId']);
        $this->assertEquals('4,500', $responseData['threshold']);
        $this->assertEquals('6,000', $responseData['totalSpendings']);
    }
}
