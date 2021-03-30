<?php

class GraphQL
{
    private const ENDPOINT = 'https://graphqlzero.almansi.me/api';
    
    private const OATH_TOKEN = 'Lyi63vv1LTC48dmKRlxQbLbDbzo4MaWv';

    public static function _query(string $query, array $variables = []): array
    {
        $headers = [
            'Content-Type: application/json',
            "Authorization: bearer " . self::OATH_TOKEN,
        ];

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

