<?php

class Queries
{
    /**
     * Get single with parameter includes
     */
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
    
    /**
     * Get single with parameter sent as query variables
     */
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
    
    /**
     * Get multiple with multiple parameters sent as query variables
     */
    public static function getComments()
    {
        return '
            query ($pqo: PageQueryOptions!) {
            comments(options: $pqo) {
            	data{name, email}
                meta{totalCount}
              }
            }
        ';
    }
    
    /**
     * Post with query variables
     */
    public static function postUser()
    {
        return '
            mutation (
              $input: CreateUserInput!
            ) {
              createUser(input: $input) {
                id
                name
                email
                address{street}
              }
            }
        ';
    }
    
    public static function updateUser()
    {
        return '
            mutation (
              $id: ID!
              $input: UpdateUserInput!
            ) {
              updateUser(id: $id, input: $input) {
                id
                name
                email
                address{street}
              }
            }
        ';
    }
}