export const NUMERO_ENTERO_MAXIMO = 999999999999
export const NUMERO_DECIMAL_MAXIMO = NUMERO_ENTERO_MAXIMO

export const CONFIG_DECIMALES = {
    numeral: true,
    rawValueTrimPrefix: true,
    numeralPositiveOnly: true,
    numeralDecimalMark: ".",
    numeralDecimalScale: 2,
    delimiter: ",",
}

export const CONFIG_PORCENTAJE = {
    numeral: true,
    prefix: "%",
    tailPrefix: true,
    numeralPositiveOnly: true,
    rawValueTrimPrefix: true,
    noImmediatePrefix: true,
    numeralIntegerScale: 3,
    numeralDecimalScale: 0,
}

export const CONFIG_CELULAR = {
    numeral: true,
    stripLeadingZeroes: false,
    numeralPositiveOnly: true,
    numeralDecimalScale: 0,
    numeralIntegerScale: 10,
    delimiter: "",
}

export const CONFIG_RUC = {
    numeral: true,
    stripLeadingZeroes: false,
    numeralPositiveOnly: true,
    numeralDecimalScale: 0,
    numeralIntegerScale: 13,
    delimiter: "",
}

export const CONFIG_PUNTUACION = {
    numeral: true,
    stripLeadingZeroes: true,
    numeralPositiveOnly: true,
    numeralDecimalScale: 0,
    numeralIntegerScale: 3,
    delimiter: "",
}
