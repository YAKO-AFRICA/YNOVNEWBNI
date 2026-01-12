<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/img/images/favicon_yako.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    {{-- <!-- loader-->
	<link href="cust_assets/css/pace.min.css" rel="stylesheet" />
	<script src="cust_assets/js/pace.min.js"></script> --}}
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>Information prestation || Yako Africa Assurances Vie</title>

</head>

<body class="m-5">

    <!-- loader-->
    <div id="preloader">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon"><img src="{{ asset('root/images/logo.png') }}" alt="Preloader"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="fm-menu">
                        <div class="list-group list-group-flush">
                            <a href="javascript:;" class="list-group-item py-1" data-target="info-contrat">
                                <i class='bx bx-folder me-2'></i><span>Detail sur la prestation</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="fm-menu">
                        <div class="list-group list-group-flush mb-3">
                            <span>Status de la prestation</span>
                        </div>
                        @if ($prestation->etape == 0)
                            <div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3">
                                <i class="bx bxs-circle me-1"></i>En attente de transmission
                            </div>
                        @elseif($prestation->etape == 1)
                            <div class="badge rounded-pill text-primary bg-light-primary p-2 text-uppercase px-3">
                                <i class="bx bxs-circle me-1"></i>Demande transmise
                            </div>
                        @elseif($prestation->etape == 2)
                            <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                <i class="bx bxs-circle me-1"></i>Demande acceptée
                            </div>
                        @elseif($prestation->etape == 3)
                            <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                <i class="bx bxs-circle me-1"></i>Demande rejétée
                            </div>
                        @else
                            -
                        @endif

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body bg-light-success">
                    <h5 class="mb-0 text-primary font-weight-bold">Documents joint </h5>
                    </p>
                    <div class="mt-3"></div>
                    @forelse ($prestation->docPrestation->where('idPrestation', $prestation->id) as $doc)
					<div class="d-flex align-items-center mt-3">
						<div class="fm-file-box text-success"><i class='bx bxs-file-doc'></i>
						</div>
						<div class="flex-grow-1 ms-2">
							<h6 class="mb-0" style="font-size: 10px">
								{{ $doc->type == 'Police'
									? "Police du contrat d'assurance"
									: ($doc->type == 'bulletin'
										? "Bulletin du contrat d'assurance"
										: ($doc->type == 'RIB'
											? 'RIB du compte courant'
											: ($doc->type == 'CNI'
												? 'CNI'
												: ($doc->type == 'FicheIDNum'
													? 'Fiche ID numéro'
													: ($doc->type == 'AttestationPerteContrat'
														? 'Attestation de perte de contrat'
														: ($doc->type == 'etatPrestation'
															? 'Fiche de la prestation'
															: '')))))) }}
							</h6>
							<p class="mb-0 text-secondary" style="font-size: 0.6em">
								{{ $doc->created_at ?? '' }}
							</p>
						</div>
						<h6 class="text-primary mb-0 text-center">
							<a class="btn btn-primary px-2" data-bs-target="#view-bulletin{{ $doc->id }}"
								data-bs-toggle="modal" title="Preview">
								<i class="bx bx-show"></i>
							</a>
						</h6>
						<div class="modal fade" id="view-bulletin{{ $doc->id }}" tabindex="-1" role="dialog"
							aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Preview
											{{ $doc->type == 'Police'
												? "Police du contrat d'assurance"
												: ($doc->type == 'bulletin'
													? "Bulletin du contrat d'assurance"
													: ($doc->type == 'RIB'
														? 'RIB du compte courant'
														: ($doc->type == 'CNI'
															? 'CNI'
															: ($doc->type == 'FicheIDNum'
																? 'Fiche ID numéro'
																: ($doc->type == 'AttestationPerteContrat'
																	? 'Attestation de perte de contrat'
																	: ($doc->type == 'etatPrestation'
																		? 'Fiche de la prestation'
																		: '')))))) }}
										</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body" style="width: 100%; height: 80vh">
										@if ($doc->type == 'etatPrestation')
											<iframe style="width: 100%; height: 100%" src="{{ asset($doc->path) }}"
												frameborder="0"></iframe>
										@else
											<iframe style="width: 100%; height: 100%" src="{{ asset($doc->path) }}"
												frameborder="0"></iframe>
										@endif
									</div>
									<div class="modal-footer">
										@if ($doc->type == 'etatPrestation')
											<a class="btn btn-primary text-white" href="{{ asset($doc->path) }}"
												id="download-bulletin" title="Preview" download
												>Telecharger
												<i class="bx bx-download"></i>
											</a>
										@else
											<a class="btn btn-primary text-white" href="{{ asset($doc->path) }}"
												id="download-bulletin" title="Preview" download
												>Telecharger
												<i class="bx bx-download"></i>
											</a>
										@endif

										<button type="button" class="btn btn-primary"
											data-bs-dismiss="modal">Fermer</button>
									</div>
								</div>
							</div>
						</div>
					</div>
                    @empty
                        <p class="text-secondary">Aucun document joint</p>
                    @endforelse


                </div>
            </div>
        </div>
        <div class="col-12 col-lg-9">
            <div class="card">
                <div class="card-body">
                    <section id="info-contrat" class="section-content">
                        @if ($prestation->membre !== null && $prestation->membre->typ_membre !== 3)
                            <div class="row">
                                <div class="col-12">
                                    <div class="card bg-light-success">
                                        <div class="card-body">
                                            <div class="mt-4 row">
                                                <dl class="row col-md-6">
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Saisie par :</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                        {{ $prestation->membre->prenom ?? '' }}
                                                        {{ $prestation->membre->nom ?? '' }} </dd>
                                                </dl>
                                                <dl class="row col-md-6">

                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="card" style="width: 90%">
                                    <div class="card-body bg-light-success">
                                        <h3>Prestation</h3>
                                        <div class="mt-4">
                                            <dl class="row">
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Type de prestation:
                                                </dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                    {{ $prestation->typeprestation ?? 'Non renseigné' }} </dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">ID du contrat :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                    {{ $prestation->idcontrat ?? 'Non renseigné' }} </dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Montant souhaité :
                                                </dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                    {{ $prestation->montantSouhaite ?? 'Non renseigné' }} FCFA</dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Moyen de paiement :
                                                </dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                    {{ $prestation->moyenPaiement == 'Virement_Bancaire' ? 'Virement Bancaire' : 'Mobile Money' ?? 'Non renseigné' }}
                                                </dd>
                                                @if ($prestation->moyenPaiement == 'Mobile_Money')
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Opérateur :</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $prestation->Operateur == 'Orange_money'
                                                            ? 'Orange Money'
                                                            : ($prestation->Operateur == 'MTN_Money'
                                                                    ? 'MTN Money'
                                                                    : ($prestation->Operateur == 'Moov_Money'
                                                                        ? 'Moov Money'
                                                                        : 'Non renseigné')) ?? 'Non renseigné' }}
                                                    </dd>
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Numéro de paiement
                                                        :</dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $prestation->telPaiement ?? 'Non renseigné' }} </dd>
                                                @elseif($prestation->moyenPaiement == 'Virement_Bancaire')
                                                    <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">IBAN du compte :
                                                    </dt>
                                                    <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        {{ $prestation->IBAN ?? 'Non renseigné' }} </dd>
                                                @endif
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-7">Date de demande :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                    {{ $prestation->created_at->format('d-m-Y à H:i') ?? 'Non renseigné' }}
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body bg-light-success">
                                        <h3>Client</h3>
                                        <div class="mt-4">
                                            <dl class="row">
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Nom :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                    {{ $prestation->membreClient->nom ?? ($prestation->nom ?? 'Non renseigné') }}
                                                </dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Prénom :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                    {{ $prestation->membreClient->prenom ?? ($prestation->prenom ?? 'Non renseigné') }}
                                                </dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Date de naissance:
                                                </dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                    {{ $prestation->membreClient->datenaissance ?? ($prestation->datenaissance ?? 'Non renseigné') }}
                                                </dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Sexe :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                    {{ $prestation->membreClient->sexe ?? ($prestation->sexe ?? 'Non renseigné') }}
                                                </dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Teléphone :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                    {{ $prestation->membreClient->cel ?? ($prestation->cel ?? 'Non renseigné') }}
                                                </dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Email :</dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                    {{ $prestation->membreClient->email ?? ($prestation->email ?? 'Non renseigné') }}
                                                </dd>
                                                <dt class="col-xs-12 col-sm-6 col-md-5 col-lg-5">Lieu de residence:
                                                </dt>
                                                <dd class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                                                    {{ $prestation->membreClient->lieuresidence ?? ($prestation->lieuresidence ?? 'Non renseigné') }}
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </section>
            </div>
        </div>
    </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
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
</body>

</html>
