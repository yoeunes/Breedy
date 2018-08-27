<update-settings-preferences :user="user" inline-template>
	<div>
		<div class="settings-bloc-title">
			<h2 class="title__settings">{{__('Préférences de l’application')}}</h2>
		</div>

		<el-card>
			<div slot="header" class="with-icon">
				<img src="{{ asset('icons/settings.svg') }}" width="22" height="22" alt="" class="svg-title">
				<span>{{ __('Langue de l’application') }}</span>
			</div>

			{{-- Success Message --}}
			<el-alert   v-if="form.successful"
									title="{{__('Vos préférences ont été mises à jour ! Rechargez la page pour voir les changements.')}}"
									type="success"
									show-icon>
			</el-alert>

			<el-form>
				<el-form-item label="{{ __('Langue de l’application') }}"
											prop="language"
											:error="form.errors.get('language')">
				<el-select v-model="form.language" style="display: block">
					<el-option
									v-for="lang in languageList"
									:key="lang.value"
									:label="lang.label"
									:value="lang.value">
					</el-option>
				</el-select>

					<el-button type="primary"
										 style="margin-top: 20px;"
										 size="medium"
										 :loading="form.busy"
										 :disabled="form.busy"
										 @click.prevent="update();">
						<span v-if="form.busy">{{__('Updating')}}</span>
						<span v-else>{{__('Update')}}</span>
					</el-button>
				</el-form-item>
			</el-form>

		</el-card>
	</div>
</update-settings-preferences>
