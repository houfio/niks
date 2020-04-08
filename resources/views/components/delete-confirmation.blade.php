<div class="text-input">
  <h3>
    {{ __('views/users.confirmation') }}
  </h3>
</div>
<div class="text-input">
  <label for="confirmation-word">{{ __('views/users.type-confirmation') }}</label>
  <input type="text" id="confirmation-word" name="confirmation-word" style="text-transform: uppercase;" required>
</div>
<div class="button-group">
  <a class="button danger delete" onclick="submitDelete()">Permanent verwijderen</a>
  <a class="button transparent" data-micromodal-close>Terug</a>
</div>
<script>
  function submitDelete() {
    let inputval = document.getElementById("confirmation-word").value;
    console.log(inputval);
    if(inputval === "verwijderen") {
      document.getElementById("deleteForm").submit();
    }
    else {
      alert("Veld is niet correct ingevuld!")
    }
  }
</script>
