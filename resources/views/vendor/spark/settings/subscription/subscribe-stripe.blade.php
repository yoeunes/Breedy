<spark-subscribe-stripe :user="user" :team="team"
												:plans="plans" :billable-type="billableType" inline-template>

	<div>
		<!-- Common Subscribe Form Contents -->
	@include('spark::settings.subscription.subscribe-common')


	<!-- Billing Information -->
		<el-card style="position: relative; z-index: 10;" v-show="selectedPlan">
			<div slot="header" class="with-icon">
				<img src="{{ asset('icons/payement-method.svg') }}" width="22" height="22" alt="" class="svg-title">
				<span>{{__('Enregistrer les informations de paiement')}}</span>
			</div>
			<!-- Generic 500 Level Error Message / Stripe Threw Exception -->
			<el-alert
							v-if="form.errors.has('form')"
							type="error"
							title="{{__('Nous avons eu du mal à valider votre carte. Il est possible que votre fournisseur de carte nous empêche de charger la carte. Veuillez contacter votre fournisseur de carte ou votre support client.')}}"
							center>
			</el-alert>

			<div style="max-width: 550px; margin: 0 auto;">

				<el-form class="form" :model="cardForm">
					<!-- Card Name -->
					<el-form-item label="{{__('labels.cardholder_name')}}"
												required
												v-show="form.use_existing_payment_method != '1'"
												:error="cardForm.errors.get('cardholder_name')">
						<el-input v-model="cardForm.name" name="name" id="name"></el-input>
					</el-form-item>

					<!-- Card Number -->
					<el-form-item
									label="{{ __('labels.bank_card') }}"
									v-show="form.use_existing_payment_method != '1'"
									:error="cardForm.errors.get('bank_card')">
						<div id="subscription-card-element"></div>
					</el-form-item>

					<!-- Billing Address Fields -->
					@if (Spark::collectsBillingAddress())
						<el-row>
							<el-col :span="12" style="padding-right: 10px;">
								<!-- Adresse ligne 1 -->
								<el-form-item
												label="{{__('labels.address')}}"
												:error="form.errors.get('address')"
												required
												v-show="form.use_existing_payment_method != '1'">
									<el-input v-model="form.address"></el-input>
								</el-form-item>
							</el-col>
							<el-col :span="12" style="padding-left: 10px;">
								<!-- Adresse ligne 2 -->
								<el-form-item
												label="{{__('Address Line 2')}}"
												:error="form.errors.get('address')"
												v-show="form.use_existing_payment_method != '1'">
									<el-input v-model="form.address_line_2"></el-input>
								</el-form-item>
							</el-col>
						</el-row>

						<el-row>
							<el-col :span="8" style="padding-right: 10px;">
								<!-- City -->
								<el-form-item
												label="{{__('City')}}"
												required
												:error="form.errors.get('city')"
												v-show="form.use_existing_payment_method != '1'">
									<el-input v-model="form.city"></el-input>
								</el-form-item>
							</el-col>
							<el-col :span="8" style="padding-right: 10px;">
								<!-- State -->
								<el-form-item
												label="{{__('State')}}"
												required
												:error="form.errors.get('state')"
												v-show="form.use_existing_payment_method != '1'">
									<el-input v-model="form.state"></el-input>
								</el-form-item>
							</el-col>
							<el-col :span="8">
								<!-- Zip -->
								<el-form-item
												label="{{__('Zip')}}"
												required
												:error="form.errors.get('zip')"
												v-show="form.use_existing_payment_method != '1'">
									<el-input v-model="form.zip"></el-input>
								</el-form-item>
							</el-col>
						</el-row>
						<el-row>
							<el-col :span="12" style="padding-right: 10px;">
								<!-- Country -->
								<el-form-item
												label="{{__('Country')}}"
												required
												:error="form.errors.get('zip')"
												v-show="form.use_existing_payment_method != '1'">
									<el-select v-model="form.country" placeholder="{{ __('Selectionnez votre pays') }}"
														 style="width: 100%;" filterable>
										@foreach (app(Laravel\Spark\Repositories\Geography\CountryRepository::class)->all() as $key => $country)
											<el-option key="{{ $key }}" value="{{ $key }}" label="{{ $country }}"></el-option>
										@endforeach
									</el-select>
								</el-form-item>
							</el-col>
							<el-col :span="12" style="padding-left: 10px;">
								<!-- Coupon Code -->
								<el-form-item
												label="{{__('Coupon')}}"
												:error="form.errors.get('coupon')"
												v-show="form.use_existing_payment_method != '1'">
									<el-input v-model="form.coupon"></el-input>
								</el-form-item>
							</el-col>
						</el-row>

						<el-form-item
										label="{{__('VAT ID')}}"
										:error="form.errors.get('vat_id')"
										v-show="form.use_existing_payment_method != '1'">
							<el-input v-model="form.vat_id"></el-input>
						</el-form-item>

						<!-- Tax / Price Information -->
						<el-alert
										v-if="spark.collectsEuropeanVat && countryCollectsVat && selectedPlan"
										title="Mise à jour du prix incluant la TVA"
										:closable="false"
										type="info">
							<div slot style="margin-top: 10px; font-size: 14px;">
								<strong>{{__('Prix total incluant')}} @{{ taxRate }}% :</strong>
								<span style="font-weight: 700;">@{{ priceWithTax(selectedPlan) | currency }}</span> / Membre / Mois
							</div>
						</el-alert>
					@endif

					<el-button type="primary" @click.prevent="subscribe" size="medium" :loading="form.busy"
										 style="margin-top: 15px;"
										 :disabled="form.busy">
						<span v-if="form.busy">{{__('Subscribing')}}</span>
						<span v-else>{{__('Subscribe')}}</span>
					</el-button>

				</el-form>

			</div>

		</el-card>

	</div>
</spark-subscribe-stripe>
