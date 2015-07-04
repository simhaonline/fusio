<?php
/*
 * Fusio
 * A web-application to create dynamically RESTful APIs
 *
 * Copyright (C) 2015 Christoph Kappestein <k42b3.x@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Fusio\Backend\Api\Action;

use PSX\Test\ControllerDbTestCase;

class ListTest extends ControllerDbTestCase
{
    public function getDataSet()
    {
        return $this->createMySQLXMLDataSet(__DIR__ . '/../../../fixture.xml');
    }

    public function testGet()
    {
        $response = $this->sendRequest('http://127.0.0.1/backend/action/list', 'GET', array(
            'User-Agent'    => 'Fusio TestCase',
            'Authorization' => 'Bearer da250526d583edabca8ac2f99e37ee39aa02a3c076c0edc6929095e20ca18dcf'
        ));

        $body   = (string) $response->getBody();
        $expect = <<<'JSON'
{
    "actions": [
        {
            "name": "Beanstalk-Push",
            "class": "Fusio\\Action\\BeanstalkPush"
        },
        {
            "name": "Cache-Response",
            "class": "Fusio\\Action\\CacheResponse"
        },
        {
            "name": "Composite",
            "class": "Fusio\\Action\\Composite"
        },
        {
            "name": "Condition",
            "class": "Fusio\\Action\\Condition"
        },
        {
            "name": "HTTP-Request",
            "class": "Fusio\\Action\\HttpRequest"
        },
        {
            "name": "Mongo-Fetch-All",
            "class": "Fusio\\Action\\MongoFetchAll"
        },
        {
            "name": "Mongo-Fetch-Row",
            "class": "Fusio\\Action\\MongoFetchRow"
        },
        {
            "name": "Mongo-Insert",
            "class": "Fusio\\Action\\MongoInsert"
        },
        {
            "name": "Mongo-Update",
            "class": "Fusio\\Action\\MongoUpdate"
        }
    ]
}
JSON;

        $this->assertEquals(null, $response->getStatusCode(), $body);
        $this->assertJsonStringEqualsJsonString($expect, $body, $body);
    }
}