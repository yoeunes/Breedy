@section('custom-class', 'settings-page')

<update-profile-details :user="user" inline-template>
	<el-form class="form" :model="form">
		<el-card>
			<div slot="header" class="with-icon">
				<img src="{{ asset('icons/list-user.svg') }}" width="19" height="23" alt="" class="svg-title">
				<span>{{__('Informations de contact')}}</span>
			</div>

			<!-- Success Message -->
			<el-alert v-if="form.successful"
								title="{{__('Vos informations de contact ont été mise à jour')}}"
								type="success"
								center
								show-icon>
			</el-alert>
			<el-form class="form" :model="form">
				<div class="form__address">
					<!-- firstname -->
					<el-form-item label="{{ __('labels.firstname') }}"
												prop="firstname"
												:error="form.errors.get('firstname')"
												:rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.firstname')])  }}', trigger: ['blur', 'change'] }]"
												required>
						<el-input name="firstname" id="firstname" v-model="form.firstname">
						</el-input>
					</el-form-item>

					<!-- lastname -->
					<el-form-item label="{{ __('labels.lastname') }}"
												prop="lastname"
												:error="form.errors.get('lastname')"
												:rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.lastname')])  }}', trigger: ['blur', 'change'] }]"
												required>
						<el-input name="lastname" id="lastname" v-model="form.lastname">
						</el-input>
					</el-form-item>

					<!-- Adresse email -->
					<el-form-item label="{{ ucfirst(__('labels.email')) }}"
												:error="form.errors.get('email')"
												prop="email"
												:rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.email')])  }}', trigger: ['blur', 'change'] }]">
						<el-input v-model="form.email" name="email" id="email"></el-input>
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
				<el-button type="primary"
									 style="margin-top: 10px;"
									 size="medium"
									 :loading="form.busy"
									 :disabled="form.busy"
									 @click.prevent="update();">
					<span v-if="form.busy">{{__('Updating')}}</span>
					<span v-else>{{__('Update')}}</span>
				</el-button>
			</el-form>
		</el-card>
	</el-form>

</update-profile-details>
