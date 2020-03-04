<a class="navigation-item{{ Request::is($path) ? ' active' : '' }}" href="{{ url($path)  }}">
  <i class="fas fa-{{ $icon }} fa-fw"></i>
  <span class="content">
    {{ $slot  }}
  </span>
</a>
