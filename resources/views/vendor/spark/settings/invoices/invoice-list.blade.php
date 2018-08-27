<spark-invoice-list :user="user" :team="team"
										:invoices="invoices" :billable-type="billableType" inline-template>


	<el-card v-if="invoices.length > 0">
		<div slot="header" class="with-icon">
			<img src="{{ asset('icons/invoice.svg') }}" width="19" height="23" alt="" class="svg-title">
			<span>Liste des factures</span>
		</div>

		<div class="el-table el-table--fit el-table--enable-row-hover el-table--enable-row-transition" style="width: 100%;">
			<div class="hidden-columns">
				<div></div>
				<div></div>
				<div></div>
			</div>
			<div class="el-table__header-wrapper">
				<table cellspacing="0" cellpadding="0" border="0" class="el-table__header" style="width: 100%;">
					<colgroup>
						<col name="el-table_1_column_1" width="40%">
						<col name="el-table_1_column_2" width="30%">
						<col name="el-table_1_column_3" width="30%">
						<col name="gutter" width="0">
					</colgroup>
					<thead class="has-gutter">
					<tr class="">
						<th colspan="1" rowspan="1" class="el-table_1_column_1     is-leaf">
							<div class="cell">Date de facturation</div>
						</th>
						<th colspan="1" rowspan="1" class="el-table_1_column_2     is-leaf">
							<div class="cell">Montant</div>
						</th>
						<th colspan="1" rowspan="1" class="el-table_1_column_3     is-leaf">
							<div class="cell">Opérations</div>
						</th>
						<th class="gutter" style="width: 0px; display: none;"></th>
					</tr>
					</thead>
				</table>
			</div>
			<div class="el-table__body-wrapper is-scrolling-none">
				<table cellspacing="0" cellpadding="0" border="0" class="el-table__body" style="width: 100%;">
					<colgroup>
						<col name="el-table_1_column_1" width="40%">
						<col name="el-table_1_column_2" width="30%">
						<col name="el-table_1_column_3" width="30%">
					</colgroup>
					<tbody>
					<tr class="el-table__row" v-for="invoice in invoices">
						<!-- Column Date -->
						<td class="el-table_1_column_1  ">
							<div class="cell">
								@{{ dateInvoice }}
							</div>
						</td>

						<!-- Column Price -->
						<td class="el-table_1_column_2">
							<div class="cell">@{{ invoice.total | currency }}</div>
						</td>

						<!-- Column buttons -->
						<td class="el-table_1_column_3">
							<div class="cell">
								<a :href="downloadUrlFor(invoice)">
									<el-button type="primary" icon="el-icon-download" size="mini">{{__('Download PDF')}}</el-button>
								</a>
							</div>
						</td>


					</tr><!----></tbody>
				</table><!----><!----></div><!----><!----><!----><!---->
			<div class="el-table__column-resize-proxy" style="display: none;"></div>
		</div>
	</el-card>
</spark-invoice-list>
