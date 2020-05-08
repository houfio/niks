<form method="post" action="{{ @action('Auth\LoginController@login') }}">
  @csrf
  <div class="text-input">
    <label for="email">{{ __('general/attributes.email') }}</label>
    <input type="email" id="email" name="email" value="{{ old('email') }}" required/>
  </div>
  <div class="text-input">
    <label for="password">{{ __('general/attributes.password') }}</label>
    <input type="password" id="password" name="password" required/>
  </div>
  <div class="checkbox-input">
    <input type="checkbox" id="remember" name="remember" @if(old('remember')) checked @endif/>
    <label for="remember">{{ __('general/attributes.remember_me') }}</label>
  </div>
  <button type="submit" class="button" name="login">
    {{ __('views/login.title') }}
  </button>
  <a class="button light" href="{{ url('reset') }}">
    {{ __('views/forgotPassword.title') }}
  </a>
</form>
