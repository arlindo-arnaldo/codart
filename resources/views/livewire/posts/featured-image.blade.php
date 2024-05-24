@push('styles')
    <style>
      #thumb:hover{
        border: 1px dashed rgb(120, 120, 120);
        cursor: pointer;
      }
    </style>
@endpush
<div>
    <div class="card-body">
      @if (session('image'))
        @php $photo = session('image') @endphp
      @endif
      
        <h4>Imagem destacada</h4>
        
        @if (!$photo)
            <div style="text-align: center" class="mb-3">
         <a class="avatar avatar-upload rounded" onclick="showModal();
           /*event.preventDefault();
           document.querySelector('#photo').click();*/
           ">
             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
             <span class="avatar-upload-text">Add</span>
         </a>
         
       </div>
       @else
       <img src="/storage/{{$photo['path']}}" alt=""  onclick="showModal()" id="thumb">
       <input type="hidden" value="{{$photo['id']}}" name="thumb" >
      <br> <br>
       <span class="text-danger" style="cursor: pointer;" wire:click="unsetPhoto"><b>Limpar</b></span>
        @endif
        
       
    </div>
</div>
