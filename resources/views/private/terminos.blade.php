@extends('template')
@section('titulo', 'Términos y Condiciones')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    @endpush
@section('contenido')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Términos y condiciones</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('panel') }} ">Panel</a></li>
        </ol>
        <div>
            <h2>1. Introducción</h2>
            <p>Bienvenido a la página de alquileres del Club San Lorenzo Rauch. Esta plataforma ha sido creada para ser utilizada exclusivamente por administradores autorizados. Las principales funciones del sitio incluyen la alta, baja y modificaciones (ABM) de alquileres, clientes, servicios, turnos, productos, descuentos, depósitos y métodos de pago.</p>

            <h2>2. Participación de Estudiantes</h2>
            <p>Esta plataforma fue desarrollada por la primera camada de la carrera de Tecnicatura en Análisis de Sistemas del cohorte 2021. Los integrantes del equipo fueron Facundo Tellechea, Dario Carsaniga, Ayrton Mobilio y Verónica Olate, bajo la supervisión de Sebastián Esains. El proyecto se desarrolló como parte de una práctica profesional para finalizar los estudios y aprobar la materia Prácticas Profesionales 3 en el Instituto Superior de Formación Docente y Técnica N° 70 de Rauch.</p>

            <h2>3. Responsabilidad</h2>
            <p>Los alumnos que participaron en el desarrollo de la primera versión de esta plataforma no son responsables de la pérdida de datos o de la manipulación que se realice posterior a la versión 1.95.105. La responsabilidad de la integridad y el uso de los datos recae exclusivamente en los administradores autorizados del Club San Lorenzo Rauch.</p>

            <h2>4. Uso de la Plataforma</h2>
            <p>Los administradores se comprometen a utilizar la plataforma de manera responsable y ética, asegurando la veracidad y precisión de los datos ingresados y modificados. El uso indebido de la plataforma puede resultar en sanciones o la revocación de los permisos de acceso.</p>

            <h2>5. Modificaciones de los Términos y Condiciones</h2>
            <p>Nos reservamos el derecho de actualizar estos términos y condiciones en cualquier momento. Cualquier cambio será notificado a los administradores a través de la plataforma.</p>

        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    
    
@endpush
