
    <div>
        <form  method="POST" action="{{route('admin.medias.upload-media-modal')}}" class="dropzone dz-clickable" id="dropzone-default"  autocomplete="off" novalidate="" enctype="multipart/form-data">
          @csrf
        <div class="dz-default dz-message">
          <button class="dz-button" type="button"> Largue os ficheiro  para carregar</button>
      </div>
      </form>
      </div>

