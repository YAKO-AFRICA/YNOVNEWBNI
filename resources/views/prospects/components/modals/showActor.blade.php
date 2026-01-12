<!-- Modal -->
<div class="modal fade" id="bruceModal{{ $partner->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $partner->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel{{ $partner->id }}">Details du partenaire {{ $partner->code ?? ''}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm mb-0">
                        <tbody>
                            <tr>
                                <th>Code</th>
                                <td>{{ $partner->code }}</td>
                            </tr>
                            <tr>
                                <th>Genre</th>
                                <td>{{ $partner->genre }}</td>
                            </tr>
                            <tr>
                                <th>Civilité</th>
                                <td>{{ $partner->civilite }}</td>
                            </tr>
                            <tr>
                                <th>Nature de pièce</th>
                                <td>{{ $partner->naturepiece }}</td>
                            </tr>
                            <tr>
                                <th>Numéro de pièce</th>
                                <td>{{ $partner->numeropiece }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $partner->email }}</td>
                            </tr>
                            <tr>
                                <th>Situation matrimoniale</th>
                                <td>{{ $partner->situationMatrimoniale }}</td>
                            </tr>
                            <tr>
                                <th>Date de naissance</th>
                                <td>{{ \Carbon\Carbon::parse($partner->dateNaissance)->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <th>Lieu de naissance</th>
                                <td>{{ $partner->lieuNaissance }}</td>
                            </tr>
                            <tr>
                                <th>Lieu de résidence</th>
                                <td>{{ $partner->lieuResidence }}</td>
                            </tr>
                            <tr>
                                <th>Adresse complète</th>
                                <td>{{ $partner->adresseComplete }}</td>
                            </tr>
                            <tr>
                                <th>Profession</th>
                                <td>{{ $partner->profession }}</td>
                            </tr>
                            <tr>
                                <th>Employeur</th>
                                <td>{{ $partner->employeur }}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>{{ $partner->mobile }}</td>
                            </tr>
                            <tr>
                                <th>Filiation</th>
                                <td>{{ $partner->filliation_code }}</td>
                            </tr>
                            <tr>
                                <th>Code partenaire</th>
                                <td>{{ $partner->code_partner }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
