@extends('admin.layouts.pages')
@section('title','Perfil')

@section('page-title','Perfil')
@section('content')
    
     @livewire('users.profile')
@endsection

@push('scripts')
<script>
     $('#picture').ijaboCropTool({
        preview : '.image-previewer',
        setRatio:1,
        allowedExtensions: ['jpg', 'jpeg','png'],
        buttonsText:['CROP','QUIT'],
        buttonsColor:['#30bf7d','#ee5155', -15],
        processUrl:'{{ route("admin.change-profile-picture") }}',
        withCSRF:['_token','{{ csrf_token() }}'],
        onSuccess:function(message, element, status){
           alert(message);
        },
        onError:function(message, element, status){
          alert(message);
        }
     });
</script>
@endpush