@extends('layouts.main')

@section('content')



<!--breadcrumb-->

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

    <div class="breadcrumb-title pe-3">eSouscription</div>

    <div class="ps-3">

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb mb-0 p-0">

                <li class="breadcrumb-item"><a href="javascript:;">
                        <i class="bx bx-home-alt"></i></a>
                </li>

                <li class="breadcrumb-item active" aria-current="page">Modifier une proposition</li>

            </ol>

        </nav>

    </div>

    <div class="ms-auto gx-3">
        <div class="btn-group">

            <button class="btn btn-primary mx-4 border-0 text-center" style="font-size: 12px">
                <a class="text-decoration-none"
                    href="{{ route('prod.generate.bulletin', $contrat->id) }}"
                    target="_blank">
                    <i class="bx bx-download" title="Telecharger le bulletin"></i> Print Bulletin
                </a>
            </button>

        </div>
    </div>

</div>

<!--end breadcrumb-->

<div class="row">

    <div class="col-12 col-lg-3">

        <div class="card">

            <center>
                <div class="card-header">
                    <p>
                        <strong>N° de contrat :</strong>
                        <span>{{ $contrat->id ?? '' }}</span>
                    </p>
                    <p>
                        <strong>N° bullettin :</strong>
                        <span>{{ $contrat->numBullettin ?? '' }}</span>
                    </p>
                    <p>
                        <center>Status :
                            @if($contrat->etape == 0)
                                <span class="text-secondary badge rounded-pill  bg-light-secondary">Brouillon</span>
                            @elseif($contrat->etape == 1)
                                <span class="text-info badge rounded-pill  bg-light-info">Saisie Non Transmis</span>
                            @elseif($contrat->etape == 2)
                                <span class="text-primary badge rounded-pill  bg-light-primary">Saisie Transmis</span>
                            @elseif($contrat->etape == 3)
                                <span class="text-success badge rounded-pill text-success bg-light-success">Accepté et
                                    Migré</span>
                            @elseif($contrat->etape == 4)
                                <span class="text-danger badge rounded-pill bg-light-danger">Rejeté</span>
                            @endif
                        </center>
                    </p>
                </div>
            </center>

            <div class="card-body">

                <h5 class="my-3 text-center text-uppercase">Modifier les acteurs</h5>

                <div class="fm-menu">

                    <div class="list-group list-group-flush">

                        <a href="javascript:;" class="list-group-item py-1 btn border-0" data-target="info-contrat">

                            <i class='bx bx-folder me-2'></i><span>Detail du contrat</span>

                        </a>

                        <a href="javascript:;" class="list-group-item py-2 btn border-0" data-target="edit-adherent">

                            <i class='bx bx-devices me-2'></i><span>Adherent</span>

                        </a>

                        <a href="javascript:;" class="list-group-item py-2 muted  btn border-0" data-target="edit-assurer" disabled>

                            <i class='bx bx-analyse me-2'></i><span>Assurés</span>

                        </a>

                        <a href="javascript:;" class="list-group-item py-1 btn muted" data-target="edit-beneficiaire" disabled>

                            <i class='bx bx-plug me-2'></i><span>Beneficiaire</span>

                        </a>

                        {{-- <a href="javascript:;" class="list-group-item py-1" data-target="edit-info">

                            <i class='bx bx-analyse me-2'></i><span>Informations</span>

                        </a> --}}

                    </div>

                </div>

            </div>

        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="mb-0 font-weight-bold">Documents joint <span data-bs-toggle="modal" data-bs-target="#add-doc"
                        class="float-end text-secondary"> <i class="bx bx-add-to-queue"></i> </span></h5>
                </p>
                <div class="mt-3"></div>

                @if(count($contrat->documents) > 0)
                    @foreach($contrat->documents as $doc)
                        <div class="d-flex align-items-center mt-3">
                            <div class="fm-file-box bg-light-success text-success"><i class='bx bxs-file-doc'></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0" style="font-size: 10px">
                                    {{ $doc->libelle ?? '' }}</h6>
                                <p class="mb-0 text-secondary">
                                    {{ $doc->saisiele ?? '' }}
                                </p>
                            </div>
                            <h6 class="text-primary mb-0">
                                <a class="btn btn-sm btn-outline-secondary"
                                    data-bs-target="#view-bulletin{{ $doc->id }}" data-bs-toggle="modal"
                                    title="Preview">
                                    <i class="bx bx-show"></i>
                                </a>
                                {{-- <a class="btn btn-sm btn-outline-secondary" href=""> <i class="bx bx-trash"></i></a> --}}
                            </h6>



                            <div class="modal fade" id="view-bulletin{{ $doc->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <h5 class="modal-title" id="exampleModalLabel">Aperçu
                                                {{ $doc->libelle ?? '' }}</h5>

                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="x">x</button>

                                        </div>

                                        <div class="modal-body" style="width: 100%; height: 80vh">
                                            <iframe style="width: 100%; height: 100%"
                                                src="{{ url('storage/documents/' . $doc->filename) }}"
                                                frameborder="0"></iframe>

                                        </div>

                                        <div class="modal-footer">

                                            <form
                                                action="{{ route('prod.destroy.document', $doc->id) }}"
                                                method="post" class="submitForm">
                                                @csrf

                                                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Supprimer
                                                </button>
                                            </form>


                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Fermer</button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                @else
                @endif

            </div>

        </div>

    </div>

    <div class="col-12 col-lg-9">

        <div class="card">

            <div class="card-body">

                <section id="info-contrat" class="section-content">

                    <h5>Modifier les Détails du Contrat</h5>

                    @include('productions.components.editContrat')

                </section>

                <section id="edit-adherent" class="section-content d-none">

                    <h5>Adhérent</h5>

                    @include('productions.components.editAdherent')

                </section>

                



            </div>

        </div>

    </div>



    @include('productions.components.addDoc')



    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const links = document.querySelectorAll('.list-group-item');

            const sections = document.querySelectorAll('.section-content');



            links.forEach(link => {

                link.addEventListener('click', () => {

                    const targetId = link.getAttribute('data-target');



                    // Masquer toutes les sections

                    sections.forEach(section => section.classList.add('d-none'));



                    // Afficher la section correspondante

                    const targetSection = document.getElementById(targetId);

                    if (targetSection) {

                        targetSection.classList.remove('d-none');

                    }

                });

            });

        });

    </script>



</div>

<!--end row-->



@endsection
