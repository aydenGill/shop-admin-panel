<ul class="list-group list-group-flush">
    @foreach($categories as $category)
        <li class="list-group-item">
            <div class="d-flex">
                <span> <img src="{{ asset('storage/'. $category->icon)  }}" style="width: 50px"></span>
                <h4 class="mr-1">{{ $category->name }}</h4>
                <div class="actions ml-5">
                    <button type="button" class="btn btn-outline-danger" wire:click="deleteConfirm({{ $category->id }})" >Delete</button>
                    <button  type="button" class="btn btn-outline-primary" wire:click="openEditCategoryModal({{ $category->id }})">Edit</button>
                    <button  type="button" class="btn btn-outline-warning" wire:click="openSubCategoryModal({{ $category->id }})">Register subcategory</button>
                </div>
            </div>
            @if($category->child->count())
                @include('livewire.categories.categories-group' , ['categories' => $category->child])
            @endif
        </li>
    @endforeach
</ul>
