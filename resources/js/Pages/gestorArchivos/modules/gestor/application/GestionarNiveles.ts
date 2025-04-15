import { ApiError } from "@/shared/http/ApiError"
import { getEndpoint } from "@/shared/http/utils"
import { endpoints } from "@config/api.config"
import axios from "axios"

export class GestionarNiveles {
    constructor() {}

    async consultarSubnivel(idCarpeta: number | null) {
        try {
            const params = { carpeta: idCarpeta }
            const ruta = getEndpoint(endpoints.gestor_archivos, params)
            const response = await axios.get(ruta)

            return {
                subcarpetas: response.data.subcarpetas,
                subarchivos: response.data.subarchivos,
                idCarpetaPadre: response.data.idCarpetaPadre,
            }
        } catch (error: any) {
            throw new ApiError(error)
        }
    }
}
