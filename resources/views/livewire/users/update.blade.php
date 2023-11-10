<div>
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit user {{$name}}</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Name</label>
                            <input
                                type="text"
                                id="nameWithTitle"
                                class="form-control"
                                placeholder="Enter Name"
                                wire:model="name"
                            />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Email</label>
                            <input
                                type="text"
                                id="emailWithTitle"
                                class="form-control"
                                placeholder="xxxx@xxx.xx"
                                disabled
                                wire:model="email"
                            />
                        </div>
                        <div class="col mb-0">
                            <label for="mobile" class="form-label">mobile</label>
                            <input
                                type="text"
                                id="mobile"
                                class="form-control"
                                placeholder="09051027572"
                                wire:model="mobile"
                            />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" wire:click="update">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
        document.addEventListener('livewire:initialized',()=>{
        @this.on('reset-modal',(event)=>{
            $('#modalCenter').modal('hide');
        })
        })
</script>

