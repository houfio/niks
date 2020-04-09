<div class="text-input">
  <h3 class="divider">
    {{ __('views/users.confirmation') }}
  </h3>
</div>
<div class="text-input">
  <label for="confirmation-word">{{ __('views/users.type_confirmation', ['email' => $email]) }}</label>
  <input type="text" id="confirmation-word" name="confirmation-word" autocomplete="off" required>
  <span class="warning divider" id="warning-message">{{ __('views/users.input_error') }}</span>
</div>
<div>
  <p>
    <b>{{ __('views/users.warning') }}</b>: {{ __('views/users.detailed_warning') }}
  </p>
</div>
<div class="button-group">
  <a class="button danger" id="submitDelete">Permanent verwijderen</a>
  <a class="button transparent" data-micromodal-close>Terug</a>
</div>
<script>
  const email = {!! json_encode($email) !!};
</script>
