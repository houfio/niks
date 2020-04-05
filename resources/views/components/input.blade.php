<div class="text-input">
  <label for="{{ $name }}" @if(isset($required)) data-required @endif>
    {{ $label }}
  </label>
  @if(isset($help))
    <div data-tooltip="{{ $name }}_help">
      <i class="fas fa-question-circle"></i>
    </div>
  @endif
  @if (isset($type) && $type ==='textarea')
    <textarea
      id="{{ $name }}"
      name="{{ $name }}"
      rows="3"
      @if(isset($help)) aria-describedby="{{ $name }}_help" @endif
      @if(isset($required)) required @endif
    >{{ old($name) }}</textarea>
  @else
    <input
      type="{{ $type ?? 'text' }}"
      id="{{ $name }}"
      name="{{ $name }}"
      value="{{ old($name) }}"
      @if(isset($help)) aria-describedby="{{ $name }}_help" @endif
      @if(isset($required)) required @endif
    />
  @endif
  @if(isset($help))
    <div id="{{ $name }}_help" class="tooltip-wrapper" role="tooltip">
      <div class="tooltip">
        {{ $help }}
        <div class="arrow" data-popper-arrow></div>
      </div>
    </div>
  @endif
</div>
