<?php

require_once 'graphql-query.php';
require_once 'queries.php';


// query include parameter
$resp = GraphQL::_query(Queries::getSinglePost());
var_dump($resp['data']['user']['email']);

// passing parameter as query variable
$resp = GraphQL::_query(Queries::getSinglePostByQueryVar(), ['id' => 5]);
var_dump($resp['data']['user']['email']);

// Complex query
$resp = GraphQL::_query(Queries::getComments(), ["pqo"=> ["paginate"=> ["page"=> 1,"limit"=> 25]]]);
var_dump($resp['data']['comments']['meta']['totalCount']);
foreach ($resp['data']['comments']['data'] as $_resp) {
    echo $_resp['email'] . " : " . $_resp['name'] . "<br>";
}

?>