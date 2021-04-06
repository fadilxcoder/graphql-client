<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Tracy\Debugger as Debugger;
use GraphQL\Client;
use GraphQL\Exception\QueryError;
use GraphQL\Query;

Debugger::enable(Debugger::DEVELOPMENT);
dump("Tracy Active !");


$client = new Client(
    "https://graphqlzero.almansi.me/api"
);

$gql = (new Query('user'))
    ->setArguments(['id' => 3])
    ->setSelectionSet(
        [
            'id',
            'email',
            'name',
            'address{street}',
            (new Query('posts'))
                ->setSelectionSet(
                    [
                        'data{title}',
                    ]
                )
        ]
    )
    ;


try {
    $results = $client->runQuery($gql);
}
catch (QueryError $exception) {

    dump($exception->getErrorDetails());
    exit;
}


dump($results->getResponseObject());


dump($results->getData()->user);


$results->reformatResults(true);
dump($results->getData()['user']);