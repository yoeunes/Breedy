@extends('spark::layouts.app')
@section('custom-class', 'settings-page')
@section('scripts')
	@if (Spark::billsUsingStripe())
		<script src="https://js.stripe.com/v3/"></script>
	@else
		<script src="https://js.braintreegateway.com/v2/braintree.js"></script>
	@endif
@endsection

@section('content')
	<spark-settings :user="user" :teams="teams" inline-template>
		<div class="spark-screen container">
			<div class="item-container">
				<!-- Tabs -->
				<div class="item-nav item-nav--settings" id="settings-aside-container">
					<aside class="el-aside settings-aside" id="settings-aside">
						<div role="menubar" class="nav">

							<!--Mon profil-->
							<a class="items__link active" href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
								<i class="el-icon-tickets"></i>
								{{__('My profile')}}
							</a>

							<!-- Mes élevages -->
							@if (Spark::usesTeams())
								<a class="items__link" href="#{{Spark::teamsPrefix()}}" aria-controls="teams" role="tab"
									 data-toggle="tab">
									<i class="el-icon-tickets"></i>
									{{__('My breedings')}}
								</a>
						@endif


						<!--Sécurité-->
							<a class="items__link" href="#security" aria-controls="security" role="tab" data-toggle="tab">
								<i class="el-icon-tickets"></i>
								{{__('Security')}}
							</a>

							<!--Préférences de application-->
							<a class="items__link" href="#preferences" aria-controls="preferences" role="tab" data-toggle="tab">
								<i class="el-icon-tickets"></i>
								{{__('Application preferences')}}
							</a>

						</div>
					</aside>
				</div>

				<!-- Tab cards -->
				<div class="container-settings">
					<div class="tab-content">
					
						<!--Mon profil-->
						<div role="tabcard" class="tab-pane active" id="profile">
							@include('spark::settings.profile')
						</div>

                    <!-- Mes élevages -->
                    @if (Spark::usesTeams())
                        <div role="tabcard" class="tab-pane" id="{{Spark::teamsPrefix()}}">
                            @include('spark::settings.teams')
                        </div>
                    @endif
                    
                     <!--Securité-->
                    <div role="tabcard" class="tab-pane" id="security">
                        @include('spark::settings.security')
                    </div>

					<!--Mes élevages-->
						<div role="tabcard" class="tab-pane" id="preferences">
							@include('spark::settings.preferences-applications')
						</div>

                   
                </div>
            </div>
        </div>
    </div>
    </div>
    </spark-settings>
@endsection