@extends('layouts.app')

@section('title', __('views/register.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('views/register.title') }}
    </h1>
    <div class="page-subheadings">
      <span>
        Om het handelen in onze ruilkring zo lokaal en sociaal mogelijk te houden beperken wij registraties tot de
        omgeving 's-Hertogenbosch. Dit zorgt ervoor dat onze ruilkring klein en gezellig blijft!
      </span>
      <span>
        Nadat je je aanmelding hieronder hebt ingevuld wordt er een intakegesprek gepland. Tijdens dit gesprek proberen
        we je te leren kennen en laten we je (mogelijk) toe tot onze leuke en uiterst gezellige ruilkring.
      </span>
      <span>
        We hopen je aanmelding snel te ontvangen! Mocht je vragen hebben, stel deze dan gerust via ons contact formulier
        op de website.
      </span>
    </div>
    <x-errors/>
    <form method="post" action="{{ @action('Auth\RegisterController@register') }}">
      @csrf
      <div class="two-columns">
        <x-input name="first_name" :label="__('general/attributes.first_name')" required/>
        <x-input
          name="last_name"
          :label="__('general/attributes.last_name')"
          help="Achternaam inclusief tussenvoegsel(s)"
          required
        />
        <x-input name="email" type="email" :label="__('general/attributes.email')" required/>
        <x-input
          name="phone_number"
          :label="__('general/attributes.phone_number')"
          help="Telefoonnummer in een Nederlands formaat (bijv. 06 12345678)"
          required
        />
        <x-input
          name="zip_code"
          :label="__('general/attributes.zip_code')"
          help="Postcode in een Nederlands formaat (bijv. 1234 AB)"
          required
        />
        <x-input
          name="house_number"
          :label="__('general/attributes.house_number')"
          help="Huisnummer inclusief toevoeging(en)"
          required
        />
      </div>
      <x-input
        name="motivation"
        type="textarea"
        :label="__('general/attributes.motivation')"
        help="Motivatie waarom je graag mee wilt doen met Niksvoorniks (minimaal 60 karakters)"
        required
      />
      <button class="button" type="submit" name="register">
        {{ __('views/register.title') }}
      </button>
      <a class="button transparent" href="{{ url('login') }}">
        {{ __('views/login.title') }}
      </a>
    </form>
  </div>
@endsection
