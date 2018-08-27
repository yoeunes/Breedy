@section('custom-class', 'settings-page')

<spark-team-profile
				:user="user"
				:team="team"
				inline-template>

	<div>
		<div v-if="user && team">

			<update-team-profile-details :user="user"
																	 :team="team"
																	 inline-template>

				<el-form class="form" :model="form">

					<!-- Title -->
					<div class="settings-bloc-title">
						<h2 class="title__settings">{{__('Breeding profile')}}</h2>
						<el-button type="primary"
											 size="medium"
											 :loading="form.busy"
											 :disabled="form.busy"
											 @click.prevent="update();">
							<span v-if="form.busy">{{__('Updating')}}</span>
							<span v-else>{{__('Update')}}</span>
						</el-button>
					</div>

					<el-card class="settings-container">

						<spark-update-team-photo :user="user"
																		 :team="team"
																		 inline-template>

							<form role="form">
								<div class="form-group row justify-content-center">
									<div class="col-md-6 d-flex align-items-center">
										<div class="image-placeholder mr-4">
											<span role="img" class="profile-photo-preview" :style="previewStyle"></span>
										</div>
										<div class="spark-uploader mr-4">
											<input ref="photo" type="file" class="spark-uploader-control" name="photo" @change="update"
														 :disabled=
														 "form.busy">
											<div class="btn btn-outline-dark">{{__('Update Photo')}}</div>
										</div>
									</div>
								</div>
							</form>

						</spark-update-team-photo>

						<!-- Nom de l’élevage -->
						<el-form-item label="{{ ucfirst(__('labels.breeding-name')) }}"
													:error="form.errors.get('breeding-name')"
													prop="name"
													:rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.breeding-name')])  }}', trigger: ['blur', 'change'] }]">
							<el-input v-model="form.name" name="name" id="name"></el-input>
						</el-form-item>

						<div>
							<h3 class="title__subtitle">{{__('Complete address')}}</h3>

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
						</div>
						<div>
							<h3 class="title__subtitle">{{__('Billing Information')}}</h3>
							<div class="tips tips--infos">
								<span>{{__('Useful for generating your invoices')}}</span>
								<p>
									{{__('If you fill in the information below, they will appear when you generate invoices for your customers')}}
								</p>
							</div>

							<!-- Champ Dénomination sociale -->
							<el-form-item label="{{ ucfirst(__('labels.companyName')) }}"
														:error="form.errors.get('companyName')"
														prop="companyName">
								<el-input v-model="form.companyName" name="companyName" id="companyName"></el-input>
							</el-form-item>

							<div class="form__address">

								<!-- Champ N° élevage/accréditation -->
								<el-form-item label="{{ ucfirst(__('labels.companyNumber')) }}"
															:error="form.errors.get('companyNumber')"
															prop="companyNumber">
									<el-input v-model="form.companyNumber" name="companyNumber" id="companyNumber"></el-input>
								</el-form-item>

								<!-- Champ TVA -->
								<el-form-item label="{{ ucfirst(__('labels.vat')) }}"
															:error="form.errors.get('vat')"
															prop="vat">
									<el-input v-model="form.vat" name="vat" id="vat"></el-input>
								</el-form-item>

								<!-- Champ Compte bancaire -->
								<el-form-item label="{{ ucfirst(__('labels.bankAccount')) }}"
															:error="form.errors.get('bankAccount')"
															prop="bankAccount">
									<el-input v-model="form.bankAccount" name="bankAccount" id="bankAccount"></el-input>
								</el-form-item>

								<!-- Champ BIC/SWIFT -->
								<el-form-item label="{{ ucfirst(__('labels.bicSwift')) }}"
															prop="bicSwift"
															:error="form.errors.get('bicSwift')">
									<el-input v-model="form.bicSwift" name="bicSwift" id="bicSwift"></el-input>
								</el-form-item>
							</div>

							<!-- Champ Informations supplémentaires -->
							<el-form-item label="{{ ucfirst(__('labels.addInfos')) }}"
														:error="form.errors.get('addInfos')"
														prop="addInfos">
								<el-input v-model="form.addInfos" type="textarea" rows="5" name="addInfos" id="addInfos"></el-input>
							</el-form-item>

						</div>

						{{--<span v-if="Object.keys(form.errors.errors).length > 0">errors</span>--}}
						<el-button type="primary"
											 size="medium"
											 :loading="form.busy"
											 :disabled="form.busy"
											 @click.prevent="update();">
							<span v-if="form.busy">{{__('Updating')}}</span>
							<span v-else>{{__('Update')}}</span>
						</el-button>

					</el-card>
				</el-form>

			</update-team-profile-details>
		</div>
	</div>
</spark-team-profile>
