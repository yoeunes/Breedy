@section('custom-class', 'settings-page')

<spark-update-extra-billing-information :user="user" 
                                        :team="team" 
                                        :billable-type="billableType" 
                                        inline-template>
    <el-card>
		<div slot="header" class="with-icon">
			<img src="{{ asset('icons/update-billing-informations.svg') }}" width="19" height="23" alt="" class="svg-title">
			<span>{{ __('Billing Information') }}</span>
        </div>
        <div class="tips tips--infos large-width">
			<p>
				 {{__('The information you fill in the following field will appear on the invoices we will send you for your subscription to this application. This is the right place to add your full business name, VAT number, or address of record. Do not include any confidential or financial information such as credit card numbers.')}}
			</p>
        </div>

        <!-- Success Message -->
        <el-alert   v-if="form.successful"
				    title="{{__('Your billing information has been updated!')}}"
					type="success"
					show-icon>
        </el-alert>

        <!-- Extra Billing Information -->
        <el-form>
            <el-form-item label="{{ __('Extra Billing Information') }}"
                          prop="information"
                          :error="form.errors.get('information')">
                <el-input type="textarea" rows="5" v-model="form.information"></el-input>
            </el-form-item>

            <!-- Update Button -->
            <el-button  type="primary"
                        size="medium"
                        :loading="form.busy"
                        :disabled="form.busy"
                        @click.prevent="update();">
                <span v-if="form.busy">{{__('Updating')}}</span>
                <span v-else>{{__('Update')}}</span>
            </el-button>
        </el-form>
	</el-card>
</spark-update-extra-billing-information>
