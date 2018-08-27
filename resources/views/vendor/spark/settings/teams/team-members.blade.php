@section('custom-class', 'settings-page')

<spark-team-members :user="user" :team="team" inline-template>
	<!-- LISTE DES MEMBRES -->
	<el-card>
		<div slot="header" class="with-icon">
			<img src="{{ asset('icons/list-user.svg') }}" width="19" height="23" alt="" class="svg-title">
			<span>{{__('Members of the breeding')}} (@{{ team.users.length }})</span>
		</div>

		<!-- List of members -->
		<div class="el-table el-table--fit el-table--enable-row-hover el-table--enable-row-transition">
			<div class="hidden-columns">
				<div></div>
				<div></div>
				<div></div>
			</div>
			<div class="el-table__header-wrapper">
				<table cellspacing="0" cellpadding="0" border="0" class="el-table__header" style="width: 100%;">
					<colgroup>
						<col name="el-table_1_column_1" width="40%">
						<col name="el-table_1_column_2" width="40%">
						<col name="el-table_1_column_3" width="20%">
						<col name="gutter" width="0">
					</colgroup>
					<thead class="has-gutter">
					<tr>
						<th colspan="1" rowspan="1" class="el-table_1_column_1     is-leaf">
							<div class="cell">{{__('lastname')}}</div>
						</th>
						<th colspan="1" rowspan="1" class="el-table_1_column_2     is-leaf">
							<div class="cell">{{__('Role')}}</div>
						</th>
						<th colspan="1" rowspan="1" class="el-table_1_column_3     is-leaf">
							<div class="cell">{{__('Operations')}}</div>
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
						<col name="el-table_1_column_2" width="40%">
						<col name="el-table_1_column_3" width="20%">
					</colgroup>
					<tbody>
					<tr class="el-table__row" v-for="member in team.users">
						<!-- Column name -->
						<td class="el-table_1_column_1  ">
							<div class="cell" v-if="member.id === user.id">
								{{__('You')}}
							</div>
							<div class="cell" v-else>
								@{{ member.name }}
							</div>
						</td>

						<!-- Column role -->
						<td class="el-table_1_column_2">
							<div class="cell">@{{ teamMemberRole(member) }}</div>
						</td>

						<!-- Column buttons -->
						<td class="el-table_1_column_3">
							<div class="cell">
								<el-button
												v-on:click="dialogUpdateMemberVisible = true; editTeamMember(member);"
												type="warning"
												icon="el-icon-edit"
												size="mini"
												v-if="roles.length > 1 && canEditTeamMember(member)">
								</el-button>
								<el-button
												v-on:click="dialogDeleteMemberVisible = true; approveTeamMemberDelete(member);"
												type="danger"
												icon="el-icon-delete"
												size="mini"
												v-if="canDeleteTeamMember(member)">
								</el-button>
							</div>
						</td>


					</tr><!----></tbody>
				</table><!----><!----></div><!----><!----><!----><!---->
			<div class="el-table__column-resize-proxy" style="display: none;"></div>
		</div>


		<!-- Update member -->
		<el-dialog :visible.sync="dialogUpdateMemberVisible"
							 :lock-scroll="false"
							 :append-to-body="true"
							 v-on:close="updateTeamMemberForm.successful = false"
							 class="modalUpdate">

			<span slot="title" class="el-dialog__title" v-if="updatingTeamMember !== null">
				{{__('Update the role of')}} @{{ updatingTeamMember.name }}
			</span>

			<el-form :model="updateTeamMemberForm">
				<el-alert v-if="updateTeamMemberForm.successful"
									title="{{__('The role has been updated')}}"
									type="success"
									center
									style="margin-bottom: 20px;"
									show-icon>
				</el-alert>
				<el-form-item label="Rôle" style="flex-direction: row; justify-content: center">
					<el-select v-model="updateTeamMemberForm.role"
										 :error="updateTeamMemberForm.errors.get('role')">
						<el-option
										v-for="role in roles"
										:key="role.id"
										:value="role.value"
										:label="role.text">
						</el-option>
					</el-select>
				</el-form-item>
			</el-form>

			<span slot="footer" class="dialog-footer">
				<el-button @click="dialogUpdateMemberVisible = false">{{__('Cancel')}}</el-button>
				<el-button type="primary"
									 :loading="updateTeamMemberForm.busy"
				@click="update">
				<span v-if="updateTeamMemberForm.busy">{{__('Update in progress')}}</span>
				<span v-else>{{__('Update')}}</span>
				</el-button>
			</span>
		</el-dialog>

		<!-- Delete member -->
		<el-dialog :visible.sync="dialogDeleteMemberVisible"
							 :lock-scroll="false"
							 class="modalDelete">
			<span slot="title" class="el-dialog__title" v-if="deletingTeamMember !== null">
				{{__('Remove member')}} @{{ deletingTeamMember.name }}
			</span>
			<el-alert
							title="{{__('Are you sure you want to do that ?')}}"
							type="warning"
							center
							:closable="false"
							description="{{__('You are about to permanently delete this member. This action is irreversible and will update the amount of your subscription accordingly.')}}"
							show-icon>
			</el-alert>
			<span slot="footer" class="dialog-footer">
				<el-button @click="dialogDeleteMemberVisible = false">{{__('Cancel')}}</el-button>
				<el-button type="danger"
									 :loading="deleteTeamMemberForm.busy"
				@click="dialogDeleteMemberVisible = false; deleteMember(); successDelete();">
				<span v-if="deleteTeamMemberForm.busy">{{__('Delete in progress')}}</span>
				<span v-else>{{__('Yes, Delete')}}</span>
				</el-button>
			</span>
		</el-dialog>

	</el-card>

</spark-team-members>
