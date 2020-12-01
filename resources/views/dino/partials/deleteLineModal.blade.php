<!--

////////////////////////////////////////////////////
// In order to use this modal, use the following  //
// code to create the trigger button. You can     //
// then call this modal by adding a Laravel blade //
// include statement, also passing in the base    //
// dino of the line that you want to delete.      //
////////////////////////////////////////////////////

<button class="btn btn-block btn-danger" data-toggle="modal" data-target="#deleteLineModal">
    <i class="far fa-trash-alt"></i> Delete Base Dino
</button>
[at]include('dino.partials.deleteLineModal', ['baseDinoModal' => $baseDino])

-->
{{ Form::open(['route' => ['dino.destroy.line', $baseDinoModal->uuid], 'method' => 'DELETE']) }}
<!-- Delete Dino Line Warning Modal -->
<div class="modal fade" id="deleteLineModal" tabindex="-1" aria-labelledby="deleteLineModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="deleteLineModalLabel"><i class="fas fa-exclamation-triangle"></i> Delete Line - {{ $baseDinoModal->metaInfo->name }} (Lvl {{ $baseDinoModal->level }}) {{ $baseDinoModal->mutation_type }}?</h5>
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
                        <p>Are you sure that you want to delete this line? This action once performed can not be undone. This will also delete any dinos in our database that are associated with this breeding line.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> Delete Dino Line</button>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
