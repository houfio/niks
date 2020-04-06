@if ($errors->any())
  @foreach ($errors->all() as $error)
    <div class="error">{{ __($error) }}</div>
  @endforeach
@endif
@if(Session::has('message'))
  <button class="flash">
    {{Session::get('message')}}
  </button>
@endif
