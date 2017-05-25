<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeachersControllerTest extends WebTestCase
{
    public function testTeachers()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/teachers');
    }

}
