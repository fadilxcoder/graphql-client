<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once 'graphql-query.php';
require_once 'queries.php';

use Tracy\Debugger as Debugger;
Debugger::enable(Debugger::DEVELOPMENT);


#### GET ####

# query include parameter
$resp = GraphQL::_query(Queries::getSinglePost());
dump($resp['data']['user']['email']);


# passing parameter as query variable
$resp = GraphQL::_query(
            Queries::getSinglePostByQueryVar(), 
            [
                'id' => 5
            ]
        );
dump($resp['data']['user']['email']);


# Complex query
$resp = GraphQL::_query(
            Queries::getComments(), 
            [
                "pqo" => [
                    "paginate" => [
                        "page" => 1,
                        "limit" => 25
                    ]
                ]
            ]
        );
dump($resp['data']['comments']['meta']['totalCount']);

foreach ($resp['data']['comments']['data'] as $_resp) {
    dump($_resp['email'] . " : " . $_resp['name']);
}


#### POST ####

# Create a user
$resp = GraphQL::_query(
            Queries::postUser(),
            [
                "input" => [
                    "name" => "FADIL XCODER",
                    "username" => "fadilxcoder",
                    "email" => "fadil@xcoder.dvlpr",
                    "address" => [
                        "street" => "Silicon Valley",
                        "city" => "California"
                    ],
                    "phone" => "55757575",
                    "website" => "fadil.xcoder.dev"
                ]
            ]
        );
        
bdump($resp);
dump($resp['data']['createUser']['id']);