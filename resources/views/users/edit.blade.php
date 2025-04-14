@extends('layouts.main')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Modifier l'utilisateur</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Modification</h4>
                            </div>
                            <div class="card-body">
                                @include('users.form', [
                                    'action' => route('users.update', $user->id),
                                    'method' => 'PUT',
                                    'user' => $user, // On passe l'utilisateur à éditer
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
