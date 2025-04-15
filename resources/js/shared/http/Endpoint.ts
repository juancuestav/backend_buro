export class Endpoint {
    accessor: string;
    includeAdminPath: boolean;

    constructor(accessor: string, includeAdminPath = true) {
        this.accessor = accessor;
        this.includeAdminPath = includeAdminPath;
    }
}
