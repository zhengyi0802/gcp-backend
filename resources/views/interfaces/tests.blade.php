@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('interfaces.header') }}</h1>
@stop

@section('content')
<div class="card-group">
    <x-adminlte-input id="mac" name="mac" label="{{ __('interfaces.mac') }}" fgroup-class="col-md-4"
      value="{{ $mac }}" />
    <x-adminlte-select id="project" name="project" label="{{ __('interfaces.project') }}" fgroup-class="col-md-4" >
      @foreach($projects as $project)
      <option value="{{ $project->id }}" {{ (isset($project_id) && ($project_id == $project->id)) ? "selected" : null }} >
        {{ $project->name }}
      </option>
      @endforeach
    </x-adminlte-select>
    <x-adminlte-select id="content" name="content" label="{{ __('interfaces.content') }}" fgroup-class="col-md-4"
      onchange="">
      <option value="" >---</option>
      <option value="{{ App\Enums\Content::Logo }}" >{{ __('interfaces.logo') }}</option>
      <option value="{{ App\Enums\Content::Startpage }}" >{{ __('interfaces.startpage') }}</option>
      <option value="{{ App\Enums\Content::Homepage }}" >{{ __('interfaces.mainpage') }}</option>
      <option value="{{ App\Enums\Content::Business }}" >{{ __('interfaces.business') }}</option>
      <option value="{{ App\Enums\Content::Advertising }}" >{{ __('interfaces.advertising') }}</option>
      <option value="{{ App\Enums\Content::MainVideo }}" >{{ __('interfaces.mainvideo') }}</option>
      <option value="{{ App\Enums\Content::AppMenu }}" >{{ __('interfaces.appmenu') }}</option>
      <option value="{{ App\Enums\Content::Menu }}" >{{ __('interfaces.menu') }}</option>
      <option value="{{ App\Enums\Content::VoiceSetting }}" >{{ __('interfaces.voicesetting') }}</option>
      <option value="{{ App\Enums\Content::AppMarket }}" >{{ __('interfaces.appmarket') }}</option>
      <option value="{{ App\Enums\Content::HotApp }}" >{{ __('interfaces.hotapp') }}</option>
      <option value="{{ App\Enums\Content::OneKeyInstaller }}" >{{ __('interfaces.onekeyinstaller') }}</option>
      <option value="{{ App\Enums\Content::CustomerSupport }}" >{{ __('interfaces.customersupport') }}</option>
      <option value="{{ App\Enums\Content::Marquee }}A" >{{ __('interfaces.marquee1') }}</option>
      <option value="{{ App\Enums\Content::Marquee }}P" >{{ __('interfaces.marquee2') }}</option>
      <option value="{{ App\Enums\Content::QA }}" >{{ __('interfaces.qa') }}</option>
      <option value="{{ App\Enums\Content::AppMarketAdvertising }}" >{{ __('interfaces.appad') }}</option>
      <option value="{{ App\Enums\Content::ApkManager }}" >{{ __('interfaces.apk_update') }}</option>
      <option value="{{ App\Enums\Content::CheckDate }}" >{{ __('interfaces.checkdate') }}</option>
      <option value="{{ App\Enums\Content::Shopping }}" >{{ __('interfaces.shopping') }}</option>

    </x-adminlte-select>
    <script>
        document.getElementById('content').addEventListener('change', function() {
            var project_id = document.getElementById('project').value;
            var mac = document.getElementById('mac').value;
            if (this.value == '{{ App\Enums\Content::Marquee }}A') {
                window.location = "/interfaces/tests?mac=" + mac + "&type=3&content=" + {{ App\Enums\Content::Marquee }};
            } else if (this.value == '{{ App\Enums\Content::Marquee }}P') {
                window.location = "/interfaces/tests?mac=" + mac + "&type=2&content=" + {{ App\Enums\Content::Marquee }};
            } else if (this.value == '{{ App\Enums\Content::ApkManager }}') {
                window.location = "/interfaces/tests?package_name=tw.com.mundi.joylife&mac=" + mac + "&content=" + this.value;
            } else {
                if (mac != "") {
                    window.location = "/interfaces/tests?mac=" + mac + "&content=" + this.value;
                } else {
                    window.location = "/interfaces/tests?project_id=" + project_id + "&content=" + this.value;
                }
            }
        }, false);
    </script>
</div>
<div class="card-group">
      <x-adminlte-card title="{{ __('interfaces.query') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       <div id="query">{{ $query }}</div>
      </x-adminlte-card>
</div>
<div class="card-group">
      <x-adminlte-card title="{{ __('interfaces.result') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       <div id="result">{{ $result }}</div>
      </x-adminlte-card>
</div>
@stop
