@extends('layouts.main')

@section('content')

<div class="row row-cols-1 row-cols-md-3 row-cols-xl-5">
    <div class="col">
        <div class="card radius-10 border-start border-4 border-secondary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total saisies</p>
                        <h4 class="my-1 text-secondary">{{ count($userData['myAllContrats']) }}</h4>
                        <p class="mb-0 font-13">+{{ count($userData['myContratsMonth']) }} Mois en cours</p>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-secondary text-white ms-auto"><i
                            class='bx bxs-cart'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-start border-4 border-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">En saisie</p>
                        <h4 class="my-1 text-info">{{ count($userData['myAllContratEnSaisie']) }}</h4>
                        <p class="mb-0 font-13">+{{ count($userData['myAllContratEnSaisieMonth']) }} Mois en cours</p>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                            class='bx bxs-wallet'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col">
        <div class="card radius-10 border-start border-4 border-warning">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Transmises</p>
                        <h4 class="my-1 text-warning">{{ count($userData['myAllContratTransmis']) }}</h4>
                        <p class="mb-0 font-13">+{{ count($userData['myAllContratTransmisMonth']) }} Mois en cours</p>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
                            class='bx bxs-group'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-start border-4 border-success">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Acceptées/Migrées</p>
                        <h4 class="my-1 text-success">{{ count($userData['myAllContratMigrer']) }}</h4>
                        <p class="mb-0 font-13">+ {{ count($userData['myAllContratMigrerMonth']) }} Mois en cours</p>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                            class='bx bxs-bar-chart-alt-2'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-start border-4 border-danger">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total rejetées</p>
                        <h4 class="my-1 text-danger">{{ count($userData['myAllContratRejetter']) }}</h4>
                        <p class="mb-0 font-13">+{{ count($userData['myAllContratRejetterMonth']) }} Mois en cours</p>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                            class='bx bxs-group'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end row-->

{{-- calcule production par mois sur une anner  & repartition des prime par produit anner en cours --}}

<div class="row">
    <div class="col-12 col-lg-8 d-flex">
        <div class="card radius-10 w-100">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Etat de souscription annuel</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                                class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                        </a>
                        <ul class="dropdown-menu">
                           
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3">
                    <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                            style="color: #14abef"></i>Transmises</span>
                    <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                            style="color: #ffc107"></i>Acceptées</span>
                </div>
                <div class="chart-container-1">
                    <canvas id="chartDash"></canvas>
                </div>
                
            </div>

            <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                <div class="col">
                    <div class="p-3">
                        <h5 class="mb-0">{{ count($userData['contratsAnnuel']) }}</h5>
                        <small class="mb-0">Année en cours <span></small>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3">
                        <h5 class="mb-0">{{ number_format($userData['tauxAcceptation'], 2) }} %</h5>
                        <small class="mb-0">Taux d'acceptation </small>
                    </div>
                </div>
                <div class="col">
                    <div class="p-3">
                        <h5 class="mb-0">{{ $userData['totalRejetPerYears'] }}</h5>
                        <small class="mb-0">Rejets/ année en cours </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4 d-flex">
        <div class="card radius-10 w-100">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Répartition des productions par Produit</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                            class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="donutChart"></canvas>
            </div>
        </div>
    </div>
</div>
<!--end row-->


<div class="card radius-10">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <div>
                <h6 class="mb-0">Saisies du jour</h6>
            </div>
            <div class="dropdown ms-auto">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                        class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                </a>

            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Code </th>
                        <th>Organisme</th>
                        <th>Partenaire</th>
                        <th>Statut</th>
                        <th>Produit</th>
                        <th>Date de saisie</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userData['myDayContrats'] as $item)
                    <tr>
                        <td>#{{ $item->id ?? "--"}}</td>
                        <td>{{ $item->organisme ?? "--" }}</td>
                        <td>{{ $item->partenaire ?? "--" }}</td>
                        <td>
                            @if($item->etape == 1)
                                <span class="badge bg-info text-white shadow-sm w-100">En Saisie</span>
                            @elseif($item->etape == 2)
                                <span class="badge bg-warning text-white shadow-sm w-100">En attente de validation</span>
                            @elseif($item->etape == 3)
                                <span class="badge bg-success text-white shadow-sm w-100">Accepté & migré</span>
                            @elseif($item->etape == 4)
                                <span class="badge bg-danger text-white shadow-sm w-100">Refusé</span>
                            @else
                                <span class="badge bg-secondary text-white shadow-sm w-100">{{ $item->etape }}</span>
                            @endif
                        </td>
                        <td>{{ $item->libelleproduit ?? "--" }}</td>
                        <td>{{ $item->saisiele ?? "--" }}</td>
                        <td>
                            <i><a href="{{ route('prod.show', $item->id) }}" class="btn btn-sm btn-primary"><i class="bx bx-show"></i></a></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Data Transmis:', @json($dataTransmis));
        console.log('Data Migrer:', @json($dataMigrer));

        var dataTransmisArray = Object.values(@json($dataTransmis));
        var dataMigrerArray = Object.values(@json($dataMigrer));

        var ctx = document.getElementById("chartDash").getContext('2d');

        var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
        gradientStroke1.addColorStop(0, '#6078ea');
        gradientStroke1.addColorStop(1, '#17c5ea');

        var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
        gradientStroke2.addColorStop(0, '#ff8359');
        gradientStroke2.addColorStop(1, '#ffdf40');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Transmis',
                    data: dataTransmisArray,
                    borderColor: gradientStroke1,
                    backgroundColor: gradientStroke1,
                    hoverBackgroundColor: gradientStroke1,
                    borderWidth: 0,
                    borderRadius: 20,
                }, {
                    label: 'Migré',
                    data: dataMigrerArray,
                    borderColor: gradientStroke2,
                    backgroundColor: gradientStroke2,
                    hoverBackgroundColor: gradientStroke2,
                    borderWidth: 0,
                    borderRadius: 20,
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('donutChart').getContext('2d');
        const validLabels = @json($productLabels).filter(label => label !== null);
        const validData = @json($productData).filter(data => data !== null);

        console.log('Filtered Labels:', validLabels);
        console.log('Filtered Data:', validData);

        const donutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: validLabels,
                datasets: [{
                    label: 'Montant des primes (FCFA)',
                    data: validData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                        'rgba(255, 99, 132, 0.4)', 
                        'rgba(54, 162, 235, 0.4)', 
                        'rgba(153, 102, 255, 0.4)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(201, 203, 207, 1)', 
                        'rgba(255, 99, 132, 1)',  
                        'rgba(54, 162, 235, 1)',  
                        'rgba(153, 102, 255, 1)'  
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: false,
                        text: 'Répartition des primes par produit'
                    }
                }
            }
        });
    });
</script>
@endsection
