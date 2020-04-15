<form method="post" action="{{ $action }}" class="inline">
  @csrf
  @method($method ?? 'post')
  <button type="submit" dusk="{{ $duskSelector ?? '' }}" {{ $attributes }}>
    <i class="fas fa-{{ $icon }}"></i>
  </button>
</form>
