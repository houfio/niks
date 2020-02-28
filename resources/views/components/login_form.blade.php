<form method="post" action="{{ @action('Auth\LoginController@authenticate') }}">
  @csrf
  <div class="text-input">
    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" required/>
  </div>
  <div class="text-input">
    <label for="password">Wachtwoord</label>
    <input type="password" id="password" name="password" required/>
  </div>
  <div class="checkbox-input">
    <input type="checkbox" id="rememberMe" name="rememberMe"/>
    <label for="rememberMe">Wachtwoord onthouden</label>
  </div>
  <button type="submit" class="button" name="login">
    {{ __('login.title') }}
  </button>
</form>
