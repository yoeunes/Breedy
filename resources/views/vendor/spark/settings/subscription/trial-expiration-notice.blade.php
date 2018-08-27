<div class="tips tips--warning" v-if="subscriptionIsOnTrial">
	<span><?php echo __('Your free trial to the premium plan ends :date.', ['date' => '<strong>{{ trialEndsAt }}</strong>']); ?></span>
	<p>
		{{__('You are currently in your free trial period. During this one, you can use all the premium features of the application. Once expired, you will automatically go to the free plan unless you have exceeded the allowed quotas. You will then be asked to subscribe to use the app again.')}}
	</p>
</div>
