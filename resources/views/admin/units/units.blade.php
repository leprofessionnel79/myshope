@extends('layouts.app')

@section('content')

@if (session()->has('message'))

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fa fa-check-circle ml-50"></i>    {{session()->get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>



@endif



<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Units</div>

                <div class="card-body">
                    <form action="{{route('units')}}" method="post" class="row">
                         @csrf
                        <div class="form-group col-md-6" >
                            <label for="unit_name">Unit Name</label>
                            <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Unit Name" required>
                          </div>
                          <div class="form-group col-md-6" >
                            <label for="unit_code">Unit Code</label>
                            <input type="text" class="form-control" id="unit_code" name="unit_code" placeholder="Unit Code" required>
                          </div>
                          <div class="form-group col-md-12" >
                            <button class="btn btn-primary" type="submit">Save new Unit</button>
                          </div>

                    </form>

                  <div class="row">
                    @foreach ($units as $unit)
                    <div class="col-md-3">
                      <div class="alert alert-primary" role="alert">

                            <span class="btn-span">
                                <span><a  class="edit_unit" data-unitid="{{$unit->id}}"
                                  data-unitname="{{$unit->unit_name}}"
                                    data-unitcode="{{$unit->unit_code}}" ><i class="fas fa-edit"></i></a></span>

                                <span><a  class="delete_unit" data-unitid="{{$unit->id}}" data-unitname="{{$unit->unit_name}}"
                                    data-unitcode="{{$unit->unit_code}}" ><i class="far fa-trash-alt"></i></a></span>
                            </span>

                            {{-- <form action="{{route('units')}}" method="post">
                                @csrf
                                <input type="hidden" value="delete" name="_method">
                                <input type="hidden"  name="unit_id" value="{{$unit->id}}">
                                <button type="submit" class="delete-btn"><i class="fas fa-trash-alt"></i></button>
                            </form> --}}


                        <p>{{$unit->unit_name}}, {{$unit->unit_code}} </p>

                      </div>
                    </div>
                  @endforeach
                  </div>

                  {{$units->links()}}


                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<div class="modal delete_window" tabindex="-1" role="dialog" id="delete-window">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete Unit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    <form action="{{route('units')}}" method="post">
            <div class="modal-body">
            <p id="delete-message"></p>

                @csrf
                <input type="hidden" value="delete" name="_method">
                <input type="hidden"  name="unit_id" value="" id="unit_id">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
            <button type="submit" class="btn btn-primary">DELETE</button>
            </div>
    </form>
      </div>
    </div>
  </div>

  <div class="modal edit_window" tabindex="-1" role="dialog" id="edit-window">
    <form action="{{route('units')}}" method="post" >
    <div class="modal-dialog" role="document">

      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Update Unit</h5>

            @csrf
           <div class="form-group col-md-4" >
               <label for="edit_unit_name">Unit Name</label>
               <input type="text" class="form-control" id="edit_unit_name" name="unit_name" placeholder="Unit Name" required>
             </div>
             <div class="form-group col-md-4" >
               <label for="edit_unit_code">Unit Code</label>
               <input type="text" class="form-control" id="edit_unit_code" name="unit_code" placeholder="Unit Code" required>
             </div>


             <input type="hidden"  name="unit_id" value="" id="edit_unit_id">
             <input type="hidden" name="_method" value="put">

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p id="edit_message"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
          <button type="submit" class="btn btn-primary">UPDATE</button>
        </div>

      </div>

    </div>
</form>
  </div>



@section('scripts')

        <script>

            $(document).ready(function(){
              var $deleteUnit=$('.delete_unit');
              var $deleteWindow=$('#delete-window');
              var $unitId = $('#unit_id');
              var $editunitId = $('#data-edit-unitid');
              var $deletemessage=$('#delete-message');




              $deleteUnit.on('click',function(element){
                element.preventDefault();
              var unit_id = $(this).data('unitid');
              var unit_name = $(this).data('unitname');
              var unit_code = $(this).data('unitcode');
               $unitId.val(unit_id);
               $deletemessage.text('are you sure u want delete '+unit_name+' with code name '+unit_code+' ?');
                $deleteWindow.modal('show');
              });

              var $editmessage=$('#edit_message');
              var $editWindow=$('#edit-window');
              var $editUnit=$('.edit_unit');

              var $editUnitName=$('#edit_unit_name');
              var $editUnitCode=$('#edit_unit_code');
              var $editUnitId=$('#edit_unit_id');

              $editUnit.on('click',function(element){
                element.preventDefault();
              var unit_id = $(this).data('unitid');
              var unit_name = $(this).data('unitname');
              var unit_code = $(this).data('unitcode');

              $editUnitName.val(unit_name);
              $editUnitCode.val(unit_code);
              $editUnitId.val(unit_id);

              //$editunitId.val(unit_id);
              //$editmessage.text('the unit '+$editUnitName+' with code name '+$editUnitCode+' has been updated');
                $editWindow.modal('show');
              });


            });

        </script>

@endsection






