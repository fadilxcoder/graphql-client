import $ from "jquery";

class Graphql {

    VARS = {
        'API' : 'https://graphqlzero.almansi.me/api',
    };

    constructor(){
    }

    handler(query, args) {
        var thisObj = this;
        if (null === args) {
            args = {};
        }

        this._apiRequest(query, args)
        .then(function(response) {
            thisObj._htmlify(response);
        })
        ;
    }

    _apiRequest(query, variables) {
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

    _htmlify($jsonObj) {
        var $target = $('main');
        var string = JSON.stringify($jsonObj);
        var $apiReader = $('#api-reader');
        $apiReader.clone().removeAttr("id").html(string).appendTo($target).css({
            "display": "block",
        });
    }
}

export default Graphql;