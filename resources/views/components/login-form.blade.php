<form method="post" action="{{ @action('Auth\LoginController@login') }}">
  @csrf
  <div class="text-input">
    <label for="email">{{ __('validation.attributes.email') }}</label>
    <input type="email" id="email" name="email" value="{{ old('email') }}" required/>
  </div>
  <div class="text-input">
    <label for="password">{{ __('validation.attributes.password') }}</label>
    <input type="password" id="password" name="password" required/>
  </div>
  <div class="checkbox-input">
    <input type="checkbox" id="remember" name="remember" @if(old('remember')) checked @endif/>
    <label for="remember">{{ __('validation.attributes.remember_password') }}</label>
  </div>
  <button type="submit" class="button" name="login">
    {{ __('login.title') }}
  </button>
</form>
