<div class="text-input">
  <h3 class="divider">
    {{ __('views/users.confirmation') }}
  </h3>
</div>
<div class="text-input">
  <label for="confirmation-word">{{ __('views/users.type-confirmation') }}</label>
  <input type="text" id="confirmation-word" name="confirmation-word" style="text-transform: uppercase;" autocomplete="off" required>
  <span class="warning divider" id="warning-message"></span>
</div>
<div>
  <p>
    <b>LET OP</b>: Deze actie kan niet ongedaan worden gemaakt! <br>
    Alle gekoppelde advertentie's, boden en persoonlijke gegevens zullen permanent verwijderd worden.
  </p>
</div>
<div class="button-group">
  <a class="button danger delete" onclick="submitDelete()">Permanent verwijderen</a>
  <a class="button transparent" data-micromodal-close>Terug</a>
</div>
<script>
  function submitDelete() {
    let inputval = document.getElementById("confirmation-word").value;
    let warning = document.getElementById("warning-message");
    if(inputval.toLowerCase() === "verwijderen") {
      warning.textContent = "";
      document.getElementById("deleteForm").submit();
    }
    else {
      warning.textContent = "Veld is niet correct ingevuld!";
    }
  }
</script>
