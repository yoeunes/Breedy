<spark-redeem-coupon :user="user" :team="team" :billable-type="billableType" inline-template>

    <div>
        <el-card>
            <div slot="header" class="with-icon">
                <img src="{{ asset('icons/coupon-code.svg') }}" width="22" height="16" alt="" class="svg-title">
                <span>{{__('Redeem Coupon')}}</span>
            </div>

            <el-alert v-if="form.successful"
                      title="{{__('Coupon accepted! The discount will be applied to your next invoice.')}}"
                      type="success"
                      show-icon>
            </el-alert>

            <el-form class="form" :model="form">
                <el-form-item label="{{__('Coupon Code')}}"
                              :error="form.errors.get('coupon')"
                              prop="coupon">
                    <el-input v-model="form.coupon" name="coupon" id="coupon"></el-input>
                </el-form-item>
                <el-button type="primary"
                           style="margin-top: 10px;"
                           @click.prevent="redeem"
                           size="medium"
                           :loading="form.busy"
                           :disabled="form.busy">
                    <span v-if="form.busy">{{__('Validation du coupon en cours')}}</span>
                    <span v-else>{{__('Valider le coupon')}}</span>
                </el-button>
            </el-form>
        </el-card>
    </div>

</spark-redeem-coupon>
