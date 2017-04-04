@if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <script>
        	alertify.error('{{$error}}');
        </script>
        @endforeach
@endif