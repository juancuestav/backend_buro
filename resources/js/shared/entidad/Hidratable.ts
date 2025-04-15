export class Hidratable {
    hydrate(data: any) {
        // entidad para obtener atributos por defecto
        const defValues = this.constructor();

        for (const key in this) {
            const value = this[key];

            if (value instanceof Hidratable) value.hydrate(data[key]);
            // si existe algun dato que coincida, se ocupara dicho valor
            else if (data.hasOwnProperty(key)) this[key] = data[key];
            // de otra forma, ocupara un atributo por defecto para esa clave
            else this[key] = defValues[key];
        }
        return this;
    }

    createCopy() {
        const copy = this.constructor();
        copy.hydrate(this);
        return copy;
    }
}
