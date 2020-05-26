@foreach($children as $child)
  <div style="display: flex">
    <a
      class="category"
      style="margin-left: {{ $depth }}rem"
      href="{{ action('CategoryController@edit', ['category' => $child['id']]) }}"
    >
      <label>
        {{ $child['category'] }}
      </label>
    </a>
    <form method="post" action="{{ @action('CategoryController@destroy', ['category' => $child['id']]) }}" class="center-items">
      @csrf
      @method('delete')
      <button dusk="delete_interview_{{ $child['id'] }}" type="submit">
        <i class="fas fa-trash"></i>
      </button>
    </form>
  </div>
  <x-admin-category :parent="$child['id']" :children="$child['children']" :depth="$depth + 1"/>
@endforeach
