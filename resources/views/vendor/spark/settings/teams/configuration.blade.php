<div class="settings-bloc-title">
	<h2 class="title__settings">{{__('Configuration')}}</h2>
</div>

<!-- Manage different types of animals -->
@include('spark::settings.teams.configuration.types')

<!-- Manage the different animals breed -->
@include('spark::settings.teams.configuration.races')

<!-- Manage the different colors breed -->
@include('spark::settings.teams.configuration.colors')
