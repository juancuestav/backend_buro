import { getEndpoint } from "@shared/http/utils";
import { Endpoint } from "@shared/http/Endpoint";
import { ApiError } from "@shared/http/ApiError";
import axios from "axios";

export class EliminableRepository {
    private readonly endpoint: Endpoint;

    constructor(endpoint: Endpoint) {
        this.endpoint = endpoint;
    }

    async eliminar(id: number) {
		const content: any = document?.querySelector('meta[name="csrf-token"]')
		const data = {_token: content.content}

        try {
            const ruta = getEndpoint(this.endpoint) + id;
            const response = await axios.delete(ruta);
            return {
                response,
                result: response.data.mensaje,
            };
        } catch (error: any) {
            throw new ApiError(error);
        }
    }
}
