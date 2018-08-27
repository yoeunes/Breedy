@section('custom-class', 'settings-page')

<spark-current-teams    :user="user" 
                        :teams="teams" 
                        inline-template>
                        
    <div>
        <el-card>
            <div slot="header" class="with-icon">
                <img src="{{ asset('icons/list-user.svg') }}" width="19" height="23" alt="" class="svg-title">
                <span>{{__('Current Teams')}}</span>
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
                            <col name="el-table_1_column_1" width="40%">
                            <col name="el-table_1_column_2" width="30%">
                            <col name="el-table_1_column_3" width="30%">
                            <col name="gutter" width="0">
                        </colgroup>
                        <thead class="has-gutter">
                        <tr>
                            <th colspan="1" rowspan="1" class="el-table_1_column_1     is-leaf">
                                <div class="cell">{{__('Name')}}</div>
                            </th>
                            <th colspan="1" rowspan="1" class="el-table_1_column_2     is-leaf">
                                <div class="cell">{{__('Owner')}}</div>
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
                            <col name="el-table_1_column_2" width="30%">
                            <col name="el-table_1_column_3" width="30%">
                        </colgroup>
                        <tbody>
                        <tr class="el-table__row" v-for="team in teams">

                            <!-- Column name -->
                            <td class="el-table_1_column_1 cell">
                                @{{ team.name }}
                            </td>

                            <!-- Column name -->
                            <td class="el-table_1_column_2 cell">
                                <span v-if="user.id == team.owner.id">
                                        {{__('You')}}
                                </span>

                                <span v-else>
                                    @{{ team.owner.name }}
                                </span>
                            </td>

                            <!-- Column name -->
                            <td class="el-table_1_column_3 cell">
                                <a :href="'/settings/{{Spark::teamsPrefix()}}/'+team.id">
                                        <el-button
                                                icon="el-icon-setting"
                                                size="small"
                                                type="info">
                                        </el-button>
                                    </a>
                                
                                    <el-button  v-if="user.id !== team.owner_id"
                                                @click="dialogLeaveTeamVisible = true; approveLeavingTeam(team)"
                                                icon="el-icon-back"
                                                size="small"
                                                type="warning">

                                    </el-button>

                                    @if (Spark::createsAdditionalTeams())
                                        <el-button  v-if="user.id === team.owner_id"
                                                    @click="dialogDeleteTeamVisible = true; approveTeamDelete(team)"
                                                    type="danger" 
                                                    icon="el-icon-delete"
                                                    size="small">
                                        </el-button>
                                    @endif
                            </td>
                        </tr><!----></tbody>
                    </table><!----><!----></div><!----><!----><!----><!---->
                <div class="el-table__column-resize-proxy" style="display: none;"></div>
            </div>
        </el-card>
    <div>

    <el-dialog :visible.sync="dialogLeaveTeamVisible"
                            :lock-scroll="false"
                            :append-to-body="true"
                            class="modalUpdate"
                            v-if="leavingTeam">
        
        <span slot="title" class="el-dialog__title">
			{{__('Quitter l\'élevage')}} (@{{ leavingTeam.name }})
        </span>
        <el-alert
            title="{{__('Are you sure you want to do that ?')}}"
            type="warning"
            center
            :closable="false"
            description="{{__('Vous êtes sur le point de quitter cet élevage. Toutes les données qui y sont associées seront supprimée et il ne sera pas possible de les récupérer. Cette opération est irréversible.')}}">
        </el-alert>
        <span slot="footer" class="dialog-footer">
            <el-button @click="dialogLeaveTeamVisible = false">{{__('Cancel')}}</el-button>
            <el-button type="warning"
                        :loading="leaveTeamForm.busy"
            @click="dialogLeaveTeamVisible = false; leaveTeam(); successLeave();">
                <span v-if="leaveTeamForm.busy">{{__('Leave in progress')}}</span>
				<span v-else>{{__('Yes, Leave')}}</span>
            </el-button>
        </span>

    </el-dialog>
    
    <!-- Dialog Delete Team -->
    <el-dialog :visible.sync="dialogDeleteTeamVisible"
							 :lock-scroll="false"
							 :append-to-body="true"
                             class="modalUpdate"
                             v-if="deletingTeam">

        	<span slot="title" class="el-dialog__title">
				{{__('Supprimer l\'élevage')}}
            </span>
            <el-alert
                title="{{__('Are you sure you want to do that ?')}}"
                type="warning"
                center
                :closable="false"
                description="{{__('Vous êtes sur le point de supprimer définitivement cet élevage. Toutes les données qui y sont associées seront supprimée et il ne sera pas possible de les récupérer. Cette opération est irréversible.')}}">
            </el-alert>
            <span slot="footer" class="dialog-footer">
				<el-button @click="dialogDeleteTeamVisible = false">{{__('Cancel')}}</el-button>
				<el-button type="danger"
							:loading="deleteTeamForm.busy"
				@click="dialogDeleteTeamVisible = false; deleteTeam(); successDelete();">
				<span>{{__('Oui, quitter')}}</span>
				</el-button>
            </span>
    </el-dialog>
        

    </div>
    </div>
</spark-current-teams>
