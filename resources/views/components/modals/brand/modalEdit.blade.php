<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Marca</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('brandUpdated') }}" method="POST" id="editForm">
                <div class="modal-body">
                
                    @csrf
                    @method('PUT')
                    <div class="mb-3 mt-3">
                        <input type="hidden" name="brand_id" id="id">
                        <label for="edit" class="form-label">Nombre de marca <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit" name="brand" placeholder="Marca Seleccionada Modificar">
                        <div id="errorEdit" class="invalid-feedback" style="display: none;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="sendEdit" class="btn btn-secondary w-100">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>