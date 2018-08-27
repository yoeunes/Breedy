@section('custom-class', 'settings-page')
<spark-mailed-invitations :invitations="invitations"
													inline-template>

	<el-card v-if="invitations.length > 0">
		<div slot="header" class="with-icon">
			<img src="{{ asset('icons/mailed-user.svg') }}" width="19" height="23" alt="" class="svg-title">
			<span>{{__('Mailed Invitations')}}</span>
		</div>

		<div class="el-table el-table--fit el-table--enable-row-hover el-table--enable-row-transition">
			<div class="hidden-columns">
				<div></div>
				<div></div>
				<div></div>
			</div>
			<div class="el-table__header-wrapper">
				<table cellspacing="0" cellpadding="0" border="0" class="el-table__header" style="width: 100%;">
					<colgroup>
						<col name="el-table_1_column_1" width="80%">
						<col name="el-table_1_column_2" width="20%">
						<col name="gutter" width="0">
					</colgroup>
					<thead class="has-gutter">
					<tr class="">
						<th colspan="1" rowspan="1" class="el-table_1_column_1     is-leaf">
							<div class="cell">{{__('Adresse email')}}</div>
						</th>
						<th colspan="1" rowspan="1" class="el-table_1_column_2     is-leaf">
							<div class="cell">{{__('Opérations')}}</div>
						</th>
						<th class="gutter" style="width: 0px; display: none;"></th>
					</tr>
					</thead>
				</table>
			</div>
			<div class="el-table__body-wrapper is-scrolling-none">
				<table cellspacing="0" cellpadding="0" border="0" class="el-table__body" style="width: 100%;">
					<colgroup>
						<col name="el-table_1_column_1" width="80%">
						<col name="el-table_1_column_2" width="20%">
					</colgroup>
					<tbody>
					<tr class="el-table__row" v-for="invitation in invitations">
						<!-- Column email -->
						<td class="el-table_1_column_1  ">
							<div class="cell">
								@{{ invitation.email }}
							</div>
						</td>

						<!-- Column Operations -->
						<td class="el-table_1_column_2">
							<div class="cell">
								<el-button
												v-on:click="cancel(invitation)"
												type="danger"
												icon="el-icon-delete"
												size="mini">
									{{__('Annuler')}}
								</el-button>
							</div>
						</td>


					</tr><!----></tbody>
				</table><!----><!----></div><!----><!----><!----><!---->
			<div class="el-table__column-resize-proxy" style="display: none;"></div>
		</div>
	</el-card>
</spark-mailed-invitations>
