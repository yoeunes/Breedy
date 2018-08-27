@section('custom-class', 'settings-page')

<spark-create-team :user="user"
									 inline-template>
	<div>
		<!-- Title -->
		<div class="settings-bloc-title">
			<h2 class="title__settings">{{__('My breedings')}}</h2>
		</div>

		<!-- Create Team -->
		<el-card>
			<div slot="header" class="with-icon">
				<img src="{{ asset('icons/add-user.svg') }}" width="19" height="23" alt="" class="svg-title">
				<span>{{ __('Create team') }}</span>
			</div>

			<div v-if="canCreateMoreTeams">
				<el-form class="form" :model="form" v-if="form.formCreateTeamVisible == true">

					<!-- Name Team -->
					<el-form-item label="{{ ucfirst(__('labels.breeding-name')) }}"
												:error="form.errors.get('name')"
												prop="name"
												:rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.breeding-name')])  }}', trigger: ['blur', 'change'] }]">
						<el-input v-model="form.name" name="name" id="name"></el-input>
					</el-form-item>

					<!-- Champ Rue & Numéro -->
					<el-form-item label="{{ ucfirst(__('labels.street1')) }}"
												prop="street1"
												:error="form.errors.get('street1')"
												:rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.street1')])  }}', trigger: ['blur', 'change'] }]">
						<el-input name="street1" id="street1" v-model="form.street1"></el-input>
					</el-form-item>

					<!-- Champ Rue & Numéro Ligne 2 -->
					<el-form-item label="{{ ucfirst(__('labels.street2')) }}"
												:error="form.errors.get('street2')"
												prop="street2">
						<el-input v-model="form.street2" name="street2" id="street2"></el-input>
					</el-form-item>
					<div class="form__address">

						<!-- Champ Ville -->
						<el-form-item label="{{ ucfirst(__('labels.city')) }}"
													:error="form.errors.get('city')"
													prop="city"
													:rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.city')])  }}', trigger: ['blur', 'change'] }]">
							<el-input name="city" id="city" v-model="form.city"></el-input>
						</el-form-item>

						<!-- Champ Province -->
						<el-form-item label="{{ ucfirst(__('labels.province')) }}"
													:error="form.errors.get('province')"
													prop="province">
							<el-input v-model="form.state" name="province" id="province"></el-input>
						</el-form-item>

						<!-- Champ Code Postal -->
						<el-form-item label="{{ ucfirst(__('labels.zip')) }}"
													prop="zip"
													:error="form.errors.get('zip')"
													:rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.zip')])  }}', trigger: ['blur', 'change'] }]">
							<el-input v-model="form.zip" name="zip" id="zip"></el-input>
						</el-form-item>

						<!-- Champ Pays -->
						<el-form-item label="{{ ucfirst(__('labels.country')) }}"
													prop="country"
													:error="form.errors.get('country')"
													:rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.country')])  }}', trigger: ['blur', 'change'] }]">
							<el-select v-model="form.country" filterable placeholder="Choisissez un pays" name="country"
												 id="country">
								<select-country></select-country>
							</el-select>
						</el-form-item>
					</div>
				</el-form>
			</div>
			<el-button v-if="form.formCreateTeamVisible == false"
								 style="margin-top: 10px;"
								 type="primary"
								 size="medium"
								 :loading="form.busy"
								 :disabled="form.busy"
								 @click="form.formCreateTeamVisible = true">
				<span>{{__('Créer')}}</span>
			</el-button>

			<el-button v-if="form.formCreateTeamVisible == true"
								 type="primary"
								 style="margin-top: 10px;"
								 size="medium"
								 :loading="form.busy"
								 :disabled="form.busy"
								 @click.prevent="create(); resetForm();">
				<span v-if="form.busy">{{__('Création en cours')}}</span>
				<span v-else>{{__('Créer')}}</span>
			</el-button>
		</el-card>
	</div>
</spark-create-team>
