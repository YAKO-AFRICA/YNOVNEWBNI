@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Créer un nouveau ticket</h1>
    
    <form action="{{ route('shared.tickets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="subject">Sujet</label>
            <input type="text" name="subject" id="subject" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="priority">Priorité</label>
            <select name="priority" id="priority" class="form-control" required>
                <option value="low">Faible</option>
                <option value="medium" selected>Moyenne</option>
                <option value="high">Haute</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5" class="form-control" required></textarea>
        </div>
    
        <div class="form-group">
            <label for="attachments">Pièces jointes</label>
            <input type="file" name="attachments[]" id="attachments" class="form-control-file" multiple>
            <small class="form-text text-muted">Vous pouvez sélectionner plusieurs fichiers (max 10MB chacun)</small>
        </div>
        
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>
@endsection