@extends('layouts.app')

@section('theme', 'dark')

@section('title', __('views/users.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('views/users.title') }}
    </h1>
    <x-errors/>
  </div>
  <h4 class="page-heading">
    Geverifieerde gebruikers
  </h4>
  <table class="table table-fixed table-striped table-hover">
    <thead>
    <td>
      Naam
    </td>
    <td>
      Email
    </td>
    <td>
      Telefoonnummer
    </td>
    </thead>
    @foreach($approved_users as $user)
      <tr data-href="{{ url("/users/$user->id/edit") }}">
        <td>
          {{ $user->getFullName() }}
        </td>
        <td>
          {{ $user->email }}
        </td>
        <td>
          {{ $user->phone_number }}
        </td>
      </tr>
    @endforeach
  </table>

  <h4 class="page-heading">
    Gebruikers in afwachting
  </h4>
  <table class="table table-fixed table-striped table-hover">
    <thead>
    <tr>
      <td>
        Naam
      </td>
      <td>
        Email
      </td>
      <td>
        Telefoonnummer
      </td>
      <td>
        Acties
      </td>
    </tr>
    </thead>
    <tbody>
    @foreach($pending_users as $user)
      <tr data-href="{{ url("/users/$user->id/edit") }}">
        <td>
          {{ $user->getFullName() }}
        </td>
        <td>
          {{ $user->email }}
        </td>
        <td>
          {{ $user->phone_number }}
        </td>
        <td>
          <form action="{{ @action('Auth\ApproveController@approve', ['user' => $user]) }}" method="post">
            @csrf
            @method('put')
            <div>
              <button type="submit" name="approve" value="1" class="button" dusk="approve_{{ $user->id }}">
                Goedkeuren
              </button>
              <button type="submit" name="approve" value="0" class="button" dusk="disapprove_{{ $user->id }}">
                Afkeuren
              </button>
            </div>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection
