<div>
    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('admin.products.gallery.create',$product->id) }}" class="btn btn-primary">Add</a></h4>
    <div class="row mb-5">
        @foreach ($galleries as $item)
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card h-100">
                <img class="card-img-top" src="{{asset('storage/'.$item->image)}}" alt="{{ $item->alt }}">
                <div class="card-body">
                    <button wire:click="$dispatch('delete-prompt',{id : {{$item->id}} })" class="btn btn-outline-danger">Remove</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('delete-prompt', (event) => {
            swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete this record, this action is irreversible',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                showCancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.dispatch('deleted-prompt', {
                        id: event.id
                    })

                    @this.on('deleted', (event) => {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Deleted , Your record has been deleted",
                            showConfirmButton: false,
                            timer: 1000
                        });
                    })
                    @this.dispatch('refresh-galleries');
                }
            })
        })
    })
</script>