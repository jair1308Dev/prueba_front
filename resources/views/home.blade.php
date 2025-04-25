@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
    /* Estilo general para las tablas */
    .table-wrapper {
        max-height: 500px;
        overflow-y: auto;
        display: block;
    }

    .table-wrapper table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-wrapper table th,
    .table-wrapper table td {
        padding: 12px 15px;
        text-align: left;
    }

    .table-wrapper table thead th {
        background-color: #f8f8f8;
        position: sticky;
        top: 0;
        z-index: 2;
    }

    .table-wrapper table tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .table-wrapper table tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Ajustes para los tabs */
    .nav-tabs {
        margin-bottom: 20px;
    }

    .nav-tabs .nav-link {
        border-radius: 0;
    }

    .nav-link.active {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    /* Estilo para el formulario en el tab de agregar favoritos */
    #agregarCoctelForm {
        margin-bottom: 20px;
    }

    /* Estilo del modal */
    .modal-content {
        background-color: #fff;
        padding: 20px;
    }

    .modal-header {
        border-bottom: none;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Navegación de Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="favoritos-tab" data-bs-toggle="tab" href="#favoritos" role="tab"
                        aria-controls="favoritos" aria-selected="true">Cocteles</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ route('favoritos') }}" role="tab"  aria-selected="true">Cocteles favoritos</a>
                </li>
            </ul>

            <div class="tab-content mt-3">
                <!-- Tab de Cocteles -->
                <div class="tab-pane fade show active" id="favoritos" role="tabpanel" aria-labelledby="favoritos-tab">
                    <div class="card">
                        <input type="text" id="buscador" class="form-control mb-3"
                            placeholder="Buscar por ID o Nombre...">

                        <div class="card-body">
                            <div class="table-wrapper">
                                <table id="coctelesList" class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col"># ID</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detalleModal" tabindex="-1" aria-labelledby="detalleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detalleModalLabel">Detalle del Cóctel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body" id="detalleModalBody">
                Cargando detalle...
            </div>
        </div>
    </div>
</div>
@endsection
@vite('resources/js/cocteles/coctelesFavoritos.js')
