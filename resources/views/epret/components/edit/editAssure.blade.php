{{-- <form action="" method="post"> --}}

    <div style="font-size: 12px !important">

        <h5 class="mb-1">Informations sur les assuré(e) </h5>

    

        <div class="row g-3 mb-3">

            

            <div class="col-12 col-lg-6 d-flex justify-content-end align-items-end">


            </div>

        </div>

        

        <table class="table mb-0 table-striped" style="font-size: 12px !important">

            <thead>

                <tr>

                    <th scope="col">Assuré(e)</th>

                    <th scope="col">Garanties</th>

                    <th scope="col">Garanties complementaires</th>

                    <th scope="col">Action</th>

                </tr>

            </thead>


            <tbody>

                @if ($pret->assures->count() > 0)

                @foreach ($pret->assures as $assure)

                <tr>

                    <td>{{ $assure->nom ?? '-'}} {{ $assure->prenom ?? '-'}}</td>

                    <td>

                        <ul>
                            @forelse ($productGarantie as $item)
                                <li>{{ $item->MonLibelle }}</li>
                            @empty
                                <center>Pas de garantie</center>
                            @endforelse
                        </ul>
                    </td>

                    <td><center>Pas de garantie</center></td>

                    <td style="font-size: 10px !important">

                        <a class="border-0 btn bg-none p-0" href="" data-bs-target="#showAssureModal{{ $assure->id }}" data-bs-toggle="modal"><i class="fadeIn animated bx bx-show mx-auto"></i></a>

                        <a class="mx-2 border-0 btn p-0" href="" data-bs-target="#editAssureModal{{ $assure->id }}" data-bs-toggle="modal"><i class="fadeIn animated bx bx-edit  mx-auto"></i></a>

                        <a class="deleteConfirmation btn border-0 p-0" data-uuid="{{ $assure->id }}"

                            data-type="confirmation_redirect" data-placement="top"

                            data-token="{{ csrf_token() }}" data-url="{{ route('prod.delete.assure', $assure->id) }}"

                            data-title="Vous êtes sur le point de supprimer {{ $assure->nom }} {{ $assure->prenom }}"

                            data-id="{{ $assure->id }}" data-param="0"

                            data-route="{{ route('prod.delete.assure', $assure->id) }}">

                            <i class='bx bxs-trash mx-auto'></i>

                            </a>

                    </td>

                </tr>
                    @include('productions.assurer.show')
                    @include('productions.assurer.update')
                    

                @endforeach

                @endif

                

            </tbody>

            

        </table>
       

    </div>

{{-- </form> --}}