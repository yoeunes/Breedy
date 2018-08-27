<spark-update-payment-method-stripe :user="user" :team="team" :billable-type="billableType" inline-template>

	<div>

		<el-card>
			<div slot="header" class="with-icon">
				<img src="{{ asset('icons/update-payment.svg') }}" width="22" height="22" alt="" class="svg-title">
				<span>{{__('Update Payment Method')}}</span>
				<div style="margin-left: auto;">
					<span v-if="billable.card_last_four">
						<i :class="['fa', 'fa-btn', cardIcon]"></i>
						************@{{ billable.card_last_four }}
					</span>
				</div>
			</div>

			<el-alert v-if="form.successful"
								title="{{__('Your card has been updated.')}}"
								type="success"
								show-icon>
			</el-alert>

			<el-alert v-if="form.errors.has('form')"
								title="{{__('We had trouble updating your card. It\'s possible your card provider is preventing us from charging the card. Please contact your card provider or customer support.')}}"
								type="error"
								show-icon>
			</el-alert>

			<el-form class="form" :model="cardForm">
				<!-- Card Name -->
				<el-form-item label="{{__('Cardholder’s Name')}}"
											required
											:error="cardForm.errors.get('name')">
					<el-input v-model="cardForm.name" name="name" id="name"></el-input>
				</el-form-item>

				<!-- Card Number -->
				<el-form-item
								label="{{ __('Carte bancaire') }}"
								:error="cardForm.errors.get('card')">
					<div id="payment-card-element"></div>
				</el-form-item>

				<!-- Billing Address Fields -->
				@if (Spark::collectsBillingAddress())
					<el-row>
						<el-col :span="12" style="padding-right: 10px;">
							<!-- Adresse ligne 1 -->
							<el-form-item
											label="{{__('Address')}}"
											:error="form.errors.get('address')"
											required>
								<el-input v-model="form.address"></el-input>
							</el-form-item>
						</el-col>
						<el-col :span="12" style="padding-left: 10px;">
							<!-- Adresse ligne 2 -->
							<el-form-item
											label="{{__('Address Line 2')}}">
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
											:error="form.errors.get('city')">
								<el-input v-model="form.city"></el-input>
							</el-form-item>
						</el-col>
						<el-col :span="8" style="padding-right: 10px;">
							<!-- State -->
							<el-form-item
											label="{{__('State')}}"
											required
											:error="form.errors.get('state')">
								<el-input v-model="form.state"></el-input>
							</el-form-item>
						</el-col>
						<el-col :span="8">
							<!-- Zip -->
							<el-form-item
											label="{{__('Zip')}}"
											required
											:error="form.errors.get('zip')">
								<el-input v-model="form.zip"></el-input>
							</el-form-item>
						</el-col>
					</el-row>
					<el-row>

						<!-- Country -->
						<el-form-item
										label="{{__('Country')}}"
										required
										:error="form.errors.get('zip')">
							<el-select v-model="form.country" placeholder="{{ __('Selectionnez votre pays') }}"
												 style="width: 100%;" filterable>
								@foreach (app(Laravel\Spark\Repositories\Geography\CountryRepository::class)->all() as $key => $country)
									<el-option key="{{ $key }}" value="{{ $key }}" label="{{ $country }}"></el-option>
								@endforeach
							</el-select>
						</el-form-item>

					</el-row>
				@endif

				<el-button type="primary" @click.prevent="update" size="medium" :loading="form.busy"
									 style="margin-top: 15px;"
									 :disabled="form.busy">
					<span v-if="form.busy">{{__('Updating')}}</span>
					<span v-else>{{__('Update')}}</span>
				</el-button>
			</el-form>

		</el-card>
	</div>
</spark-update-payment-method-stripe>
