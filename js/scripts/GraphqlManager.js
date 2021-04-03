import Graphql from "./Graphql.js";
import Query from "./Query.js";

class GraphqlManager extends Graphql {

    constructor(){
        super();
        this.singleRequest();
        this.singleRequestWithVar();
        this.MultipleRequestWithVar();
    }

    singleRequest() {
        super.handler(Query.singleQuery(), null);
    }

    singleRequestWithVar() {
        super.handler(Query.singleQueryWithVar(), {
            id: 5
        });
    }

    MultipleRequestWithVar() {
        super.handler(Query.multipleQueryWithVar(), {
            pqo : {
                paginate : {
                    page : 1,
                    limit : 10
                }
            }
        });
    }
}

export default GraphqlManager;