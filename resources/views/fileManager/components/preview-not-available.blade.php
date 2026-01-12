<div class="text-center p-5">
    <i class='bx bx-error-alt text-warning' style="font-size: 5rem;"></i>
    <h4 class="mt-3">Prévisualisation non disponible</h4>
    <p class="text-muted">Ce type de fichier ne peut pas être prévisualisé directement.</p>
    <a href="{{ route('file-manager.download', $file->uuid) }}" class="btn btn-primary">
        <i class='bx bx-download'></i> Télécharger le fichier
    </a>
</div>