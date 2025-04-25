@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
    /* Estilo general para las tablas */
    .table-wrapper {
        max-height: 400px;
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
            </ul>

            <div class="tab-content mt-3">
                <!-- Tab para Cocteles Favoritos -->
                <div class="tab-pane fade show active" id="favoritos" role="tabpanel" aria-labelledby="favoritos-tab">
                    <div class="card">
                        <div class="card-header">
                            Cocteles Favoritos
                        </div>
                        <div class="card-body">
                            <div class="table-wrapper">
                                <table id="coctelesFavoritosList" class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col"># ID</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Instrucciones</th>
                                            <th scope="col">Ingredientes</th>
                                            <th scope="col">Acciones</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Los cocteles favoritos se cargarán dinámicamente aquí -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Editar Cóctel -->
<div class="modal fade" id="modalEditarCoctel" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="formEditarCoctel">
        <input type="hidden" id="idLine" name="idLine" value="">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditarLabel">Editar Cóctel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editarId">

          <div class="mb-3">
            <label for="editarNombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="editarNombre" required>
          </div>

          <div class="mb-3">
            <label for="editarInstrucciones" class="form-label">Instrucciones</label>
            <textarea class="form-control" id="editarInstrucciones" rows="3" required></textarea>
          </div>

          <div class="mb-3">
            <label for="editarIngredientes" class="form-label">Ingredientes (nombre y medida separados por coma, uno por línea)</label>
            <textarea class="form-control" id="editarIngredientes" rows="4" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
@vite('resources/js/cocteles/listCoctelesFavoritos.js')