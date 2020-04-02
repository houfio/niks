@if ($errors->any())
  @foreach ($errors->all() as $error)
    <div class="error">{{ __($error) }}</div>
  @endforeach
@endif
