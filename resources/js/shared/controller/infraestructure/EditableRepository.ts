import { Endpoint } from "@shared/http/Endpoint"
import { getEndpoint } from "@shared/http/utils"
import { ApiError } from "@shared//http/ApiError"
import axios from "axios"

export class EditableRepository {
    private readonly endpoint: Endpoint

    constructor(endpoint: Endpoint) {
        this.endpoint = endpoint
    }

    async editar(entidad: any, id: number) {
        const content: any = document?.querySelector('meta[name="csrf-token"]')
        entidad._token = content.content

        try {
            const ruta = getEndpoint(this.endpoint) + id
            const response = await axios.put(ruta, entidad)
            return {
                response,
                result: response.data.modelo,
            }
        } catch (error: any) {
            throw new ApiError(error)
        }
    }
}
