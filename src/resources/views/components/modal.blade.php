<div class="modal fade" id="{{$id}}" tabindex="-1" aria-labelledby="{{$id}}ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title ml-auto" id="exampleModalLabel">{{$title}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size:  2rem">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{$slot}}
        </div>
      </div>
    </div>
  </div>