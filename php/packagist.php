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
    
$gql = (new Query())
    ->setSelectionSet(
        [
            (new Query('user'))
            ->setArguments(['id' => 3])
            ->setSelectionSet(
                [
                    'id',
                    'email',
                    (new Query('address'))
                    ->setSelectionSet(
                        [
                            'street'    
                        ]
                    ),
                    (new Query('posts'))
                    ->setSelectionSet(
                        [
                            (new Query('data'))
                            ->setSelectionSet(
                                [
                                    'body',
                                    (new Query('comments'))
                                    ->setSelectionSet(
                                        [
                                            (new Query('data'))
                                            ->setSelectionSet(
                                                [
                                                    'name'
                                                ]
                                            )
                                        ]
                                    )
                                ]
                            )
                        ]
                    )
                ]
            ),
            (new Query('post'))
            ->setArguments(['id' => 5])
            ->setSelectionSet(
                [
                    'id',
                    'title',
                ]
            )
        ]
    )
;    


try {
    $results = $client->runQuery($gql);     # Run query to get results
    
    // dump($results->getResponseObject());    # Display original response from endpoint
    
    // dump($results->getData()->user);        # Display part of the returned results of the object
    
    // $results->reformatResults(true);
    // dump($results->getData()['user']);      # Reformat the results to an array and get the results of part of the array
    
    /* logic handler */
    
    dump($results->getData()->user);
    dump($results->getData()->post);
    
} catch (QueryError $exception) {
    dump($exception->getErrorDetails());    # Catch query error and desplay error details
    exit;
}


