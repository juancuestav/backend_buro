import { Endpoint } from "@shared/http/Endpoint"
import { ApiError } from "@shared/http/ApiError"
import { getEndpoint } from "@shared/http/utils"
import axios from "axios"

export class GuardableRepository {
    private readonly endpoint: Endpoint

    constructor(endpoint: Endpoint) {
        this.endpoint = endpoint
    }

    async guardar(entidad: any) {
		const content: any = document?.querySelector('meta[name="csrf-token"]')
		entidad._token = content.content

        try {
            const ruta = getEndpoint(this.endpoint)
            const response = await axios.post(ruta, entidad)
            return {
                response,
                result: response.data.modelo,
            }
        } catch (error: any) {
            throw new ApiError(error)
        }
    }
}
