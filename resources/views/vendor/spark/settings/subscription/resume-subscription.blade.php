<spark-resume-subscription :user="user" :team="team"
													 :plans="plans" :billable-type="billableType" inline-template>

	<div>
		<div class="tips tips--warning">
			<span>
          <?php echo __('You have cancelled your subscription to the :planName plan.',
              ['planName' => '{{ activePlan.name }} ({{ activePlan.interval | capitalize }})']); ?>
			</span>
			<p>
          <?php echo __('The benefits of your subscription will continue until your current billing period ends on :date. You may resume your subscription at no extra cost until the end of the billing period.',
              ['date' => '<strong>{{ activeSubscription.ends_at | date }}</strong>']); ?>
			</p>
		</div>

		<el-card style="position: relative; z-index: 10;">
			<div slot="header" class="with-icon">
				<img src="{{ asset('icons/renew-subscription.svg') }}" width="22" height="22" alt="" class="svg-title">
				<span>{{__('Resume Subscription')}}</span>
			</div>

			<!-- Interval Selector Button Group -->
			<el-switch
							class="planSwitch"
							v-model="switchForm.switch"
							active-text="{{ __('Payer par année') }}"
							inactive-text="{{ __('Payer par mois') }}">
			</el-switch>

			<transition name="slide" mode="out-in" key="one">
				<!-- Plan by Month -->
				<div v-if="switchForm.switch == false" class="planCard__container">
					<div class="planCard" v-for="plan in plans" v-if="plan.interval == 'monthly' || plan.price == 0"
							 :class="{'planCard--resume': isActivePlan(plan)}">
						<strong class="planCard__name">@{{ plan.name }}</strong>
						<div class="planCard__pricing">
							<span class="planCard__currency">€</span>
							<span class="planCard__price">
								@{{ Math.round(priceWithTax(plan) * 100) / 100 }}
							</span>
						</div>

						<span class="planCard__type" v-if="plan.price > 0">/membre/mois</span>
						<span class="planCard__type" v-else>gratuit à vie</span>

						<div class="planCard__feature">
							<span v-for="feature in plan.features">@{{ feature }}</span>
							<a href="#" class="el-button el-button--text" v-if="plan.price > 0">Fonctionnalités premium</a>
							<span href="#" class="el-button el-button--text" v-else>
								<del>Fonctionnalités premium</del>
							</span>
						</div>
						<el-button
										v-if="plan.price > 0"
										plain
										:class="{'el-button--warning': isActivePlan(plan)}"
										type="primary"
										@click="updateSubscription(plan)">
							<span v-if="selectingPlan === plan">
								<i class="el-icon-loading"></i> {{__('Resuming')}}
							</span>

							<span v-if="! isActivePlan(plan) && selectingPlan !== plan">
								{{__('Switch')}}
							</span>

							<span v-if="isActivePlan(plan) && selectingPlan !== plan">
								{{__('Resume')}}
							</span>
						</el-button>
						<el-tooltip class="item"
												popper-class="button-tooltip"
												effect="dark"
												content="{{ __('Vous serez automatiquement inscrit au plan gratuit à la fin de votre période de facturation actuelle à moins que vous repreniez votre abonnement.') }}"
												placement="top">
							<span class="wrapper__el-button">
								<el-button
												v-if="plan.price == 0"
												plain
												disabled
												:class="{'no-plain--success el-button--success': isActivePlan(plan)}"
												type="primary"
												@click="selectPlan(plan)">
									{{ __('Switch') }}
								</el-button>
							</span>
						</el-tooltip>
					</div>
				</div>


				<!-- Plan by Year -->
				<div v-if="switchForm.switch == true" key="two" class="planCard__container">

					<div class="planCard" v-for="plan in plans" v-if="plan.interval == 'yearly' || plan.price == 0"
							 :class="{'planCard--warning': isActivePlan(plan)}">
						<div class="planCard__promoWrapper">
							<sup class="el-badge__content planCard__promo" v-if="plan.price > 0">2 mois gratuits</sup>
						</div>
						<strong class="planCard__name">@{{ plan.name }}</strong>
						<div class="planCard__pricing">
							<span class="planCard__currency">€</span>
							<span class="planCard__price">
								@{{ Math.round(priceWithTax(plan) * 100) / 100 }}
							</span>
						</div>

						<span class="planCard__type" v-if="plan.price > 0">/membre/an</span>
						<span class="planCard__type" v-else>gratuit à vie</span>

						<div class="planCard__feature">
							<span v-for="feature in plan.features">@{{ feature }}</span>
							<a href="#" class="el-button el-button--text"
								 v-if="plan.price > 0">{{ __('Fonctionnalités premium') }}</a>
							<span href="#" class="el-button el-button--text" v-else>
								<del>{{ __('Fonctionnalités premium') }}</del>
							</span>
						</div>
						<el-button
										v-if="plan.price > 0"
										plain
										:class="{'el-button--warning': isActivePlan(plan)}"
										type="primary"
										@click="updateSubscription(plan)">

							<span v-if="selectingPlan === plan">
								<i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Resuming')}}
							</span>

							<span v-if="! isActivePlan(plan) && selectingPlan !== plan">
								{{__('Switch')}}
							</span>

							<span v-if="isActivePlan(plan) && selectingPlan !== plan">
								{{__('Resume')}}
							</span>
						</el-button>


						<el-tooltip class="item"
												popper-class="button-tooltip"
												effect="dark"
												content="{{ __('Vous serez automatiquement inscrit au plan gratuit à la fin de votre période de facturation actuelle à moins que vous repreniez votre abonnement.') }}"
												placement="top">
							<span class="wrapper__el-button">
								<el-button
												v-if="plan.price == 0"
												plain
												disabled
												:class="{'no-plain--success el-button--success': isActivePlan(plan)}"
												type="primary"
												@click="selectPlan(plan)">
									{{ __('Switch') }}
								</el-button>
							</span>
						</el-tooltip>
					</div>
				</div>
			</transition>

			<!-- European VAT Notice -->
			@if (Spark::collectsEuropeanVat())
				<p class="planCard__vat">
					{{__('All subscription plan prices are excluding applicable VAT.')}}
				</p>
			@endif


		</el-card>


		<div class="card card-default">
			<div class="card-header">
				<div class="float-left" :class="{'btn-table-align': hasMonthlyAndYearlyPlans}">
					{{__('Resume Subscription')}}
				</div>

				<!-- Interval Selector Button Group -->
				<div class="float-right">
					<div class="btn-group btn-group-sm" v-if="hasMonthlyAndYearlyPlans">
						<!-- Monthly Plans -->
						<button type="button" class="btn btn-light"
										@click="showMonthlyPlans"
										:class="{'active': showingMonthlyPlans}">

							{{__('Monthly')}}
						</button>

						<!-- Yearly Plans -->
						<button type="button" class="btn btn-light"
										@click="showYearlyPlans"
										:class="{'active': showingYearlyPlans}">

							{{__('Yearly')}}
						</button>
					</div>
				</div>

				<div class="clearfix"></div>
			</div>

			<div class="table-responsive">
				<!-- Plan Error Message - In General Will Never Be Shown -->
				<div class="alert alert-danger mb-4" v-if="planForm.errors.has('plan')">
					@{{ planForm.errors.get('plan') }}
				</div>

				<!-- Cancellation Information -->
				<div class="m-4">
            <?php echo __('You have cancelled your subscription to the :planName plan.',
                ['planName' => '{{ activePlan.name }} ({{ activePlan.interval | capitalize }})']); ?>
				</div>

				<div class="m-4">
            <?php echo __('The benefits of your subscription will continue until your current billing period ends on :date. You may resume your subscription at no extra cost until the end of the billing period.',
                ['date' => '{{ activeSubscription.ends_at | date }}']); ?>
				</div>

				<!-- European VAT Notice -->
				@if (Spark::collectsEuropeanVat())
					<p class="m-4">
						{{__('All subscription plan prices include applicable VAT.')}}
					</p>
				@endif

				<table class="table table-responsive-sm table-valign-middle mb-0 ">
					<thead></thead>
					<tbody>
					<tr v-for="plan in paidPlansForActiveInterval">
						<!-- Plan Name -->
						<td>
							<div class="d-flex align-items-center">
								@{{ plan.name }}
							</div>
						</td>

						<!-- Plan Features Button -->
						<td>
							<button class="btn btn-default" @click="showPlanDetails(plan)">
								<i class="fa fa-btn fa-star-o"></i> {{__('Features')}}
							</button>
						</td>

						<!-- Plan Price -->
						<td>
							<div class="btn-table-align">
								<strong class="table-plan-price">@{{ priceWithTax(plan) | currency }}</strong>
								@{{ plan.type == 'user' && spark.chargesUsersPerSeat ? '/ '+ spark.seatName : '' }}
								@{{ plan.type == 'user' && spark.chargesUsersPerTeam ? '/ '+ __('teams.team') : '' }}
								@{{ plan.type == 'team' && spark.chargesTeamsPerSeat ? '/ '+ spark.teamSeatName : '' }}
								@{{ plan.type == 'team' && spark.chargesTeamsPerMember ? '/ '+ __('teams.member') : '' }}
								/ @{{ __(plan.interval) | capitalize }}
							</div>
						</td>

						<!-- Plan Select Button -->
						<td class="text-right">
							<button class="btn btn-plan"
											v-bind:class="{'btn-default': ! isActivePlan(plan), 'btn-warning': isActivePlan(plan)}"
											@click="updateSubscription(plan)"
											:disabled="selectingPlan">

								<span v-if="selectingPlan === plan">
									<i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Resuming')}}
								</span>

								<span v-if="! isActivePlan(plan) && selectingPlan !== plan">
									{{__('Switch')}}
								</span>

								<span v-if="isActivePlan(plan) && selectingPlan !== plan">
									{{__('Resume')}}
								</span>
							</button>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</spark-resume-subscription>
