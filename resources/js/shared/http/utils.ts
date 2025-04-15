import { baseURL } from "@config/api.config"
import { ApiError } from "./ApiError"
import { Endpoint } from "./Endpoint"

export function isAxiosError(candidate: any): candidate is ApiError {
    return candidate instanceof ApiError === true
}

export function getEndpoint(endpoint: Endpoint, params?: any) {
    const ruta = (endpoint.includeAdminPath ? "admin/" : "") + endpoint.accessor
    return baseURL + ruta + (params ? mapearParams(params) : "")
}

export function mapearParams(params: Record<string, any>): string {
    const query: any = []

    // comprueba si el valor es valido
    for (const key in params)
        if (params[key] !== null && params[key] !== undefined) {
            query.push(`${key}=${params[key]}`)
        }
    return `?${query.join("&")}`
}

export function encapsularFormData(entidad: any) {
    let formData = new FormData()

    for (let key in entidad) {
        formData.append(key, entidad[key])
    }

    return formData
}

export function descargarArchivo(
    data: any,
    titulo: string,
    mimeType: string,
    formato: string
): void {
    const link = document.createElement("a")
    link.href = URL.createObjectURL(
        new Blob([data], { type: mimeType })
    )
    link.setAttribute("download", `${titulo}.${formato}`)
    document.body.appendChild(link)
    link.click()
    link.remove()
}
