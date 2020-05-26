@foreach($children as $child)
  <div class="two-columns">
    <div class="category margin-bottom-0" style="margin-left: {{ $depth }}rem" data-href="{{ @action('CategoryController@edit', ['category' => $child['id']]) }}">
      <label class="category orange margin-bottom-0" for="category_{{ $child['id'] }}">{{ $child['category'] }}</label>
    </div>
    <form action="{{ @action('CategoryController@destroy', ['category' => $child['id']]) }}" method="post">
      @csrf
      @method('delete')
      <button dusk="delete_interview_{{ $child['id'] }}" class="button" type="submit">
        <i class="fas fa-trash"></i>
      </button>
    </form>
  </div>
  <x-admin-category :parent="$child['id']" :children="$child['children']" :depth="$depth + 2"/>
@endforeach
