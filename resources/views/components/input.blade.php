<div class="text-input @if(isset($light)) light @endif" @if(isset($type) && $type === 'select') data-arrow @endif>
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
      @if(isset($disabled)) disabled @endif
    >{{ $value ?? old($name) ?? request()->get($name) }}</textarea>
  @elseif(isset($type) && $type === 'select')
    <select
      id="{{ $name }}"
      name="{{ $name }}"
      @if(isset($help)) aria-describedby="{{ $name }}_help" @endif
      @if(isset($required)) required @endif
      @if(isset($error)) data-error @endif
      @if(isset($disabled)) disabled @endif
    >
      {{ $slot }}
    </select>
  @else
    <input
      type="{{ $type ?? 'text' }}"
      id="{{ $name }}"
      name="{{ $name }}"
      value="{{ $value ?? old($name) ?? request()->get($name) }}"
      @if(isset($help)) aria-describedby="{{ $name }}_help" @endif
      @if(isset($required)) required @endif
      @if(isset($multiple)) multiple @endif
      @if(isset($error)) data-error @endif
      @if(isset($disabled)) disabled @endif
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
