import $ from "jquery";

class Graphql {

    VARS = {
        'API' : 'https://graphqlzero.almansi.me/api',
    };

    constructor(){
        this.singleQuery();
        this.singleQueryWithVar();
    }

    singleQuery() {
        var thisObj = this;
        var query = `
            query {
                user(id: 2) {
                id
                username
                email
                address {
                    city
                }
                }
            }
        `;

        this.apiRequest(query)
        .then(function(response) {
            thisObj.htmlify(response);
        })
        ;
    }

    singleQueryWithVar() {
        var thisObj = this;
        var query = `
            query ($id: ID!) {
                user(id: $id) {
                id
                username
                email
                address {
                    city
                }
                }
            }
        `;

        this.apiRequest(query, {id: 5})
        .then(function(response) {
            thisObj.htmlify(response);
        })
        ;
    }

    apiRequest(query, variables) {
        var thisObj = this;

        return fetch(thisObj.VARS["API"], {
            method: 'POST',
            headers: { 
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                query: query,
                variables: variables
            })
        })
        .then(res => res.json())
        ;
    }

    htmlify($jsonObj) {
        var $target = $('main');
        var string = JSON.stringify($jsonObj);
        var $apiReader = $('#api-reader');
        $apiReader.clone().removeAttr("id").html(string).appendTo($target).css({
            "display": "block",
        });
    }
}

export default Graphql;