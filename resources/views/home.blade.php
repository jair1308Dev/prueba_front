@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
  #coctelesList {
    width: 100%;
    border-collapse: collapse;
  }

  #coctelesList thead th {
    position: sticky;
    top: 0;
    background-color: #f8f8f8;
    z-index: 1;
  }

  .table-wrapper {
    max-height: 400px;
    overflow-y: auto;
    display: block;
  }

  .table-wrapper table {
    width: 100%;
  }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Cocteles
                </div>
                <input type="text" id="buscador" class="form-control mb-3" placeholder="Buscar por ID o Nombre...">

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
@endsection
@vite('resources/js/cocteles/coctelesFavoritos.js')
