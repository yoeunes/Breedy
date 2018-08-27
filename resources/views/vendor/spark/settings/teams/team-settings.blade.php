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
	<spark-team-settings :user="user" :team-id="{{ $team->id }}" inline-template>

		<div class="spark-screen container">
			<div class="item-container">
				<!-- Tabs -->
				<div class="item-nav item-nav--settings" id="settings-aside-container">
					<aside class="el-aside settings-aside" id="settings-aside">
						<div role="menubar" class="nav">
						@if (Auth::user()->ownsTeam($team))
							<!-- Profile de l’élevage -->
								<a class="items__link active" href="#owner" aria-controls="owner" role="tab" data-toggle="tab">
									<i class="el-icon-tickets"></i>
									{{__('Breeding profile')}}
								</a>
						@endif

						<!-- Paramètres -->
							<a class="items__link" href="#configuration" aria-controls="configuration" role="tab" data-toggle="tab">
								<i class="el-icon-tickets"></i>
								{{__('Configuration')}}
							</a>

							<!-- Membres -->
							<a class="items__link" href="#membership" aria-controls="membership" role="tab" data-toggle="tab">
								<i class="el-icon-tickets"></i>
								{{__('Members')}}
							</a>
							@if (Spark::canBillTeams() && Auth::user()->ownsTeam($team))
								<li>
									<h3 class="title__subtitle">
										{{__('Subscription management')}}
									</h3>
								</li>
								<!-- Abonnement -->
								<a class="items__link" href="#subscription" aria-controls="subscription" role="tab" data-toggle="tab">
									<i class="el-icon-tickets"></i>
									{{__('Subscription')}}
								</a>
								<a class="items__link" href="#payment-method" aria-controls="payment-method" role="tab"
									 data-toggle="tab">
									<i class="el-icon-tickets"></i>
									{{__('Méthode de payement')}}
								</a>
								<a class="items__link" href="#invoices" aria-controls="invoices" role="tab" data-toggle="tab">
									<i class="el-icon-tickets"></i>
									{{__('Factures')}}
								</a>
							@endif

						</div>
					</aside>
				</div>

				<!-- Tab cards -->
				<div class="container-settings">
					<div class="tab-content">

						<!-- Owner Information -->
						@if (Auth::user()->ownsTeam($team))
							<div role="tabcard" class="tab-pane active" id="owner">
								@include('spark::settings.teams.team-profile')
							</div>
						@endif

					<!-- Configuration -->
						<div role="tabcard" class="tab-pane" id="configuration">
							@include('spark::settings.teams.configuration')
						</div>

						<!-- Membership -->
						@if (Auth::user()->ownsTeam($team))
							<div role="tabcard" class="tab-pane" id="membership">
								@else
									<div role="tabcard" class="tab-pane active" id="membership">
										@endif
										<div v-if="team">
											@include('spark::settings.teams.team-membership')
										</div>
									</div>

									<!-- Billing Tab Panes -->
									@if (Spark::canBillTeams() && Auth::user()->ownsTeam($team))
										@if (Spark::hasPaidTeamPlans())
										<!-- Subscription -->
											<div role="tabcard" class="tab-pane" id="subscription">
												<div v-if="user && team">
													@include('spark::settings.subscription')
												</div>
											</div>
										@endif

									<!-- Payment Method -->
										<div role="tabcard" class="tab-pane" id="payment-method">
											<div v-if="user && team">
												@include('spark::settings.payment-method')
											</div>
										</div>

										<!-- Invoices -->
										<div role="tabcard" class="tab-pane" id="invoices">
											<div v-if="user && team">
												@include('spark::settings.invoices')
											</div>
										</div>
									@endif
							</div>
					</div>
				</div>
			</div>
		</div>
	</spark-team-settings>
@endsection
