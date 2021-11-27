<?php

namespace App\Tests\Functional\Controller;

use App\Tests\BaseWebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ThresholdControllerTest extends BaseWebTestCase
{

    protected bool $purge = true;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testSuccessfulUserThresholdBalanceUpdate()
    {


        $data = array(
            'user_id' => '1adfe3-56bcae-367dde-446aed',
            'amount' => 4500
        );

        self::$client->request('POST', '/threshold', $data);

        $responseData = json_decode(self::$client->getResponse()->getContent(), true);
        $statusCode = self::$client->getResponse()->getStatusCode();

        $this->assertEquals(true, $responseData['success']);
        $this->assertEquals(Response::HTTP_OK, $statusCode);
    }
}
