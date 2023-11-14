<div>
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users /</span> List of Users</h4>

        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Permission</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($users as $user)
                        <tr>
                            <td> {{$loop->index+1}} </td>
                            <td> {{ $user->name ?? "" }} </td>
                            <td> {{ $user->mobile ?? "" }} </td>
                            <td> {{ $user->email }} </td>
                            <td> {{ $user->is_superuser ? "admin" : "client" }} </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                           @click="$dispatch('edit-user',{id:{{$user->id}}})"
                                           data-bs-toggle="modal"
                                           data-bs-target="#modalCenter"
                                        ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                        >
                                        <a class="dropdown-item" wire:click="$dispatch('delete-prompt',{id : {{$user->id}} })"
                                        ><i class="bx bx-trash me-1"></i> Delete</a
                                        >
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    <livewire:users.update>
</div>

<script>
    document.addEventListener('livewire:initialized',()=>{
    @this.on('delete-prompt',(event)=>{
        swal.fire({
            title:'Are you sure?',
            text:'You are about to delete this record, this action is irreversible',
            icon:'warning',
            showCancelButton:true,
            confirmButtonColor:'#3085d6',
            showCancelButtonColor:'#d33',
            confirmButtonText:'Yes, Delete it!',
        }).then((result)=>{
            if(result.isConfirmed){
                console.log(event)
                console.log("test")
            @this.dispatch('goOn-Delete' , {
                id : event.id
            })

            @this.on('deleted',(event)=>{
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Deleted , Your record has been deleted",
                    showConfirmButton: false,
                    timer: 1000
                });
            })
            @this.dispatch('refresh-users');
            }
        })
    })

        document.addEventListener('livewire:initialized',()=>{
        @this.on('reset-modal',(event)=>{
            $('#modalCenter').modal('hide');
        })
        })
    })
</script>



