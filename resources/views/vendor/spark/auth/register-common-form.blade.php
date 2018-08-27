@section('custom-class', 'register-page')


<div v-cloak class="register__container">
	<h1 role="heading" aria-level="1" class="register__title">Inscrivez-vous pour commencer à gérer votre élevage</h1>
	<span class="register__login">Ou
		<a href="{{ url('/login') }}">connectez-vous</a>
		si vous avez déjà un compte</span>

	<div class="register__form-container">
		{{--<form role="form" class="register__form el-form">--}}
		<el-form :model="registerForm" class="register__form">
		@if (Spark::usesTeams() && Spark::onlyTeamPlans())
			<!-- Team Name -->
			{{--<div class="form-group row" v-if=" ! invitation">
				<label class="col-md-4 col-form-label text-md-right">{{ __('teams.team_name') }}</label>

				<div class="col-md-6">
					<input type="text" class="form-control" name="team" v-model="registerForm.team"
								 :class="{'is-invalid': registerForm.errors.has('team')}" autofocus>

					<span class="invalid-feedback" v-show="registerForm.errors.has('team')">
						@{{ registerForm.errors.get('team') }}
					</span>
				</div>
			</div>--}}

			@if (Spark::teamsIdentifiedByPath())
				<!-- Team Slug (Only Shown When Using Paths For Teams) -->
					<div class="form-group row" v-if=" ! invitation">
						<label class="col-md-4 col-form-label text-md-right">{{ __('teams.team_slug') }}</label>

						<div class="col-md-6">
							<input type="text" class="form-control" name="team_slug" v-model="registerForm.team_slug"
										 :class="{'is-invalid': registerForm.errors.has('team_slug')}" autofocus>

							<small class="form-text text-muted" v-show="! registerForm.errors.has('team_slug')">
								{{__('teams.slug_input_explanation')}}
							</small>

							<span class="invalid-feedback" v-show="registerForm.errors.has('team_slug')">
								@{{ registerForm.errors.get('team_slug') }}
							</span>
						</div>
					</div>
				@endif
			@endif

			<strong class="register__form__title">Créer un compte</strong>


			<!-- TODO: delete this comment -->
			<div class="register__form__row">
				<!-- firstname -->
				<el-form-item label="{{ __('labels.firstname') }}"
											prop="firstname"
											:error="registerForm.errors.get('firstname')"
											required>
					<el-input name="firstname" id="firstname" v-model="registerForm.firstname">
					</el-input>
				</el-form-item>
				<!-- lastname -->
				<el-form-item label="{{ __('labels.lastname') }}" prop="lastname" :error="registerForm.errors.get('lastname')"
											required>
					<el-input name="lastname" id="lastname" v-model="registerForm.lastname">
					</el-input>
				</el-form-item>
			</div>

			<div class="register__form__row">
				<!-- email -->
				<el-form-item label="{{ __('labels.email') }}"
											prop="email"
											:error="registerForm.errors.get('email')"
											required
											:rules="[{ type: 'email', message: 'Please input correct email address', trigger: ['blur', 'change'] }]">
					<el-input name="email" id="email" v-model="registerForm.email">
					</el-input>
				</el-form-item>
				<!-- country -->
				<el-form-item label="Pays"
											prop="country"
											:error="registerForm.errors.get('country')"
											required>
					<el-select v-model="registerForm.country" filterable placeholder="Choisissez un pays"
										 class="register__form__select" id="country">
						<select-country></select-country>
					</el-select>
				</el-form-item>
			</div>

			<password-fields v-bind:register-form="registerForm"></password-fields>

			<el-form-item label="Langue de l’application"
										:error="registerForm.errors.get('language')"
										style="width: 100%;"
										required>
				<el-select v-model="registerForm.language" placeholder="Selectionnez votre langue" style="width: 100%">
					<el-option key="fr" value="fr" label="Français">Français</el-option>
					<el-option key="en" value="en" label="English">English</el-option>
				</el-select>
			</el-form-item>


			<div class="register__form__terms">
				<el-checkbox required
										 :error="registerForm.errors.get('terms')"
										 v-model="registerForm.terms">{!! __('labels.accept-terms', ['linkOpen' => "<a href='/terms' target='_blank'>", 'linkClose' => '</a>']) !!}
				</el-checkbox>

				<span class="el-form-item__error" v-show="registerForm.errors.has('terms')">
					<strong>@{{ registerForm.errors.get('terms') }}</strong>
				</span>
			</div>
			<div class="register__form__button">
				<el-button type="primary" @click.prevent="register" size="medium" :loading="registerForm.busy"
									 :disabled="registerForm.busy">
					<span v-if="registerForm.busy">{{__('labels.register-button-loading')}}</span>
					<span v-else>{{ __('labels.register-button') }}</span>
				</el-button>
			</div>


		</el-form>
		{{--</form>--}}
	</div>

</div>
