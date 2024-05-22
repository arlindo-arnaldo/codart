<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/admin-assets/dist/libs/dropzone/dist/dropzone.css?1684106062" rel="stylesheet"/>
    <link rel="stylesheet" href="/admin-assets/dist/css/modal.css">
    <link href="/admin-assets/dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
    <link href="/admin-assets/dist/css/demo.min.css?1684106062" rel="stylesheet"/>
    <link href="/admin-assets/dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
    
</head>
<body>-->
   <button class="btn btn-primary">Abrir Modal</button>
   <div>
    @livewire('modal.file-manager')
   </div>

   <!--
    <script src="/admin-assets/dist/libs/dropzone/dist/dropzone-min.js?1684106062" defer></script>
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
        
        document.querySelector('button').onclick = function(){showModal()}
        showModal()
        document.addEventListener('closeModal', function(){
          closeModal();
        });
    </script>
    <script src="/admin-assets/dist/js/tabler.min.js?1684106062" defer></script>

    
</body>
</html>
-->