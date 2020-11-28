<table class="table-small table-hover w-100 text-center">
    <thead>
        <tr class="font-weight-bold">
            <th scope="col" style="width: 22.5%;">Suggested Name</th>
            <th scope="col" style="width: 22.5%;">Level</th>
            <th scope="col" style="width: 22.5%;">Mutation Count</th>
            <th scope="col" style="width: 22.5%;">New Value</th>
            <th style="width: 10%;"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($mutatedDinos as $dino)
            <tr>
                <td>{{ $dino->name }}</td>
                <td>{{ $dino->level }}</td>
                <td>{{ $dino->mutation_count }}</td>
                <td>{{ $dino->{$dino->getRawOriginal('mutation_type')} }}</td>
                <td>
                    <a href="{{ route('dino.edit.mutation', $dino->slug) }}" class="text-info">
                        <i class="far fa-edit"></i>
                    </a>
                    <a class="text-danger" data-toggle="modal" data-target="#deleteMutation{{$dino->mutation_count}}">
                        <i class="far fa-trash-alt"></i>
                    </a>
                    @include('dino.partials.deleteMutationModal', ['mutatedDinoModal' => $dino])
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
