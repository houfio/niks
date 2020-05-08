@extends('layouts.app')

@can('edit-all')
  @section('theme', 'dark')
@endcan

@section('title', __('views/updateUser.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('views/updateUser.title', ['fullName' => "$user->first_name $user->last_name"]) }}
    </h1>
    <x-errors/>
    <form method="post" action="{{ @action('UserController@update', ['user' => $user->id]) }}">
      @csrf
      @method('put')
      <div class="two-columns">
        <x-input
          name="first_name"
          :value="$user->first_name"
          :label="__('general/attributes.first_name')"
          required
        />
        <x-input
          name="last_name"
          :value="$user->last_name"
          :label="__('general/attributes.last_name')"
          required
        />
      </div>
      <x-input
        name="email"
        type="email"
        :value="$user->email"
        :label="__('general/attributes.email')"
        required
      />
      <div class="two-columns">
        <x-input
          name="zip_code"
          :value="$user->zip_code"
          :label="__('general/attributes.zip_code')"
          required
        />
        <x-input
          name="house_number"
          :value="$user->house_number"
          :label="__('general/attributes.house_number')"
          required
        />
        <x-input
          name="phone_number"
          :value="$user->phone_number"
          :label="__('general/attributes.phone_number')"
          required
        />
        <x-input
          name="neighbourhood"
          :value="$user->neighbourhood"
          :label="__('general/attributes.neighbourhood')"
        />
        @can('edit-all')
          <div class="checkbox-input">
            <input type="checkbox" id="is_approved" name="is_approved" @if($user->is_approved) checked @endif/>
            <label for="is_approved" dusk="approved">{{ __('general/attributes.is_approved') }}</label>
          </div>
          <div class="checkbox-input">
            <input type="checkbox" id="is_admin" name="is_admin" @if($user->is_admin) checked @endif/>
            <label for="is_admin" dusk="admin">{{ __('general/attributes.is_admin') }}</label>
          </div>
        @endcan
      </div>
      <div class="button-group">
        <button type="submit" class="button" name="edit">
          {{ __('views/updateUser.submit') }}
        </button>
        <button type="button" class="button light" data-micromodal-trigger="delete-modal">
          {{ __('views/updateUser.delete') }}
        </button>
      </div>
    </form>
    <div>
      <form method="post" action="{{ @action('UserController@destroy', ['user' => $user->id]) }}" id="deleteForm">
        @csrf
        @method('delete')
        <x-modal id="delete" :title="__('views/updateUser.delete')">
          <p>
            {{ __('views/updateUser.delete_user') }}
          </p>
          <x-input
            name="confirmation"
            :label="__('views/updateUser.confirmation_label', ['email' => $user->email])"
            :error="__('views/updateUser.input_error')"
            required
          />
          <div class="button-group">
            <button type="button" class="button danger" id="deleteSubmit">{{ __('views/updateUser.confirm') }}</button>
            <button
              type="button"
              class="button light"
              data-micromodal-close
            >
              {{ __('views/updateUser.cancel') }}
            </button>
          </div>
        </x-modal>
      </form>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    const confirmation = '{{ __('views/updateUser.delete') }}';
  </script>
  <script src="{{ mix('/js/confirm.js') }}"></script>
@endsection
