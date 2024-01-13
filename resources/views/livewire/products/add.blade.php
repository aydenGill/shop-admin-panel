<div>
    <div class="card mb-4">
        <h5 class="card-header">Add new product</h5>
        <div class="card-body">

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="title" class="form-control" id="title" placeholder="" wire:model="title">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="2" wire:model="description"></textarea>
            </div>


            <div class="mb-3">
                <label for="inventory" class="col-md-2 col-form-label">Inventory</label>
                <input class="form-control" type="number" id="inventory" wire:model="inventory">
            </div>

            <div class="mb-3">
                <label for="price" class="col-md-2 col-form-label">Price</label>
                <input class="form-control" type="number" id="price" wire:model="price">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input class="form-control" type="file" id="image" wire:model="image">
            </div>

            @if($image)
            <img width="200" height="400" class="mt-4" src="{{$image->temporaryUrl()}}" />
            @endif
            <div wire:loading wire:target="image" class="text-sm text-gray-500 italic">Uploading...</div>


            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" wire:model="category_id" aria-label="select category">
                    <option selected="">Select one item</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
            </button>
            <button type="button" class="btn btn-primary" wire:click="add">Save</button>
        </div>
    </div>
</div>
</div>