<el-card style="position: relative; z-index: 10;">
	<div slot="header" class="with-icon">
		<img src="{{ asset('icons/renew-subscription.svg') }}" width="22" height="22" alt="" class="svg-title">
		<span>{{__('Souscrire')}}</span>
	</div>


	<!-- Interval Selector Button Group -->
	<el-switch 
					class="planSwitch"
					v-model="switchForm.switch"
					active-text="{{ __('Payer par année') }}"
					inactive-text="{{ __('Payer par mois') }}">
	</el-switch>

	<!-- Plan error message -->
	<el-alert
					v-if="form.errors.has('plan')"
					type="error"
					:title="form.errors.get('form')"
					style="position:relative; top:-15px;"
					center>
	</el-alert>
	<el-alert
					v-if="form.errors.has('form')"
					type="error"
					title="{{__('Nous avons eu du mal à valider votre carte. Il est possible que votre fournisseur de carte nous empêche de charger la carte. Veuillez contacter votre fournisseur de carte ou votre support client.')}}"
					style="position:relative; top:-15px;"
					center>
	</el-alert>


	<transition name="slide" mode="out-in" key="one">
		<!-- Plan by Month -->
		<div v-if="switchForm.switch == false" class="planCard__container">
			<div class="planCard" v-for="plan in plans" v-if="plan.interval == 'monthly' || plan.price == 0"
					 :class="{'planCard--success': isActivePlan(plan)}">
				<strong class="planCard__name">@{{ plan.name }}</strong>
				<div class="planCard__pricing">
					<span class="planCard__currency">€</span>
					<span class="planCard__price">
						@{{ plan.price }}
					</span>
				</div>

				<span class="planCard__type" v-if="plan.price > 0">{{__('/membre/mois')}}</span>
				<span class="planCard__type" v-else>{{__('gratuit à vie')}}</span>

				<div class="planCard__feature">
					<span v-for="feature in plan.features">@{{ feature }}</span>
					<a href="#" class="el-button el-button--text" v-if="plan.price > 0">Fonctionnalités premium</a>
					<span href="#" class="el-button el-button--text" v-else>
						<del>{{__('Fonctionnalités premium')}}</del>
					</span>
				</div>
				<el-button
								v-if="plan.price > 0"
								plain
								:class="{'no-plain--success el-button--success': isActivePlan(plan)}"
								type="primary"
								@click="selectPlan(plan)">
					{{ __('Souscrire') }}
				</el-button>
				<el-tooltip class="item"
										popper-class="button-tooltip"
										effect="dark"
										content="{{ __('Vous serez automatiquement inscrit au plan gratuit à la fin de votre période d’essais.') }}"
										placement="top">
					<span class="wrapper__el-button">
					<el-button
									v-if="plan.price == 0 && subscriptionIsOnTrial"
									plain
									disabled
									:class="{'no-plain--success el-button--success': isActivePlan(plan)}"
									type="primary"
									@click="selectPlan(plan)">
						{{ __('Souscrire') }}
					</el-button>
					</span>
				</el-tooltip>
			</div>
		</div>


		<!-- Plan by Year -->
				<div v-if="switchForm.switch == true" key="two" class="planCard__container">

					<div class="planCard" v-for="plan in plans" v-if="plan.interval == 'yearly' || plan.price == 0"
							 :class="{'planCard--success': isActivePlan(plan)}">
						<div class="planCard__promoWrapper">
							<sup class="el-badge__content planCard__promo" v-if="plan.price > 0">{{__('2 mois gratuits')}}</sup>
						</div>
						<strong class="planCard__name">@{{ plan.name }}</strong>
						<div class="planCard__pricing">
							<span class="planCard__currency">€</span>
							<span class="planCard__price">
								@{{ plan.price }}
							</span>
						</div>

						<span class="planCard__type" v-if="plan.price > 0">{{__('/membre/an')}}</span>
						<span class="planCard__type" v-else>{{__('gratuit à vie')}}</span>

						<div class="planCard__feature">
							<span v-for="feature in plan.features">@{{ feature }}</span>
							<a href="#" class="el-button el-button--text"
								 v-if="plan.price > 0">{{__('Fonctionnalités premium')}}</a>
							<span href="#" class="el-button el-button--text" v-else>
								<del>{{__('Fonctionnalités premium')}}</del>
							</span>
						</div>
						<el-button
										v-if="plan.price > 0"
										plain
										:class="{'no-plain--success el-button--success': isActivePlan(plan)}"
										type="primary"
										@click="selectPlan(plan)">
							{{ __('Souscrire') }}
						</el-button>
						<el-tooltip class="item"
												popper-class="button-tooltip"
												effect="dark"
												content="{{ __('Vous serez automatiquement inscrit au plan gratuit à la fin de votre période d’essais.') }}"
												placement="top">
							<span class="wrapper__el-button">
								<el-button
												v-if="plan.price == 0 && subscriptionIsOnTrial"
												plain
												disabled
												:class="{'no-plain--success el-button--success': isActivePlan(plan)}"
												type="primary"
												@click="selectPlan(plan)">
									{{ __('Souscrire') }}
								</el-button>
							</span>
						</el-tooltip>
					</div>
				</div>
	</transition>

	<!-- European VAT Notice -->
	@if (Spark::collectsEuropeanVat())
		<p class="planCard__vat">
			{{__('Tous les prix des forfaits sont hors TVA.')}}
		</p>
@endif

<!-- Loading -->
	<div class="el-loading-mask" v-if="form.busy">
		<div class="el-loading-spinner">
			<svg viewBox="25 25 50 50" class="circular">
				<circle cx="50" cy="50" r="20" fill="none" class="path"></circle>
			</svg>
			<span class="el-loading-text"
						style="display: block; margin-top: 10px;">{{ __('Souscription en cours…') }}</span>
		</div>
	</div>

</el-card>
