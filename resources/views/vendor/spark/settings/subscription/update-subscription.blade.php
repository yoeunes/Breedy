<spark-update-subscription :user="user" :team="team"
													 :plans="plans" :billable-type="billableType" inline-template>

	<div>

		<!-- Current Subscription (Active) -->
		<div class="" v-if="activePlan.active">
			<div class="tips tips--success tips--onlyTitle">
				<span>
            <?php echo __('You are currently subscribed to the :planName plan.',
                ['planName' => '{{ activePlan.name }} ({{ __(activePlan.interval) | capitalize }})']); ?>
				</span>
			</div>
		</div>


		<el-card style="position: relative; z-index: 10;">
			<div slot="header" class="with-icon">
				<img src="{{ asset('icons/renew-subscription.svg') }}" width="22" height="22" alt="" class="svg-title">
				<span>{{__('Update Subscription')}}</span>
			</div>

			<!-- Interval Selector Button Group -->
			<el-switch
							class="planSwitch"
							v-model="form.switch"
							active-text="{{ __('Payer par année') }}"
							inactive-text="{{ __('Payer par mois') }}">
			</el-switch>

			<transition name="slide" mode="out-in" key="one">
				<!-- Plan by Month -->
				<div v-if="form.switch == false" class="planCard__container">
					<div class="planCard" v-for="plan in plans" v-if="plan.interval == 'monthly' || plan.price == 0"
							 :class="{'planCard--success': isActivePlan(plan)}">
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
						<el-button v-if="isActivePlan(plan)"
											 icon="el-icon-check"
											 plain
											 :class="{'no-plain--success el-button--success': isActivePlan(plan)}"
											 type="primary"
											 @click="!isActivePlan(plan) ? confirmPlanUpdate(plan) : 0">
							{{ __('Abonné') }}
						</el-button>
						<el-button v-else
											 plain
											 :class="{'no-plain': selectedPlan == plan}"
											 type="primary"
											 @click="!isActivePlan(plan) ? confirmPlanUpdate(plan) : 0">
							{{ __('Changer de plan') }}
						</el-button>

					</div>
				</div>

				<!-- Plan by Year -->
				<div v-if="form.switch == true" key="two" class="planCard__container">

					<div class="planCard" v-for="plan in plans" v-if="plan.interval == 'yearly' || plan.price == 0"
							 :class="{'planCard--success': isActivePlan(plan)}">
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
						<el-button v-if="isActivePlan(plan)"
											 plain
											 :class="{'no-plain--success el-button--success': isActivePlan(plan)}"
											 type="primary"
											 @click="!isActivePlan(plan) ? confirmPlanUpdate(plan) : 0">
							{{ __('Abonné') }}
						</el-button>
						<el-button v-else
											 plain
											 :class="{'no-plain': selectedPlan == plan}"
											 type="primary"
											 @click="!isActivePlan(plan) ? confirmPlanUpdate(plan) : 0">
							{{ __('Changer de plan') }}
						</el-button>
					</div>
				</div>
			</transition>

			<!-- European VAT Notice -->
			@if (Spark::collectsEuropeanVat())
				<p class="planCard__vat">
					{{__('All subscription plan prices include applicable VAT.')}}
				</p>
			@else
				<p class="planCard__vat">
					{{__('All subscription plan prices are excluding applicable VAT.')}}
				</p>
			@endif


			<div class="el-loading-mask" v-if="selectingPlan">
				<div class="el-loading-spinner">
					<svg viewBox="25 25 50 50" class="circular">
						<circle cx="50" cy="50" r="20" fill="none" class="path"></circle>
					</svg>
					<span class="el-loading-text"
								style="display: block; margin-top: 10px;">{{ __('Changement du plan en cours…') }}</span>
				</div>
			</div>
		</el-card>

		<!-- Confirm plan update modal -->
		<el-dialog :visible.sync="dialogUpdatePlanVisible"
							 :lock-scroll="false"
							 width="30%"
							 class="modalChange">
			<span slot="title" class="el-dialog__title">
				{{__('Update Subscription')}}
			</span>
			<p v-if="confirmingPlan">
          <?php echo __('Are you sure you want to switch to the :planName plan ?',
              ['planName' => '<strong>{{ confirmingPlan.name }} ({{ confirmingPlan.interval | capitalize }})</strong>']) ?>
			</p>
			<span slot="footer" class="dialog-footer">
				<el-button @click="dialogUpdatePlanVisible = false">{{__('Cancel')}}</el-button>
				<el-button type="warning"
									 @click="dialogUpdatePlanVisible = false; approvePlanUpdate();">
					{{__('Yes, I\'m Sure')}}
				</el-button>
			</span>
		</el-dialog>
	</div>
</spark-update-subscription>
