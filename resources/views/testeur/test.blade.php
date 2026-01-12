@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Résultats de l'API</h2>
    <table class="table mt-3" id="example2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Libellé</th>
                <th>ID Old</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datafinal as $item)
                <tr>
                    <td>{{ $item['IdTblBranche'] }}</td>
                    <td>{{ $item['CodeBranche'] }}</td>
                    <td>{{ $item['MonLibelle'] }}</td>
                    <td>{{ $item['ID_Old'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection