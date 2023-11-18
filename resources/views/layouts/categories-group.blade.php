<ul class="list-group list-group-flush">
    @foreach($categories as $category)
        <li class="list-group-item">
            <div class="d-flex align-items-center ">
                <span><img src="{{ $category->icon }}" style="width: 50px;margin-right: 10px"></span>
                <h4 style="margin-right: 10px">{{ $category->name }}</h4>
                <div class="actions ml-5">
                    <button type="button" class="btn btn-outline-danger" wire:click="$dispatch('delete-category',{id : {{$category->id}} })">Delete
                    </button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#updateCategoriesModal"  @click="$dispatch('update-categories',{id:{{$category->id}}})">Edit</button>
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#subCategoriesModal"  @click="$dispatch('sub-categories',{id:{{$category->id}}})">Register subcategory
                    </button>
                </div>
            </div>
            @if($category->child->count())
                @include('layouts.categories-group', ['categories' => $category->child])
            @endif
        </li>
    @endforeach
</ul>

