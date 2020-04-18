<a dusk="{{ $duskSelector ?? '' }}" class="navigation-item{{ Request::is($path) ? ' active' : '' }}" href="{{ url($path)  }}" @if(isset($dot)) data-dot @endif>
  <i class="fas fa-{{ $icon }} fa-fw"></i>
  <span class="content">
    {{ $slot  }}
  </span>
</a>
