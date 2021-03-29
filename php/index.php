<?php

require_once 'graphql-query.php';
require_once 'queries.php';

$resp = GraphQL::_query(Queries::getSinglePost(), ['user' => 'FX'], 'my-oauth-token');
var_dump($resp);
var_dump($resp['data']['user']['email']);
die;

function graphql_query(string $endpoint, string $query, array $variables = [], ?string $token = null): array
{
    $headers = ['Content-Type: application/json', 'User-Agent: Dunglas\'s minimal GraphQL client'];
    if (null !== $token) {
        $headers[] = "Authorization: bearer $token";
    }

    if (false === $data = @file_get_contents($endpoint, false, stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => $headers,
            'content' => json_encode(['query' => $query, 'variables' => $variables]),
        ]
    ]))) {
        $error = error_get_last();
        throw new \ErrorException($error['message'], $error['type']);
    }
    
    // var_dump($query);die;
    
    
    
    // var_dump($resp);

    return json_decode($data, true);
}

$query = <<<'GRAPHQL'
    query ss{
    user(id: 1) {
        id
        username
        email
        address {
          geo {
            lat
            lng
          }
        }
      }
    }
    GRAPHQL;

var_dump(graphql_query('https://graphqlzero.almansi.me/api', $query, ['user' => 'dunglas'], 'my-oauth-token'));

?>