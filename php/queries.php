<?php

class Queries
{
    public static function getSinglePost()
    {
        return '
            query {
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
        ';
    }
}