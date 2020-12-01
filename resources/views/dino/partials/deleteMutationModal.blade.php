<!--

////////////////////////////////////////////////////
// In order to use this modal, use the following  //
// code to create the trigger button. You can     //
// then call this modal by adding a Laravel blade //
// include statement, also passing in the mutated //
// dino of the line that you want to delete.      //
////////////////////////////////////////////////////

<a class="text-danger" data-toggle="modal" data-target="#deleteMutation(MUTATION_COUNT_HERE)">
    <i class="far fa-trash-alt"></i>
</a>
[at]include('dino.partials.deleteMutationModal', ['mutatedDinoModal' => $dino])

-->

<!-- Delete Mutated Dino Warning Modal -->
{{ Form::open(['route'=> ['dino.destroy.mutation', $mutatedDinoModal->slug], 'method' => 'DELETE']) }}
<div class="modal fade" id="deleteMutation{{$mutatedDinoModal->mutation_count}}" tabindex="-1" aria-labelledby="deleteMutation{{ $mutatedDinoModal->mutation_count }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="deleteMutation{{ $mutatedDinoModal->mutation_count }}Label"><i class="fas fa-exclamation-triangle"></i> Delete Mutated Dino ({{ $mutatedDinoModal->name }} - Lvl {{ $mutatedDinoModal->level }})?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img src="{{ asset('icons/alerts/warning.png') }}" style="width: 128px; height: 128px;" alt="Danger Alert Image">
                    </div>
                    <div class="col-sm-12 mt-3">
                        <p>Are you sure you want to delete the mutated dino with mutation count of: <span class="text-warning">{{ $mutatedDinoModal->mutation_count }}</span>?</p>
                        <p class="text-warning">
                            By doing so any mutations above this mutated dino will also be deleted. This process can not be reversed!
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> Delete Mutated Dino</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
