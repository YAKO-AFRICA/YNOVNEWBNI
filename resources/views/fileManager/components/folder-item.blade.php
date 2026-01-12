<div class="folder-container">
    <div i class="d-flex align-items-center folder-item" 
         data-folder-id="{{ $folder->id }}"
         style="padding-left: {{ $level * 20 }}px;">
        @if($folder->children->isNotEmpty())
            <a href="javascript:;" class="toggle-children me-1" data-bs-toggle="collapse" data-bs-target="#children-{{ $folder->id }}">
                <i class='bx bx-chevron-right'></i>
            </a>
        @else
            <span class="me-2" style="width: 16px;"></span>
        @endif
        
        <a href="javascript:;" class="select-folder d-flex align-items-center flex-grow-1 text-decoration-none">
            <i class='bx {{ $folder->children->isNotEmpty() ? "bx-folder-open text-primary" : "bx-folder text-secondary" }} me-2'></i>
            <span class="folderBlock">{{ $folder->name }}</span>
        </a>
    </div>

    @if($folder->children->isNotEmpty())
        <div class="children-container collapse" id="children-{{ $folder->id }}">
            @foreach($folder->children as $child)
                @include('fileManager.components.folder-item', ['folder' => $child, 'level' => $level + 1])
            @endforeach
        </div>
    @endif
</div>