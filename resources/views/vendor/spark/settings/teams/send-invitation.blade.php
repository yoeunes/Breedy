@section('custom-class', 'settings-page')

<spark-send-invitation :user="user"
											 :team="team"
											 :billable-type="billableType"
											 default-role="{{Spark::defaultRole()}}"
											 inline-template>

	<div v-if="user">
		<div class="settings-bloc-title">
			<h2 class="title__settings">{{__('Members')}}</h2>
		</div>
		<div class="settings-container">
			<div class="tips tips--infos large-width">
				<span>{{__('Add members to your breeding')}}</span>
				<p>
					{{__('You can add additional members to your farm and assign them a specific role so they can access only parts of your app. When you add a member, your subscription is updated accordingly.')}}
				</p>
			</div>


			<!-- AJOUTER UN MEMBRE -->
			<el-card>
				<div slot="header" class="with-icon">
					<img src="{{ asset('icons/add-user.svg') }}" width="19" height="23" alt="" class="svg-title">
					<span>{{ __('Add user') }}</span>
				</div>
				<el-form class="form" :model="form" v-if="canInviteMoreTeamMembers">
					<el-alert v-if="form.successful"
										title="{{__('The invitation has been sent!')}}"
										type="success"
										show-icon>
					</el-alert>
					<!-- Champ Email -->
					<el-form-item label="{{__('Email Address')}}"
												prop="email"
												:error="form.errors.get('email')"
												:rules="[
												{ required: true, message: '{{ __('validation.required', ['attribute' => 'email'])  }}', trigger: ['blur', 'change'] },
												{ type: 'email', message: '{{ __('validation.email', ['attribute' => 'email'])  }}', trigger: ['blur', 'change'] }
												]"
												required>
						<el-input name="email" id="email" v-model="form.email"></el-input>
					</el-form-item>

					<span class="invalid-feedback" v-if="hasTeamMembersLimit">
              <?php echo __('teams.you_have_x_invitations_remaining', ['count' => '{{ remainingTeamMembers }}']); ?>
					</span>

					<!-- Champ Rôle -->
					<el-form-item label="{{ucfirst(__('labels.role'))}}" required v-if="roles.length > 0">
						<el-radio-group v-model="form.role">
							<el-radio v-for="role in roles" :label="role.value">@{{ role.text }}</el-radio>
						</el-radio-group>
					</el-form-item>

					<!-- Message d'alerte administrateur-->
					<el-alert v-if="form.role == 'administrator'"
										title="Un administrateur peut xxx"
										:closable="false"
										type="warning">
					</el-alert>

					<!-- Message d'alerte membre -->
					<el-alert v-if="form.role == 'member'"
										title="Un membre peut xxx"
										:closable="false"
										type="warning">
					</el-alert>

					<el-button type="primary"
										 @click.prevent="send"
										 size="medium"
										 class="settings-page__send-button"
										 :loading="form.busy"
										 :disabled="form.busy">
						<span v-if="form.busy">{{__('labels.invitation_progress')}}</span>
						<span v-else>{{__('labels.send_invitation')}}</span>
					</el-button>

				</el-form>
			</el-card>

		</div>
	</div>


</spark-send-invitation>
