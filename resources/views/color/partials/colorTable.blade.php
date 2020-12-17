<div class="col-sm-2">
    <h5>Region {{ $id }}</h5>
    <hr>
    <table class="table table-sm table-borderless text-center">
        <thead>
        <tr>
            <th scope="col">Color</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($colors as $color)
            <tr>
                <td>
                    {{ $color->colorID }}
                    <i class="far fa-question-circle" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $color->name }}"></i>
                </td>
                @foreach($regionIds as $colorID)
                    <?php $noColor = false; ?>
                    @if($colorID == $color->id)
                        <td class="bg-success">
                            <span class="text-black">TRUE</span>
                        </td>
                        @break
                    @else
                        <?php $noColor = true; ?>
                    @endif
                @endforeach
                @if($noColor)
                    <td class="bg-danger"><span class="text-white">FALSE</span></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
