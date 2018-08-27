<spark-update-vat-id :user="user" :team="team" :billable-type="billableType" inline-template>

	<div>
		<el-card>
			<div slot="header" class="with-icon">
				<img src="{{ asset('icons/update-vat.svg') }}" width="22" height="22" alt="" class="svg-title">
				<span>{{__('Update VAT ID')}}</span>
			</div>

			<el-alert v-if="form.successful"
								title="{{__('Your VAT ID has been updated!')}}"
								type="success"
								show-icon>
			</el-alert>

			<el-form class="form" :model="form">
				<el-form-item label="{{ 'Update VAT ID' }}"
											:error="form.errors.get('vat_id')"
											prop="vat_id">
					<el-input v-model="form.vat_id" name="vat_id" id="vat_id" placeholder="{{ __('Exemple: BE0123456789') }}"></el-input>
				</el-form-item>
				<el-button type="primary"
									 style="margin-top: 10px;"
									 @click.prevent="update"
									 size="medium"
									 :loading="form.busy"
									 :disabled="form.busy">
					<span v-if="form.busy">{{__('Updating')}}</span>
					<span v-else>{{__('Update')}}</span>
				</el-button>
			</el-form>
		</el-card>
	</div>

</spark-update-vat-id>
