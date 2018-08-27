<spark-invoices :user="user" :team="team" :billable-type="billableType" inline-template>
	<div>
		<div class="settings-bloc-title">
			<h2 class="title__settings">Factures</h2>
		</div>
		<div class="settings-container">
			<!-- Update Extra Billing Information -->
			<div v-if="billable">
				@include('spark::settings.invoices.update-extra-billing-information')
			</div>

			<!-- Invoice List -->
			<div v-if="invoices.length > 0">
				@include('spark::settings.invoices.invoice-list')
			</div>
		</div>
	</div>
</spark-invoices>
