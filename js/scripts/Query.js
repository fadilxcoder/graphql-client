class Query {
    
    /**
     * Get query with parameter included
     * @returns string
     */
    static singleQuery() {
        return `
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
    }

    /**
     * Get query with query variable
     * @returns string
     */
    static singleQueryWithVar() {
        return `
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
    }

    /**
     * Get list of objects with query variables
     * @returns string
     */
    static multipleQueryWithVar() {
        return `
            query ($pqo: PageQueryOptions!) {
                users(options: $pqo) {
                    data{name, email}
                }
            }
        `;
    }
}

export default Query;