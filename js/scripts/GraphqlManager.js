import Graphql from "./Graphql.js";
import Query from "./Query.js";

class GraphqlManager extends Graphql {

    constructor(){
        super();
        this.singleRequest();
        this.singleRequestWithVar();
        this.deleteRequestWithVar();
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

    deleteRequestWithVar() {
        super.handler(Query.deleteQueryWithVar(), {
            id : 1
        });
    }
}

export default GraphqlManager;