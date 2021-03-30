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
    
    public static function getSinglePostByQueryVar()
    {
        return '
            query ($id: ID!) {
            user(id: $id) {
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
    
    public static function getComments()
    {
        return '
            query ($pqo: PageQueryOptions!) {
            comments(options: $pqo) {
            	data{name, email},
                meta{totalCount}
              }
            }
        ';
    }
}