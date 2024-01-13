<div>
<div class="card">
    <div class="card-body">
        @foreach($inputs as $key=>$value)
       <div class="row mb-3">
        <div class="col">
            <input wire:model="inputs.{{$key}}.alt" type="text" class="form-control" placeholder="alt">
            @error('inputs.'.$key.'.alt')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col">
            <input wire:model="inputs.{{$key}}.image" type="file" class="form-control" placeholder="image">
            @error('inputs.'.$key.'.image')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col">
            <button wire:click="remove({{$key}})" class="btn btn-danger btn-sm">Remove</button>
        </div>
        </div> 
        @endforeach 
    </div>
    <div class="card-footer">
        <button wire:click="add" class="btn btn-primary btn-sm">Add</button>
        <button wire:click="save" class="btn btn-success btn-sm">Save</button>
    </div>
    
</div>

</div>
