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
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoriesModal"  @click="$dispatch('add-categories')">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        @include('layouts.categories-group')
                    </div>
                </div>
            </div>
        </div>

     <livewire:categories.add/>
     <livewire:categories.update/>
     <livewire:categories.subcategories/>
</div>
 <script>
     document.addEventListener('livewire:initialized',()=>{
     @this.on('delete-category',(event)=>{
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
             @this.dispatch('refresh-categories');
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
