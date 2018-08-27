<spark-cancel-subscription :user="user" :team="team" :billable-type="billableType" inline-template>
	<div>
		<el-card>
			<div slot="header" class="with-icon">
				<img src="{{ asset('icons/renew-subscription.svg') }}" width="22" height="22" alt="" class="svg-title">
				<span>{{__('Cancel Subscription')}}</span>
			</div>

			<div class="tips tips--onlyTitle tips--warning" style="margin-top: 0px;">
				<span>{{ __('Vous pouvez arrêter le renouvellement automatique de votre abonnement à tout moment. Vous en garderez les
					bénéfices jusqu’à la fin de la période de facturation en cours.') }}</span>
			</div>

			<el-button type="danger"
								 @click="dialogCancelSubscriptionVisible = true"
								 plain>
				{{__('Cancel Subscription')}}
			</el-button>
		</el-card>

		<!-- Confirm Cancellation Modal -->
		<el-dialog :visible.sync="dialogCancelSubscriptionVisible"
							 :lock-scroll="false"
							 width="30%"
							 class="modalChange">
			<span slot="title" class="el-dialog__title">
				{{__('Cancel Subscription')}}
			</span>
			<p>
				{{__('Are you sure you want to cancel your subscription?')}}
			</p>
			<span slot="footer" class="dialog-footer">
				<el-button @click="dialogCancelSubscriptionVisible = false">{{__('No, Go Back')}}</el-button>
				<el-button type="danger" @click.prevent="cancel" size="medium" :loading="form.busy" :disabled="form.busy">
					<span v-if="form.busy">{{__('Annulation en cours')}}</span>
					<span v-else>{{__('Yes, Cancel')}}</span>
				</el-button>
			</span>
		</el-dialog>
	</div>
</spark-cancel-subscription>
