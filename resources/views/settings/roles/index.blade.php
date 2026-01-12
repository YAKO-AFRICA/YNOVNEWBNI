@extends('layouts.main')
@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3 text-uppercase">Configuration</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Roles</li>
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

              <div class="ms-auto">
                <button type="button" class="btn btn-primary radius-30 mt-2 mt-lg-0" data-bs-toggle="modal" data-bs-target="#addRoleModal"><i class="bx bxs-plus-square"></i>Nouveau Role</button>
              </div>

               <!-- Button trigger modal -->

            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>id</th>
                            <th>Libelle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <input class="form-check-input me-3" type="checkbox" value="" aria-label="...">
                                    </div>
                                    <div class="ms-2">
                                        <h6 class="mb-0 font-14">#{{ $item->id }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->name }}</td>


                            <td>
                                <div class="d-flex order-actions">
                                    <a data-bs-toggle="modal" data-bs-target="#editRoleModal{{ $item->id }}"  class="" style="cursor: pointer"><i class='bx bxs-edit'></i></a>

                                    <form action="{{ route('setting.role.destroy', $item->id) }}" method="post" class="submitForm">
                                        @csrf
                                        <button type="submit" class="mx-3 bg-light px-2 rounded"><i class='bx bxs-trash'></i> </button>
                                    </form>

                                    <a href="{{ route('setting.permission', $item->id) }}"  class="" style="cursor: pointer"><i class="lni lni-key"></i></a>
                                </div>
                            </td>
                        </tr>

                        {{-- Modal edit category --}}
                       <div class="modal fade" id="editRoleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <form action="{{ route('setting.role.edit', $item->id) }}" method="post" class="submitForm">
                                        @csrf
                                        <div class="modal-body my-4">
                                            <div class="row">
                                                <div class="form-group col">
                                                    <label for="">Libelle <span><span class="text-danger">*</span></span></label>
                                                    <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ old('name', $item->name) }}" name="name" required>
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    @if ($errors->has('name') && $errors->first('name') == 'The name has already been taken.')
                                                        <div class="invalid-feedback">Le nom existe déjà dans la table des rôles.</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="modal-footer mt-2">
                                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-outline-success">Modifier</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        @empty

                            <center><span>Aucun role</span></center>

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- Modal add new category --}}

    <!-- Modal -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nouveau Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('setting.role.store') }}" method="post" class="submitForm">
                    @csrf
                    <div class="modal-body my-4">
                        <div class="row">
                            <div class="form-group col">
                                <label for="">Libelle <span><span class="text-danger">*</span></span></label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" autocomplete="off" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($errors->has('name') && $errors->first('name') == 'The name has already been taken.')
                                    <div class="invalid-feedback">Le nom existe déjà dans la table des rôles.</div>
                                @endif
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



</div>

@endsection
