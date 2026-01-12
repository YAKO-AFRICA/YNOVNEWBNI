@extends('layouts.main')

@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">
            <a href="/shared/home"><i class="bx bx-home-alt"></i></a>
        </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active">Settings</li>
                    <li class="breadcrumb-item active">Groupe de notifier</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="javascript:;" class="btn btn-primary radius-30" data-bs-toggle="modal" data-bs-target="#addNewGroup">
                <i class="bx bxs-plus-square"></i> Ajouter un groupe
            </a>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <!-- Liste des groupes -->
            <h5 class="mb-3">Groupes de notification</h5>
            <div class="table-responsive mb-4">
                <table class="table table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Libellé</th>
                            <th>Branche</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($notifgroups as $notifgroup)
                            <tr>
                                <td>{{ $notifgroup->id }}</td>
                                <td>{{ $notifgroup->code_group ?? '' }}</td>
                                <td>{{ $notifgroup->name ?? '' }}</td>
                                <td>{{ $notifgroup->branche ?? '' }}</td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="javascript:;" 
                                           class="text-danger deleteConfirmation" 
                                           data-uuid="{{ $notifgroup->id }}"
                                           data-token="{{ csrf_token() }}"
                                           data-title="Vous êtes sur le point de supprimer {{ $notifgroup->name }}">
                                           <i class='bx bxs-trash' style="cursor:pointer"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucun groupe trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Liste des membres et leur groupe -->
            <h5 class="mb-3">Membres et groupes associés</h5>
            <div class="table-responsive mb-4">
                <table class="table table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nom complet</th>
                            <th>Email</th>
                            <th>Partenaire</th>
                            <th>Groupe</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usersList as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->membre->nom ?? '-' }} {{ $user->membre->prenom ?? '-' }}</td>
                                <td>{{ $user->membre->email ?? '-' }}</td>
                                <td>{{ $user->membre->partenaire ?? '-' }}</td>
                                <td>{{ $user->groupNotif->name ?? 'Aucun groupe' }}</td>
                                <td>
                                    <a href="javascript:;" 
                                    class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editUserGroup{{ $user->id }}">
                                    <i class="bx bx-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @include('settings.notifgroup.editGroupModal', ['user' => $user])
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $usersList->links() }}
            </div>


        </div>
    </div>
</div>

@include('settings.notifgroup.addGroupModal')
@endsection
