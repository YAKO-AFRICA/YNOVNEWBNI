@
@extends('layouts.main')
@section('content')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3 text-uppercase">Configuration</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Permission</li>
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
                <div class="d-lg-flex align-items-center mb-4 gap-3">

                    {{-- @if (Auth::user()->email == 'admin@illimitis.ci') --}}
                    <div class="ms-auto">
                        <button type="button" class="btn btn-primary radius-30 mt-2 mt-lg-0" data-bs-toggle="modal"
                            data-bs-target="#addPermissionModal"><i class="bx bxs-plus-square"></i>Nouvelle
                            Permission</button>
                        <button type="button" class="btn btn-primary radius-30 mt-2 ms-3 mt-lg-0" data-bs-toggle="modal"
                            data-bs-target="#addGroupModal"><i class="bx bxs-plus-square"></i>Nouveau Group</button>
                    </div>
                    {{-- @endif --}}

                    <!-- Button trigger modal -->

                </div>
                <div class="d-flex align-items-start justify-content-start my-4">
                    <h3 class="text-uppercase"> {{ $role->name ?? '--' }}</h3>
                </div>

                <div class="table-responsive">
                    <form action="{{ route('setting.permission.save', $role->id) }}" method="post" class="submitForm">
                        @csrf
                        <table class="table mb-0 table-bordered table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Modules</th>
                                    <th>Actions</th>
                                    <th>Privileges</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($groups as $item)
                                    @foreach ($item->permission as $key => $permission)
                                        <tr>
                                            @if ($key == 0)
                                                <td rowspan="{{ count($item->permission) }}">{{ $item->name }}</td>
                                            @endif
                                            <td>{{ $permission->name }}</td>

                                            @php
                                                $permissions_check = DB::table('role_has_permissions')
                                                    ->where([
                                                        'role_id' => $role->id,
                                                        'permission_id' => $permission->id,
                                                    ])
                                                    ->first();
                                            @endphp
                                            @if ($permissions_check)
                                                <td>
                                                    <input type="checkbox"  checked name="permissions[]"
                                                        value="{{ $permission->id }}">
                                                </td>
                                            @else
                                                <td>
                                                    <input type="checkbox" name="permissions[]"
                                                        value="{{ $permission->id }}">
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="3">
                                            <center><span>Aucune permission</span></center>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary radius-30">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        {{-- Modal add new category --}}

        <!-- Modal -->
        <div class="modal fade" id="addPermissionModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajout des permissions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('setting.permission.store') }}" method="post" class="submitForm">
                        @csrf
                        <div class="modal-body my-4">
                            <div class="row">
                                <div class="form-group col">
                                    <label for="">Libelle <span><span class="text-danger">*</span></span></label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                        name="name" autocomplete="off" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="group">Groupe <span><span class="text-danger">*</span></span></label>
                                    <select name="group" id="group" class="form-control">
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer mt-2">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-outline-success">Ajouter</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="modal fade" id="addGroupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajout de group</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('setting.group.store') }}" method="post" class="submitForm">
                        @csrf
                        <div class="modal-body my-4">
                            <div class="row">
                                <div class="form-group col">
                                    <label for="">Libelle <span><span class="text-danger">*</span></span></label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                        name="name" autocomplete="off" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="modal-footer mt-2">
                                <button type="button" class="btn btn-outline-danger"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-outline-success">Ajouter</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>



    </div>

@endsection
