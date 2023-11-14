<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-header-title tx-20 mb-0">Category List</h6>
                            </div>
                            <div class="text-right">
                                <div class="d-flex">
                                    <button class="btn btn-primary" wire:click="OpenAddCategoryModal">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        @include('livewire.categories.categories-group' , ['categories' => $categories])
                    </div>
                </div>
            </div>
        </div>

        @include('livewire.categories.modal.add')
        @include('livewire.categories.modal.update')
        @include('livewire.categories.modal.sub')
</div>
