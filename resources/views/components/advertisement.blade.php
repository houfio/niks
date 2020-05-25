<div class="advertisement" data-href="{{ url("/advertisements/$advertisement->id") }}">
  <div class="advertisement-header">
    <div>
      <h2>
        {{ $advertisement->title }}
      </h2>
      <div class="subtle">
        {{ $advertisement->user->getFullName() }} - {{ $advertisement->created_at->diffForHumans() }}
      </div>
    </div>
    <div class="price">
      {{ $advertisement->cost() ?? '-' }}
    </div>
  </div>
  <div class="categories">
    @if($advertisement->is_asking)
      <div class="type">
        {{ __('views/advertisements.asking') }}
      </div>
    @endif
    @foreach($advertisement->categories as $category)
      <div>
        {{ $category->category }}
      </div>
    @endforeach
  </div>
  <div class="advertisement-description">
    {{ $advertisement->short_description }}
    @if($advertisement->enable_bidding)
      <div class="subtle">
        Bieden mogelijk
      </div>
    @endif
  </div>
  @if(count($advertisement->assets) > 0)
    <div>
      <img src="{{ $advertisement->assets->first()->url() }}" class="image"/>
    </div>
  @endif
</div>
