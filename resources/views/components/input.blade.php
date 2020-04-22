<div class="text-input" @if(isset($type) && $type === 'select') data-arrow @endif>
  <label for="{{ $name }}" @if(isset($required)) data-required @endif>
    {{ $label }}
  </label>
  @if(isset($type) && $type === 'textarea')
    <textarea
      id="{{ $name }}"
      name="{{ $name }}"
      rows="4"
      @if(isset($help)) aria-describedby="{{ $name }}_help" @endif
      @if(isset($required)) required @endif
      @if(isset($error)) data-error @endif
    >{{ $value ?? old($name) }}</textarea>
  @elseif(isset($type) && $type === 'select')
    <select
      id="{{ $name }}"
      name="{{ $name }}"
      @if(isset($help)) aria-describedby="{{ $name }}_help" @endif
      @if(isset($required)) required @endif
      @if(isset($error)) data-error @endif
    >
      {{ $slot }}
    </select>
  @else
    <input
      type="{{ $type ?? 'text' }}"
      id="{{ $name }}"
      name="{{ $name }}"
      value="{{ $value ?? old($name) }}"
      @if(isset($help)) aria-describedby="{{ $name }}_help" @endif
      @if(isset($required)) required @endif
      @if(isset($multiple)) multiple @endif
      @if(isset($error)) data-error @endif
    />
  @endif
  @if(isset($help))
    <div data-tooltip="{{ $name }}_help" tabindex="0">
      <i class="fas fa-question-circle"></i>
    </div>
  @endif
  @if(isset($help))
    <div id="{{ $name }}_help" class="tooltip-wrapper" role="tooltip">
      <div class="tooltip">
        {{ $help }}
        <div class="arrow" data-popper-arrow></div>
      </div>
    </div>
  @endif
  <div class="input-error">
    {{ $error ?? '' }}
  </div>
</div>
