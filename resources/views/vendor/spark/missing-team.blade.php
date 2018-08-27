@extends('spark::layouts.app')

@section('content')

	<spark-create-team :user="user" inline-template>

		<div>
			<div class="missing__centerWrapper">
				<div class="missing">
					<img src="{{asset('/icons/first-breeding.svg')}}" class="h-90">
					<h2 role="heading" aria-level="2" class="missing__title title20">{{ __('Créez votre premier élevage') }}</h2>
					<p class="p14 p14--light">
						{{ __('Il ne reste qu’une étape avant de pouvoir commencer à gérer votre élevage.') }}
					</p>

					<el-button type="primary"
										 size="medium"
										 :loading="form.busy"
										 :disabled="form.busy"
										 @click="form.dialogCreateTeamVisible = true">
						<span>{{__('Créer mon élevage')}}</span>
					</el-button>
				</div>
			</div>

			<el-dialog title="{{ __('Créer un élevage') }}" :visible.sync="form.dialogCreateTeamVisible">
				<el-form class="form" :model="form">

					<!-- Nom de l’élevage -->
					<el-form-item label="{{ ucfirst(__('labels.breeding-name')) }}"
												:error="form.errors.get('name')"
												prop="name"
												:rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.breeding-name')])  }}', trigger: ['blur', 'change'] }]">
						<el-input v-model="form.name" name="name" id="name"></el-input>
					</el-form-item>

					<div>
						<h3 class="title__subtitle createTeamModal__title">{{__('Adresse complète')}}</h3>


						<el-row>
							<el-col :span="12" style="padding-right: 10px;">
								<!-- Champ Rue & Numéro -->
								<el-form-item label="{{ ucfirst(__('labels.street1')) }}"
															prop="street1"
															:error="form.errors.get('street1')"
															:rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.street1')])  }}', trigger: ['blur', 'change'] }]">
									<el-input name="street1" id="street1" v-model="form.street1"></el-input>
								</el-form-item>
								</el-form-item>
							</el-col>

							<el-col :span="12" style="padding-left: 10px;">
								<!-- Champ Rue & Numéro Ligne 2 -->
								<el-form-item label="{{ ucfirst(__('labels.street2')) }}"
															:error="form.errors.get('street2')"
															prop="street2">
									<el-input v-model="form.street2" name="street2" id="street2"></el-input>
								</el-form-item>
							</el-col>
						</el-row>

						<div class="form__address">
							<el-row>
								<el-col :span="12" style="padding-right: 10px;">
									<!-- Champ Ville -->
									<el-form-item label="{{ ucfirst(__('labels.city')) }}"
																:error="form.errors.get('city')"
																prop="city"
																:rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.city')])  }}', trigger: ['blur', 'change'] }]">
										<el-input name="city" id="city" v-model="form.city"></el-input>
									</el-form-item>
								</el-col>

								<el-col :span="12" style="padding-left: 10px;">
									<!-- Champ Province -->
									<el-form-item label="{{ ucfirst(__('labels.province')) }}"
																:error="form.errors.get('province')"
																prop="province">
										<el-input v-model="form.state" name="province" id="province"></el-input>
									</el-form-item>
								</el-col>
							</el-row>

							<el-row>
								<el-col :span="12" style="padding-right: 10px;">
									<!-- Champ Code Postal -->
									<el-form-item label="{{ ucfirst(__('labels.zip')) }}"
																prop="zip"
																:error="form.errors.get('zip')"
																:rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.zip')])  }}', trigger: ['blur', 'change'] }]">
										<el-input v-model="form.zip" name="zip" id="zip"></el-input>
									</el-form-item>
								</el-col>

								<el-col :span="12" style="padding-left: 10px;">
									<!-- Champ Pays -->
									<el-form-item label="{{ ucfirst(__('labels.country')) }}"
																prop="country"
																:error="form.errors.get('country')"
																:rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.country')])  }}', trigger: ['blur', 'change'] }]">
										<el-select v-model="form.country" filterable placeholder="Choisissez un pays" name="country"
															 id="country" style="display: block;">
											<select-country></select-country>
										</el-select>
									</el-form-item>
								</el-col>
							</el-row>

							<!-- Type et races -->
							<el-row>
								<el-col :span="12">
									<el-form-item label="Type d’animal"
																prop="type"
																style="padding-right: 10px;"
																:error="form.errors.get('type')"
																:rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.type')])  }}', trigger: ['blur', 'change'] }]">

										<span slot="label">Type</span>
										<el-tooltip content="Indiquez le type d’animal que vous allez élever. Vous pourrez en ajouter d’autre par la suite" placement="top">
											<i class="el-icon-info" style="position: relative; left: -5px;"></i>
										</el-tooltip>

										<el-input placeholder="Chiens, chats, furets,…" v-model="form.type" name="type"
															id="type"></el-input>
									</el-form-item>
								</el-col>
								<el-col :span="12">
									<el-form-item style="padding-left: 10px;"
																prop="race"
																:error="form.errors.get('type')"
																:rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.type')])  }}', trigger: ['blur', 'change'] }]">

										<span slot="label">Race</span>
										<el-tooltip content="Indiquez la race d’animal que vous allez élever. Vous pourrez en ajouter d’autre par la suite." placement="top">
											<i class="el-icon-info" style="position: relative; left: -5px;"></i>
										</el-tooltip>

										<el-input placeholder="Labrador, Teckel, Husky,…" v-model="form.race" name="race"
															id="race"></el-input>
									</el-form-item>
								</el-col>
							</el-row>
						</div>
					</div>

					<div style="text-align: center;">
						<el-button type="primary"
											 size="medium"
											 :loading="form.busy"
											 :disabled="form.busy"
											 @click.prevent="create();">
							<span v-if="form.busy">{{__('Création en cours…')}}</span>
							<span v-else>{{__('Créer l’élevage')}}</span>
						</el-button>
					</div>

				</el-form>
			</el-dialog>
		</div>

	</spark-create-team>
@endsection
