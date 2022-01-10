<div class="mt-2 mr-5 ml-5 mb-2 ">
    <div class="{{  $setTypeClass()  }}  alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong>{{ $slot }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
