@extends('layouts.app')

@section('content')
    <div class="container mt-4 mx-auto py-4">
        <div class="d-flex justify-content-around align-items-center mb-5">
            <img src="{{ asset('img/buro.png') }}" alt="logo empresa" width="100">
            <div>
                <h1 class="text-center">Política de Privacidad</h1>
                <p class="text-sm text-gray-500 text-center mb-6">Última actualización: 29-11-2024</p>
            </div>
            <img src="{{ asset('img/buro.png') }}" alt="logo empresa" width="100">
        </div>

        <p class="px-5 mb-5">
            En <b>Buró de Crédito Ecuador</b>, valoramos tu privacidad y nos comprometemos a proteger la información
            personal y
            crediticia que compartas con nosotros. Esta Política de Privacidad describe cómo recopilamos, usamos,
            almacenamos y protegemos tus datos al usar nuestra aplicación.
        </p>

        <div class="px-5">
            <section>
                <h2 class="text-2xl font-semibold text-blue-500">1. Información que Recopilamos</h2>
                <div class="h-1 bg-blue-500 w-20 mb-4"></div>
                <p class="text-gray-700 leading-relaxed">Recopilamos información personal y crediticia para garantizar
                    el correcto funcionamiento de nuestra aplicación y brindarte un servicio personalizado. Esto
                    incluye:</p>
                <ul class="list-disc list-inside mt-4 text-gray-600 space-y-2">
                    <li><strong>Información de Registro:</strong> Nombre, dirección de correo electrónico, número de
                        identificación y datos de contacto necesarios para crear tu cuenta.
                    </li>
                    <li><strong>Información Crediticia:</strong> Datos relacionados con tus informes crediticios
                        proporcionados por los administradores de la aplicación.
                    </li>
                    <li><strong>Información del Dispositivo:</strong> Dirección IP, modelo de dispositivo, sistema
                        operativo y otros datos técnicos.
                    </li>
                </ul>
            </section>

            <section>
                <h2 class="mt-5">2. Cómo Usamos Tu Información</h2>
                <div class="h-1 bg-blue-500 w-20 mb-4"></div>
                <p class="text-gray-700 leading-relaxed">Usamos la información recopilada para:</p>
                <ul class="list-disc list-inside mt-4 text-gray-600 space-y-2">
                    <li>Verificar y autenticar tu cuenta.</li>
                    <li>Generar y entregarte informes crediticios personalizados.</li>
                    <li>Mejorar la funcionalidad y seguridad de la aplicación.</li>
                    <li>Comunicarnos contigo para resolver dudas o enviarte notificaciones.</li>
                    <li>Cumplir con requisitos legales.</li>
                </ul>
            </section>

            <section>
                <h2 class="mt-5">3. Compartición de Información</h2>
                <div class="h-1 bg-blue-500 w-20 mb-4"></div>
                <p class="text-gray-700 leading-relaxed">No compartimos, vendemos ni alquilamos tu información personal
                    a terceros, salvo en las siguientes circunstancias:</p>
                <ul class="list-disc list-inside mt-4 text-gray-600 space-y-2">
                    <li>Con los administradores de la aplicación para generar informes crediticios.</li>
                    <li>Cuando sea requerido por ley o autoridad judicial.</li>
                    <li>Para proteger nuestros derechos, seguridad o propiedad.</li>
                </ul>
            </section>

            <section>
                <h2 class="mt-5">4. Protección de Datos</h2>
                <div class="h-1 bg-blue-500 w-20 mb-4"></div>
                <ul class="list-disc list-inside mt-4 text-gray-600 space-y-2">
                    <li>Cifrado de datos en tránsito y almacenamiento.</li>
                    <li>Accesos controlados únicamente para personal autorizado.</li>
                    <li>Revisiones periódicas de seguridad.</li>
                </ul>
            </section>

            <section>
                <h2 class="mt-5 mb-4">5. Tus Derechos</h2>
                <p>Como usuario, tienes los siguientes derechos sobre tu información:</p>
                <ul class="list-disc list-inside mt-4 text-gray-600 space-y-2">
                    <li>Acceso a los datos personales que hemos recopilado sobre ti.</li>
                    <li>Corrección de información incorrecta o desactualizada.</li>
                    <li>Eliminación de tus datos personales (en caso de cierre de cuenta).</li>
                    <li>Restricción del procesamiento de tus datos.</li>
                </ul>
                Para ejercer estos derechos, contáctanos en atencionclientes@burodecredito.ec
            </section>

            <section>
                <h2 class="mt-5 mb-4">6. Política de Datos Sensibles</h2>
                <p>Tu información crediticia es tratada con estricta confidencialidad y únicamente se usa
                    para entregarte informes. Esta información no se comparte con terceros sin tu
                    consentimiento explícito.</p>
            </section>

            <section>
                <h2 class="mt-5 mb-4">7. Cambios a Esta Política</h2>
                <p>Nos reservamos el derecho de actualizar esta Política de Privacidad. Los cambios se
                    notificarán a través de la aplicación o correo electrónico, indicando la fecha de la última
                    actualización.</p>
            </section>

            <section>
                <h2 class="mt-5">8. Contacto</h2>
                <div class="h-1 bg-blue-500 w-20 mb-4"></div>
                <p class="text-gray-700 leading-relaxed">Si tienes preguntas sobre esta Política de Privacidad,
                    contáctanos:</p>
                <ul class="list-disc list-inside mt-4 text-gray-600 space-y-2">
                    <li>Correo: <a href="mailto:atencionclientes@burodecredito.ec"
                            class="text-blue-500 underline">atencionclientes@burodecredito.ec</a>
                    </li>
                    <li>Teléfono: 0983192139</li>
                </ul>
            </section>
        </div>
    </div>
@endsection
