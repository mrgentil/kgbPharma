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
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <script>
        const scannerContainer = document.getElementById('scanner');
        const btnScan = document.getElementById('btn-scan');
        const inputCode = document.getElementById('code_barre');

        let scanning = false;

        btnScan.addEventListener('click', () => {
            if (!scanning) {
                scanning = true;
                scannerContainer.style.display = 'block';

                Quagga.init({
                    inputStream: {
                        name: "Live",
                        type: "LiveStream",
                        target: scannerContainer,
                        constraints: {
                            facingMode: "environment" // ou "user" pour caméra frontale
                        }
                    },
                    decoder: {
                        readers: ["ean_reader", "code_128_reader", "upc_reader"]
                    }
                }, err => {
                    if (err) return console.error(err);
                    Quagga.start();
                });

                Quagga.onDetected(result => {
                    inputCode.value = result.codeResult.code;
                    Quagga.stop();
                    scanning = false;
                    scannerContainer.style.display = 'none';
                });
            } else {
                Quagga.stop();
                scanning = false;
                scannerContainer.style.display = 'none';
            }
        });
    </script>
@endpush

