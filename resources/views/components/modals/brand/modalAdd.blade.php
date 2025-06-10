<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAdd" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Marca</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('brandCreated') }}" method="POST" id="brandForm">
                <div class="modal-body">
                
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="input" class="form-label">Nombre de marca <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="input" name="brand" placeholder="Nombre de marca">
                        <div id="errorInput" class="invalid-feedback" style="display: none;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="sendButton" class="btn btn-secondary w-100">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>