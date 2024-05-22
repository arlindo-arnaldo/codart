@livewire('modal.file-manager')

@push('scripts')
    <script>
        
      document.addEventListener("DOMContentLoaded", function() {
      new Dropzone("#dropzone-default")
    })
   
      function copyPath(){
        event.preventDefault();
        document.querySelector('#path').select();
        document.execCommand('copy');
        
      }
      document.querySelector("#updateFileManager").onclick = function(){Livewire.emit('updateFileManager')}
        function showModal(){
            document.querySelector('dialog').showModal();
        }
        function closeModal(){
            document.querySelector('dialog').close();
            Livewire.emit('resetTabs')
        }
        
        
        document.addEventListener('closeModal', function(){
          closeModal();
        });
    </script>
@endpush