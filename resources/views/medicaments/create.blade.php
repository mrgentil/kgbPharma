@extends('layouts.main')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">AJouter un médicament</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Nouveau Médicament</h4>
                            </div>
                            <div class="card-body">
                                @include('medicaments.form', [
                                    'action' => route('medicaments.store'),
                                    'method' => 'POST',
                                    'medicament' => null,
                                    'suppliers' => $suppliers,
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
