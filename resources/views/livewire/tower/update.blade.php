
<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar informações da torre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="hidden" wire:model="uuid">
                        <label for="name_update">Name</label>
                        <input type="text" class="form-control" wire:model.lazy="name" id="name_update" placeholder="Enter Name">
                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="model">Trecho</label>
                        <select class="form-control" name="model" id="model" wire:model="trecho_id" required>
                          <option value=""  >Selecione um trecho</option>
                          @foreach ($lotes as $lote)
                            @foreach ($lote->trechos as $value)
                            <option value="{{$value->id}}" {{$trecho_id == $value->id ? "selected":""}}  >{{$value->name}}</option>            
                            @endforeach
                          @endforeach
                        </select>
                      </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary" data-dismiss="modal">Save changes</button>
            </div>
       </div>
    </div>
</div>