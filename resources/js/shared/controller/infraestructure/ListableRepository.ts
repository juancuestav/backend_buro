import { Endpoint } from "@shared/http/Endpoint"
import { getEndpoint } from "@shared/http/utils"
import axios from "axios"

export class ListableRepository {
    private readonly endpoint: Endpoint

    constructor(endpoint: Endpoint) {
        this.endpoint = endpoint
    }

    async listar(params?: any) {
        const ruta = getEndpoint(this.endpoint, params)
        const response = await axios.get(ruta)
        return { response, result: response.data.results }
    }
}
