<el-card class="settings-container">
	<div slot="header" class="with-icon">
		<img src="{{ asset('icons/add-user.svg') }}" width="19" height="23" alt="" class="svg-title">
		<span>{{ __('Manage colors / animal dresses') }}</span>
	</div>
	<color-team-configuration :team="team" :user="user" inline-template>

		<div>

			<!-- Formulaire d’ajout d’une couleur/robe -->
			<el-form :inline="true" :model="form">
				<el-form-item label="{{ucfirst(__('labels.animal_color')) }}"
											prop="name_color"
											:error="form.errors.get('name_color')">
					<el-input name="name_color" id="name_color" v-model="form.name_color" placeholder="{{__('Mahogany, sesame, seal, ...')}}"></el-input>
					<el-button type="primary" @click.prevent="store();">{{__('Add')}}</el-button>
				</el-form-item>
			</el-form>

			<!-- Liste des couleurs/robes -->
			<el-table :data="colors"
								v-loading="loading"
								style="width: 100%; margin-top: 30px;">

				<el-table-column prop="name_color"
												 label="{{__('All animals colors in database')}}">
				</el-table-column>

				<el-table-column label="{{__('Operations')}}" width="130px">
					<template slot-scope="scope">
						<el-button
										type="warning"
										size="mini"
										icon="el-icon-edit"
										@click="editColor(scope.row);">
						</el-button>
						<el-button
										type="danger"
										size="mini"
										v-if="colors.length > 1"
										icon="el-icon-delete"
										@click="deleteColor(scope.row);">
						</el-button>
					</template>
				</el-table-column>
			</el-table>

			<!-- Update Color name -->
			<el-dialog
							:visible.sync="dialogUpdateColorVisible"
							:lock-scroll="false">
				<div slot="title" class="el-dialog__title" v-if="updatingColor !== null">
					{{__('Change the color/dress')}} « @{{ updatingColor.name_color }} »
				</div>

				<el-form :model="updateColorForm">
					<el-form-item label="{{ucfirst(__('labels.update_color')) }}"
												prop="name_color"
												:error="updateColorForm.errors.get('name_color')">
						<el-input name="name_color" id="name_color" value="updateColorForm.name_color" v-model="updateColorForm.name_color" placeholder="Chien, chat, furet,…"></el-input>
					</el-form-item>
				</el-form>

				<div slot="footer" class="dialog-footer">
					<el-button @click="dialogUpdateColorVisible = false">{{__('Cancel')}}</el-button>
					<el-button type="warning"
										 :loading="updateColorForm.busy"
										 @click="update">
						<span v-if="updateColorForm.busy">{{__('Update in progress')}}</span>
						<span v-else>{{__('Update')}}</span>
					</el-button>
				</div>
			</el-dialog>

			<!-- Delete Color -->
			<el-dialog
							:visible.sync="dialogDeleteColorVisible"
							:lock-scroll="false">
							<el-alert
								title="{{__('Are you sure you want to do that ?')}}"
								type="warning"
								center
								:closable="false"
								description="{{__('You are about to delete this color. All data associated with it will be deleted and it will not be possible to retrieve it. This operation is irreversible.')}}">
        			</el-alert>	
				<div slot="title" class="el-dialog__title" v-if="deletingColor !== null">
					{{__('Delete the color/dress')}} « @{{ deletingColor.name_color }} »
				</div>

				<!-- TODO: Insert alert -->

				<div slot="footer" class="dialog-footer">
					<el-button @click="dialogDeleteColorVisible = false">{{__('Cancel')}}</el-button>
					<el-button type="danger"
										 :loading="deleteColorForm.busy"
										 @click="destroyColor">
						<span v-if="deleteColorForm.busy">{{__('Delete in progress')}}</span>
						<span v-else>{{__('Delete')}}</span>
					</el-button>
				</div>
			</el-dialog>

		</div>


	</color-team-configuration>
</el-card>
