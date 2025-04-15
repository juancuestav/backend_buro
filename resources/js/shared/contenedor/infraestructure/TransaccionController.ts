import { GuardableRepository } from "../../controller/infraestructure/GuardableRepository"
import { ConsultableRepository } from "../../controller/infraestructure/ConsultableRepository"
import { EliminableRepository } from "../../controller/infraestructure/EliminableRepository"
import { EditableRepository } from "../../controller/infraestructure/EditableRepository"
import { ListableRepository } from "../../controller/infraestructure/ListableRepository"
import { Endpoint } from "@shared/http/Endpoint"

export class TransaccionController {
    private guardableRepository: GuardableRepository
    private consultableRepository: ConsultableRepository
    private eliminableRepository: EliminableRepository
    private editableRepository: EditableRepository
    private listableRepository: ListableRepository

    constructor(endpoint: Endpoint) {
        this.guardableRepository = new GuardableRepository(endpoint)
        this.consultableRepository = new ConsultableRepository(endpoint)
        this.eliminableRepository = new EliminableRepository(endpoint)
        this.editableRepository = new EditableRepository(endpoint)
        this.listableRepository = new ListableRepository(endpoint)
    }

    async guardar(entidad: any) {
        return await this.guardableRepository.guardar(entidad)
    }

    async consultar(id: number) {
        return await this.consultableRepository.consultar(id)
    }

    async eliminar(id: number) {
        return await this.eliminableRepository.eliminar(id)
    }

    async editar(entidad: any) {
        return await this.editableRepository.editar(entidad, entidad.id)
    }

    async listar(params?: any) {
        return this.listableRepository.listar(params)
    }
}
