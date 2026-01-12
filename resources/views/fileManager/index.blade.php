@extends('layouts.main')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Applications</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Gestionnaire de fichiers</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center mx-0 gx-1">
                            <div class="col-sm-10 col-md-10 col-lg-10">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-transparent"><i class='bx bx-search'></i></span>
                                    <input type="text" class="form-control fs-4" id="searchInputFolder" placeholder="Rechercher un dossier">
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addFolderModal"
                                class="btn btn-primary btn-lg" title="Ajouter un dossier">
                                <i class='bx bx-plus'></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="my-3">Mes Dossiers</h5>
                        <div class="fm-menu">
                            <div class="list-group list-group-flush">
                                <a href="javascript:;" id="allFilesBtn" class="list-group-item py-1" data-folder-id="all">
                                    <i class='bx bx-folder me-2'></i><span>Tous les Fichiers</span>
                                </a>


                                @foreach ($folders->whereNull('folderParent_id') as $folder)
                                    @include('fileManager.components.folder-item', [
                                        'folder' => $folder,
                                        'level' => 0,
                                    ])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>Statistiques des fichiers</h5>
                    </div>
                    <div class="card-body">

                        <div class="mt-4">
                            @foreach ($stats as $type => $data)
                                <div class="d-flex align-items-center mt-3">
                                    <div class="fm-file-box bg-light-{{ $data['color'] }} text-{{ $data['color'] }}">
                                        <i class="{{ $data['icon'] }}"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-0">{{ ucfirst($type) }}</h6>
                                        <p class="mb-0 text-secondary">{{ $data['count'] }} fichiers</p>
                                    </div>
                                    <h6 class="text-{{ $data['color'] }} mb-0">{{ $data['size_readable'] }}</h6>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="fm-search row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-0">
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-transparent"><i class='bx bx-search'></i></span>
                                        <input type="text" class="form-control" id="searchInput" placeholder="Recherhcer un fichier">
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                        <!--end row-->
                        {{-- <div class="d-flex align-items-center mt-2">
                            <div class="col-sm-12 col-md-2 col-lg-2 my-auto">
                                <div class="view-toggle">
                                    <button class="btn btn-outline-secondary" id="kanbanViewBtn" title="Vue Kanban">
                                        <i class='bx bx-grid-alt'></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" id="listViewBtn" title="Vue Liste">
                                        <i class="lni lni-list"></i>
                                    </button>
                                </div>
                            </div>
                        </div> --}}
                        <div class="d-flex justify-content-end align-items-end mt-3">
                            <button class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#addFileModal"><i
                                    class='bx bx-plus'></i> Ajouter un fichier</button>
                        </div>
                        <div class="table-responsive table-responsive-scroll mt-3">
                            <table class="table table-striped table-hover table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th>Nom <i class='bx bx-up-arrow-alt ms-2'></i></th>
                                        <th>Dossier</th>
                                        <th>Ajouté le</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="fileTableBody">
                                    <!-- Le contenu sera chargé dynamiquement par JavaScript -->
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>

    <style>
        .table-responsive-scroll {
            max-height: 60vh; /* ou la hauteur que tu veux */
            overflow-y: auto;
        }
        </style>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
             loadFolderFiles('all');

            document.getElementById('allFilesBtn').addEventListener('click', function () {
                document.querySelectorAll('.folder-item').forEach(item => {
                    item.classList.remove('bg-light-primary');
                });

                loadFolderFiles('all');
            });


            // Gestion de l'affichage des sous-dossiers
            document.querySelectorAll('.toggle-children').forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const icon = this.querySelector('i');
                    if (icon.classList.contains('bx-chevron-right')) {
                        icon.classList.remove('bx-chevron-right');
                        icon.classList.add('bx-chevron-down');
                    } else {
                        icon.classList.remove('bx-chevron-down');
                        icon.classList.add('bx-chevron-right');
                    }
                });
            });

            // Sélection d'un dossier et chargement des fichiers
            document.querySelectorAll('.select-folder').forEach(folder => {
                folder.addEventListener('click', function() {
                    const folderItem = this.closest('.folder-item');
                    const folderId = folderItem.dataset.folderId;
                    
                    // Enlever la sélection précédente
                    document.querySelectorAll('.folder-item').forEach(item => {
                        item.classList.remove('bg-light-primary');
                    });
                    
                    // Ajouter la sélection au dossier cliqué
                    folderItem.classList.add('bg-light-primary');
                    
                    // Charger les fichiers du dossier
                    loadFolderFiles(folderId);
                });
            });

            // Charger les fichiers du dossier racine par défaut
            loadFolderFiles(null);
        });

        function loadFolderFiles(folderId) {
            fetch(`/file/file-manager/files/${folderId}`)
                .then(response => response.json())
                .then(data => {
                    updateFilesTable(data.files);
                })
                .catch(error => console.error('Erreur:', error));
        }

        // Fonction pour mettre à jour le tableau des fichiers
        function updateFilesTable(files) {
            const tbody = document.querySelector('table tbody');
            tbody.innerHTML = '';

            if (files.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" class="text-center">Aucun fichier dans ce dossier</td></tr>';
                return;
            }

            files.forEach(file => {
            files.forEach(file => {
            const row = document.createElement('tr');
            const downloadUrl = `/file-manager/download/${file.uuid}`;
            const previewUrl = `/file-manager/preview/${file.uuid}`;

                row.innerHTML = `
                    <td>
                        <div class="d-flex align-items-center">
                            <div><i class='${getFileIcon(file)} me-2 font-24'></i></div>
                            <div class="font-weight-bold">${file.name}</div>
                        </div>
                    </td>
                    <td>${file.folder_name || 'Racine'}</td>
                    <td>${new Date(file.created_at).toLocaleDateString()}</td>
                    <td class="text-end">
                        <div class="btn-group" role="group">
                           
                            ${['pdf', 'image', 'text'].includes(getFileType(file.extension)) ? `
                                <a href="${previewUrl}" class="btn btn-sm btn-outline-secondary" target="_blank" title="Prévisualiser">
                                    <i class='bx bx-show'></i>
                                </a>
                            ` : ''}
                            <a href="${downloadUrl}" class="btn btn-sm btn-outline-primary" target="_blank" title="Télécharger">
                                <i class='bx bx-download'></i>
                            </a>
                        </div>
                    </td>
                `;

                tbody.appendChild(row);
            });
            });
        }

        // Fonction pour déterminer le type de fichier
        function getFileType(extension) {
            const types = {
                jpg: 'image', jpeg: 'image', png: 'image', gif: 'image',
                doc: 'document', docx: 'document', txt: 'text',
                pdf: 'pdf', 
                zip: 'archive', rar: 'archive'
            };
            return types[extension.toLowerCase()] || 'default';
        }

        // Fonction pour obtenir l'icône du fichier
        function getFileIcon(file) {
            const fileType = getFileType(file.extension);
            const icons = {
                image: 'bx bxs-file-image text-info',
                document: 'bx bxs-file-doc text-primary',
                pdf: 'bx bxs-file-pdf text-danger',
                archive: 'bx bxs-file-archive text-warning',
                default: 'bx bxs-file text-secondary'
            };
            return icons[fileType] || icons.default;
        }
    </script>

    <script>
        document.getElementById('searchInput').addEventListener('input', function () {
            const keyword = this.value.toLowerCase();
            const rows = document.querySelectorAll('#fileTableBody tr');

            rows.forEach(row => {
                const fileName = row.querySelector('.font-weight-bold').textContent.toLowerCase();
                const folderName = row.children[1].textContent.toLowerCase();

                if (fileName.includes(keyword) || folderName.includes(keyword)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

    </script>

    <style>
        .folder-container {
            margin-bottom: 2px;
        }

        .folder-item {
            padding: 8px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .folder-item:hover {
            background-color: #f8f9fa;
        }

        .children-container {
            margin-left: 20px;
            border-left: 1px dashed #dee2e6;
        }

        .bg-light-primary {
            background-color: rgba(13, 110, 253, 0.1);
        }
    </style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInputFolder');
    
    // Configuration
    const config = {
        debounceTime: 300,
        noResultsText: 'Aucun dossier correspondant trouvé'
    };

    // Initialisation
    let allFolders = [];
    const foldersContainer = document.querySelector('.fm-menu .list-group-flush');
    const allFilesItem = document.querySelector('.list-group-item');

    // Récupérer tous les dossiers une seule fois
    function initFolders() {
        allFolders = Array.from(document.querySelectorAll('.folder-item')).map(item => {
            return {
                element: item,
                name: item.querySelector('.folderBlock').textContent.toLowerCase(),
                id: item.dataset.folderId,
                childrenContainer: item.nextElementSibling?.classList.contains('children-container') 
                    ? item.nextElementSibling 
                    : null,
                isVisible: true
            };
        });
    }

    // Fonction de filtrage principale
    const filterFolders = debounce(function() {
        const keyword = this.value.trim().toLowerCase();
        
        if (!keyword) {
            resetSearch();
            return;
        }

        initFolders(); // Réinitialiser les dossiers
        
        let hasMatches = false;
        
        // Cache l'élément "Tous les Fichiers" pendant la recherche
        allFilesItem.style.display = 'none';

        // Premier passage : marquer les correspondances
        allFolders.forEach(folder => {
            const isMatch = folder.name.includes(keyword);
            folder.isMatch = isMatch;
            if (isMatch) hasMatches = true;
        });

        // Deuxième passage : gérer l'affichage
        allFolders.forEach(folder => {
            const shouldShow = folder.isMatch || hasAncestorMatch(folder) || hasDescendantMatch(folder);
            folder.element.style.display = shouldShow ? '' : 'none';
            
            // Gérer les conteneurs enfants
            if (folder.childrenContainer) {
                folder.childrenContainer.style.display = shouldShow ? '' : 'none';
            }
        });

        // Gérer le message "aucun résultat"
        if (!hasMatches) {
            showNoResultsMessage();
        } else {
            hideNoResultsMessage();
        }
    }, config.debounceTime);

    // Helper functions
    function hasAncestorMatch(folder) {
        let current = folder.element.closest('.children-container');
        while (current) {
            const parentFolder = current.previousElementSibling;
            if (parentFolder && parentFolder.classList.contains('folder-item')) {
                const parentData = allFolders.find(f => f.element === parentFolder);
                if (parentData?.isMatch) return true;
                current = parentFolder.closest('.children-container');
            } else {
                current = null;
            }
        }
        return false;
    }

    function hasDescendantMatch(folder) {
        if (!folder.childrenContainer) return false;
        
        const childFolders = folder.childrenContainer.querySelectorAll('.folder-item');
        for (let child of childFolders) {
            const childData = allFolders.find(f => f.element === child);
            if (childData?.isMatch || hasDescendantMatch(childData)) {
                return true;
            }
        }
        return false;
    }

    function resetSearch() {
        allFolders.forEach(folder => {
            folder.element.style.display = '';
            if (folder.childrenContainer) {
                folder.childrenContainer.style.display = '';
            }
        });
        allFilesItem.style.display = '';
        hideNoResultsMessage();
    }

    function showNoResultsMessage() {
        let message = document.querySelector('.no-folders-message');
        if (!message) {
            message = document.createElement('div');
            message.className = 'no-folders-message text-center py-3 text-muted';
            message.textContent = config.noResultsText;
            foldersContainer.appendChild(message);
        }
    }

    function hideNoResultsMessage() {
        const message = document.querySelector('.no-folders-message');
        if (message) message.remove();
    }

    function debounce(func, wait) {
        let timeout;
        return function() {
            const context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }

    // Initialisation
    initFolders();
    searchInput.addEventListener('input', filterFolders);
});
</script>

<style>
    .folder-item {
        transition: all 0.3s ease;
    }
    
    .no-folders-message {
        font-style: italic;
        padding: 1rem;
        color: #6c757d;
    }
    
    /* Style pour garder l'indentation pendant le filtrage */
    .children-container {
        transition: all 0.3s ease;
    }
</style>



    

<style>
    .folder-container {
        margin-bottom: 2px;
        transition: all 0.2s ease;
    }

    .folder-item {
        padding: 8px 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .folder-item:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }

    .folder-item.bg-light-primary {
        background-color: rgba(13, 110, 253, 0.1);
    }

    .children-container {
        margin-left: 20px;
        border-left: 1px dashed #dee2e6;
        transition: all 0.3s ease;
    }

    .file-icon {
        width: 24px;
        height: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .file-row:hover {
        background-color: #f8f9fa;
    }

    .dropdown-toggle::after {
        display: none;
    }
</style>

<script>
    async function downloadFile(uuid) {
    const button = event.target;
    const originalContent = button.innerHTML;
    
    try {
        // Afficher un indicateur de chargement
        button.innerHTML = '<i class="bx bx-loader bx-spin"></i>';
        button.disabled = true;
        
        // Appeler l'API de téléchargement
        const response = await fetch(`/file-manager/download/${uuid}`);
        
        if (!response.ok) {
            throw new Error('Échec du téléchargement');
        }
        
        // Récupérer le nom du fichier depuis les headers
        const contentDisposition = response.headers.get('Content-Disposition');
        const filenameMatch = contentDisposition.match(/filename="?(.+)"?/);
        const filename = filenameMatch ? filenameMatch[1] : `download-${uuid}`;
        
        // Créer un blob et le télécharger
        const blob = await response.blob();
        const url = window.URL.createObjectURL(blob);
        
        const link = document.createElement('a');
        link.href = url;
        link.download = filename;
        document.body.appendChild(link);
        link.click();
        
        // Nettoyer
        setTimeout(() => {
            document.body.removeChild(link);
            window.URL.revokeObjectURL(url);
            button.innerHTML = originalContent;
            button.disabled = false;
        }, 100);
        
    } catch (error) {
        console.error('Download error:', error);
        button.innerHTML = originalContent;
        button.disabled = false;
        alert('Erreur lors du téléchargement: ' + error.message);
    }
}
</script>

    @include('fileManager.components.addDocument')
    @include('fileManager.components.addFile')
    
@endsection



