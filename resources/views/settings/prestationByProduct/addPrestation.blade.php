@extends('layouts.main')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3"><a href="/shared/home"><i class="bx bx-home-alt"></i></a></div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Produits & Prestations</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                </div>
            </div>
        </div>
        <!--end breadcrumb-->


        <div class="card">
            <div class="card-body">
                <form action="{{ route('setting.prestation_product.store') }}" method="POST" class="submitForm">
                    @csrf
                    <fieldset class="border p-3">
                        <legend class="float-none w-auto px-2">
                            <small><h5 class="mb-4">Produits Concernés : {{$product->MonLibelle}}</h5></small>
                        </legend>
                
                        <input type="hidden" name="codeproduit" id="codeproduit" value="{{ $codeProduit }}">
                
                        <div class="mb-4">
                            <label class="form-label" for="product_type">Type de Produit:</label>
                            <select name="product_type" class="form-select" id="product_type" required>
                                <option value="" selected>-- Choisir une option --</option>
                                <option value="Epargne">Epargne</option>
                                <option value="Obsèque">Obsèque</option>
                            </select>
                        </div>
                
                        <div class="mb-3">
                            <div class="row mb-3">
                                <div class="col-md-12 text-end">
                                    <button type="button" class="btn btn-primary" onclick="addPrestation()">Ajouter une prestation</button>
                                </div>
                            </div>
                
                            <div id="prestationsContainer">
                                <div class="row mb-3 prestation-item">
                                    <label for=""> Type de Prestation possibles</label>
                                    <div class="input-group">
                                        <select name="prestations[]" class="form-select" required>
                                            <option value="" selected>Choisir une prestation associée</option>
                                            @foreach ($typeprestations as $prest)
                                                <option value="{{ $prest->id }}">{{ $prest->libelle }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-danger" onclick="deletePrestation(event)">
                                            <i class="bx bxs-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <a href="{{ route('setting.prestation_product.index') }}" class="btn">Retour</a>
                        </div>
                        <div class="col-md-6 text-end">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
    
    <script>
        function addPrestation() {
            const container = document.getElementById('prestationsContainer');
            const template = document.querySelector('.prestation-item');
            const newItem = template.cloneNode(true);
            
            // Réinitialiser la valeur du select cloné
            newItem.querySelector('select').selectedIndex = 0;
            
            // Ajouter un bouton de suppression si absent
            if (!newItem.querySelector('button')) {
                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.className = 'btn btn-danger';
                deleteButton.innerHTML = '<i class="bx bxs-trash"></i>';
                deleteButton.onclick = deletePrestation;
                newItem.querySelector('.input-group').appendChild(deleteButton);
            }
            
            container.appendChild(newItem);
        }
    
        function deletePrestation(event) {
            const button = event.target.closest('button');
            const item = button.closest('.prestation-item');
            if (document.querySelectorAll('.prestation-item').length > 1) {
                item.remove();
            }
        }
    </script>

    
    
    
    
    
@endsection

{{-- <div class="col-1 delete-document">
    <button type="button" class="btn btn-secondary bg-light border-0 delete-document-button" onclick="deleteDocExpedition(this)"><i class="bx bx-trash text-secondary"></i></button>
</div> --}}
