@section('custom-class', 'settings-page')

<spark-update-password  :user="user" 
                        inline-template>

    <el-form class="form" :model="form">

        <!-- Title -->
        <div class="settings-bloc-title">
            <h2 class="title__settings">{{__('Security')}}</h2>
        </div>

        <!-- Update Password -->
        <el-card>
            <div slot="header" class="with-icon">
                <img src="{{ asset('icons/add-user.svg') }}" width="19" height="23" alt="" class="svg-title">
                <span>{{ __('Update Password') }}</span>
            </div>

            <!-- Success Message -->
                <el-alert   v-if="form.successful"
                            title="{{__('Your password has been updated!')}}"
                            type="success"
                            show-icon>
                </el-alert>
            <el-form class="form" :model="form">

                <!-- Current Password -->
                 <el-form-item  label="{{ ucfirst(__('labels.current_password'))}}"
                                prop="current_password"
                                :error="form.errors.get('current_password')">
                    <el-input type="password" v-model="form.current_password" auto-complete="off" name="current_password" id="currentPassword"></el-input>
                 </el-form-item>

                <!-- New Password -->
                 <el-form-item  label="{{ ucfirst(__('labels.password'))}}"
                                prop="password"
                                :error="form.errors.get('password')"
                                :rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.password')])  }}', trigger: ['blur', 'change'] }]">
                    <el-input type="password" v-model="form.password" auto-complete="off" name="password" id="password"></el-input>
                 </el-form-item>

                <!-- Confirm New Password -->
                 <el-form-item  label="{{ ucfirst(__('labels.password_confirmation'))}}"
                                prop="password_confirmation"
                                :rules="[{ required: true, message: '{{ __('validation.required', ['attribute' => __('validation.attributes.password_confirmation')])  }}', trigger: ['blur', 'change'] }]"
                                :error="form.errors.get('password_confirmation')">
                    <el-input type="password" v-model="form.password_confirmation" auto-complete="off" name="password_confirmation" id="password_confirmation"></el-input>
                </el-form-item>

                <el-button type="primary"
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

</spark-update-password>
