<el-card class="settings-container">
	<div slot="header" class="with-icon">
		<img src="{{ asset('icons/add-user.svg') }}" width="19" height="23" alt="" class="svg-title">
		<span>{{ __('Manage animal races') }}</span>
	</div>
	<race-team-configuration :team="team" :user="user" inline-template>

		<div>

			<!-- Formulaire d’ajout d’une race -->
			<el-form :inline="true" :model="form">
				<el-form-item label="{{ucfirst(__('labels.animal_race')) }}"
											prop="name_race"
											:error="form.errors.get('name_race')">
					<el-input name="name_race" id="name_race" v-model="form.name_race" placeholder="{{__('Greyhound, labrador, siamese, ...')}}"></el-input>
					<el-button type="primary" @click.prevent="store();">{{__('Add')}}</el-button>
				</el-form-item>
			</el-form>

			<!-- Liste des races -->
			<el-table :data="races"
								v-loading="loading"
								style="width: 100%; margin-top: 30px;">

				<el-table-column prop="name_race"
												 label="{{__('All animals races in database') }}">
				</el-table-column>

				<el-table-column label="{{__('Operations')}}" width="130px">
					<template slot-scope="scope">
						<el-button
										type="warning"
										size="mini"
										icon="el-icon-edit"
										@click="editRace(scope.row);">
						</el-button>
						<el-button
										type="danger"
										size="mini"
										v-if="races.length > 1"
										icon="el-icon-delete"
										@click="deleteRace(scope.row);">
						</el-button>
					</template>
				</el-table-column>
			</el-table>

			<!-- Update Race name -->
			<el-dialog
							:visible.sync="dialogUpdateRaceVisible"
							:lock-scroll="false">
				<div slot="title" class="el-dialog__title" v-if="updatingRace !== null">
					{{__('Change the race')}} « @{{ updatingRace.name_race }} »
				</div>

				<el-form :model="updateRaceForm">
					<el-form-item label="{{ucfirst(__('labels.update_race')) }}"
												prop="name_race"
												:error="updateRaceForm.errors.get('name_race')">
						<el-input name="name_race" id="name_race" value="updateColorForm.name_race" v-model="updateRaceForm.name_race" placeholder="Chien, chat, furet,…"></el-input>
					</el-form-item>
				</el-form>

				<div slot="footer" class="dialog-footer">
					<el-button @click="dialogUpdateRaceVisible = false">{{__('Cancel')}}</el-button>
					<el-button type="warning"
										 :loading="updateRaceForm.busy"
										 @click="update">
						<span v-if="updateRaceForm.busy">{{__('Update in progress')}}</span>
						<span v-else>{{__('Update')}}</span>
					</el-button>
				</div>
			</el-dialog>

			<!-- Delete Race -->
			<el-dialog
							:visible.sync="dialogDeleteRaceVisible"
							:lock-scroll="false">
							<el-alert
								title="{{__('Are you sure you want to do that ?')}}"
								type="warning"
								center
								:closable="false"
								description="{{__('You are about to delete this race. All data associated with it will be deleted and it will not be possible to retrieve it. This operation is irreversible.')}}">
        			</el-alert>	
				<div slot="title" class="el-dialog__title" v-if="deletingRace !== null">
					{{__('Delete the race')}} « @{{ deletingRace.name_race }} »
				</div>

				<!-- TODO: Insert alert -->

				<div slot="footer" class="dialog-footer">
					<el-button @click="dialogDeleteRaceVisible = false">{{__('Cancel')}}</el-button>
					<el-button type="danger"
										 :loading="deleteRaceForm.busy"
										 @click="destroyRace">
						<span v-if="deleteRaceForm.busy">{{__('Delete in progress')}}</span>
						<span v-else>{{__('Delete')}}</span>
					</el-button>
				</div>
			</el-dialog>

		</div>


	</race-team-configuration>
</el-card>
