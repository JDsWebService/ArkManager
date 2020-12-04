<div class="card component-card_2">
    <img src="{{ $item->image_public_path }}" class="card-img-top mt-3" alt="widget-card-2" style="width: 120px; height: 120px; margin: 0 auto;">
    <div class="card-body">
        <h5 class="card-title">{{ $item->name }}</h5>
        @if($item->description != null || $item->description != "")
            <p class="card-text">{{ $item->description }}</p>
        @else
            <p class="card-text">No description for item was found.</p>
        @endif
        <hr>
        <p class="card-text">
            <span class="text-primary">Item Type:</span>
            {{ $item->type }}
        </p>
        @if($item->dlc_status)
            <p class="card-text">
                <span class="text-primary">DLC:</span>
                {{ $item->dlc_name }}
            </p>
        @else
            <p class="card-text">
                <span class="text-primary">DLC:</span>
                False
            </p>
        @endif
        <p class="card-text">
            <span class="text-primary">Item ID:</span>
            {{ $item->item_id }}
        </p>
        <p class="card-text">
            <span class="text-primary">Class Name:</span>
            {{ $item->class_name }}
        </p>
    </div>
</div>
