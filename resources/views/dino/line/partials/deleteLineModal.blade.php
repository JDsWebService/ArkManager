<!-- Delete Dino Line Warning Modal -->
<div class="modal fade" id="{{ $line->slug }}" tabindex="-1" aria-labelledby="{{ $line->slug }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="{{ $line->slug }}Label">Delete {{ $line->dino->name }} Line?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure that you want to delete this line? This action once performed can not be undone.</p>
                <hr>
                <h4>Line Technical Information</h4>
                <table class="table table-dark table-borderless w-100">
                    <tr>
                        <td>Dino Breed:</td>
                        <td>{{ $line->dino->name }}</td>
                    </tr>
                    <tr>
                        <td>Dino Type:</td>
                        <td>{{ $line->dino->type }}</td>
                    </tr>
                    <tr>
                        <td>Dino Base Level:</td>
                        <td>{{ $line->base_level }}</td>
                    </tr>
                    <tr>
                        <td>Line Mutation Count:</td>
                        <td>0</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> Delete Dino Line</button>
            </div>
        </div>
    </div>
</div>
