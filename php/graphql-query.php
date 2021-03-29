<?php

class GraphQL
{
    private const ENDPOINT = 'https://graphqlzero.almansi.me/api';

    public static function _query(string $query, array $variables = [], ?string $token = null): array
    {
        $headers = [
            'Content-Type: application/json'
        ];
        
        if (null !== $token) {
            $headers[] = "Authorization: bearer $token";
        }
    
        $data = file_get_contents(self::ENDPOINT, false, stream_context_create(
            [
                'http' => [
                    'method' => 'POST',
                    'header' => $headers,
                    'content' => json_encode(
                        [
                            'query' => $query, 
                            'variables' => $variables
                        ]
                    ),
                ]
            ]
        ));
    
        return json_decode($data, true);
    }
}

