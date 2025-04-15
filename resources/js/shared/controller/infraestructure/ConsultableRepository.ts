import { Endpoint } from "@/shared/http/Endpoint";
import { getEndpoint } from "@/shared/http/utils";
import axios from "axios";

export class ConsultableRepository {
    private readonly endpoint: Endpoint;

    constructor(endpoint: Endpoint) {
        this.endpoint = endpoint;
    }

    async consultar(id: number) {
        const ruta = getEndpoint(this.endpoint) + id;
        const response = await axios.get(ruta);
        return {
            response,
            result: response.data.modelo,
        };
    }
}
