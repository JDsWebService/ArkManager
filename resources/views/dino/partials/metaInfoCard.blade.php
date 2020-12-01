<div class="card">
    <img class="card-img-top bg-white dino-icon-card" src="{{ asset("{$metaInfo->image_public_path}") }}" alt="{{ $metaInfo->name }} Icon">
    <div class="card-body">
        <h5 class="card-title">{{ $metaInfo->name }} Technical Info</h5>
        @if($metaInfo->description)
            <p class="card-text">{{ $metaInfo->description }}</p>
        @else
            <p class="card-text">No Description Found For {{ $metaInfo->name }}</p>
        @endif
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">{{ $metaInfo->ark_id }}</li>
        @if($metaInfo->is_dlc)
            <li class="list-group-item">
                <span class="badge badge-pill badge-info">
                    {{ $metaInfo->dlc_name }}
                </span>
            </li>
        @endif
    </ul>
</div>
