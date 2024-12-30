@extends('template')
@section('titulo', 'Politicas de privacidad')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    @endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Politicas de privacidad</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
        </ol>
        <div>
            <h2>1. Introducción</h2>
            <p>Bienvenido a la página de alquileres del Club San Lorenzo Rauch. Esta plataforma está destinada exclusivamente a administradores autorizados del club. 
                Las principales funciones del sitio incluyen la alta, baja y modificaciones (ABM)
                de alquileres, clientes, servicios, turnos, productos, descuentos, depósitos y métodos de pago.
            </p>

            <h2>2. Recopilación de Información</h2>
            <p>Recopilamos y almacenamos la información necesaria para llevar a cabo las funciones de ABM. Esta información puede incluir:</p>
            <ul>
                <li>Datos de alquileres: Detalles como el nombre del cliente, fechas de alquiler, costos asociados, etc.</li>
                <li>Datos de clientes: Información personal como nombre, dirección, número de teléfono, correo electrónico y cualquier otro dato relevante para la gestión de alquileres.</li>
                <li>Servicios, turnos, productos, descuentos, depósitos y métodos de pago: Información relacionada con las operaciones del club, incluyendo precios, horarios y condiciones de uso.</li>
            </ul>

            <h2>3. Uso de la Información</h2>
            <p>La información recopilada se utiliza exclusivamente para:</p>
            <ul>
                <li>Gestionar las operaciones de alquiler del Club San Lorenzo Rauch.</li>
                <li>Ejecutar las funciones de alta, baja y modificaciones (ABM) de los registros de alquileres, clientes, servicios, turnos, productos, descuentos, depósitos y métodos de pago.</li>
                <li>Mantener la precisión y actualización de los datos almacenados.</li>
            </ul>

            <h2>4. Protección de Datos</h2>
            <p>Nos comprometemos a proteger la información de nuestros usuarios mediante las siguientes medidas:</p>
            <ul>
                <li>Seguridad: Implementamos medidas de seguridad técnicas y organizativas para proteger los datos personales contra el acceso no autorizado, la destrucción, la pérdida o la alteración accidental.</li>
                <li>Acceso Restringido: Solo los administradores autorizados tienen acceso a la plataforma y los datos en ella contenidos.</li>
            </ul>

            <h2>5. Compartición de Información</h2>
            <p>La información recopilada en esta plataforma no será compartida con terceros, excepto cuando sea necesario para cumplir con obligaciones legales o proteger los derechos del Club San Lorenzo Rauch.</p>

            <h2>6. Retención de Datos</h2>
            <p>Los datos personales se conservarán solo durante el tiempo necesario para cumplir con las finalidades descritas en esta política, a menos que la ley exija o permita un período de retención más largo.</p>

            <h2>7. Derechos de los Usuarios</h2>
            <p>Los administradores tienen derecho a acceder, rectificar, cancelar u oponerse al tratamiento de sus datos personales. Para ejercer estos derechos, pueden ponerse en contacto con nosotros a través de los medios establecidos en la plataforma.</p>

            <h2>8. Cambios en la Política de Privacidad</h2>
            <p>Nos reservamos el derecho de actualizar esta política de privacidad en cualquier momento. Cualquier cambio será notificado a los administradores a través de la plataforma.</p>

        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    
    
@endpush
