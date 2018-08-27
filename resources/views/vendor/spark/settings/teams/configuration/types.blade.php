<el-card class="settings-container">
	<div slot="header" class="with-icon">
		<img src="{{ asset('icons/add-user.svg') }}" width="19" height="23" alt="" class="svg-title">
		<span>{{ __('Manage animal types') }}</span>
	</div>
	<create-type-team-configuration :user="user" :team="team" :billable-type="billableType" inline-template>

		<div>

			<!-- Formulaire d’ajout d’un type -->
			<el-form :inline="true" :model="form">
				<el-form-item label="{{ucfirst(__('labels.animal_type')) }}"
											prop="name"
											:error="form.errors.get('name_type')"
											>
					<el-input name="name" id="name" v-model="form.name" placeholder="{{__('Dog, cat, ferret,...')}}"></el-input>
					<el-button type="primary" @click.prevent="store();">{{__('Add')}}</el-button>
				</el-form-item>
			</el-form>

			<!-- Liste des types -->
			<el-table :data="types"
								v-loading="loading"
								style="width: 100%; margin-top: 30px;">

				<el-table-column prop="name"
												 label="{{__('All animals types in database') }}">
				</el-table-column>

				<el-table-column label="{{ucfirst(__('Operations')) }}" width="130px">
					<template slot-scope="scope">
						<el-button
										type="warning"
										size="mini"
										icon="el-icon-edit"
										@click="editType(scope.row);">
						</el-button>
						<el-button
										type="danger"
										size="mini"
										v-if="types.length > 1"
										icon="el-icon-delete"
										@click="deleteType(scope.row);">
						</el-button>
					</template>
				</el-table-column>
			</el-table>

			<!-- Update Type name -->
			<el-dialog
							:visible.sync="dialogUpdateTypeVisible"
							:lock-scroll="false">
				<div slot="title" class="el-dialog__title" v-if="updatingType !== null">
					{{__('Change the type')}} « @{{ updatingType.name }} »
				</div>

				<el-form :model="updateTypeForm">
					<el-form-item label="{{ucfirst(__('labels.update_type')) }}"
												prop="name"
												:error="updateTypeForm.errors.get('name_type')">
						<el-input name="name" id="name" value="updateTypeForm.name" v-model="updateTypeForm.name" placeholder="Chien, chat, furet,…"></el-input>
					</el-form-item>
				</el-form>

				<div slot="footer" class="dialog-footer">
					<el-button @click="dialogUpdateTypeVisible = false">{{__('Cancel')}}</el-button>
					<el-button type="warning"
										 :loading="updateTypeForm.busy"
										 @click="update">
						<span v-if="updateTypeForm.busy">{{__('Update in progress')}}</span>
						<span v-else>{{__('Update')}}</span>
					</el-button>
				</div>
			</el-dialog>

			<!-- Delete Type -->
			<el-dialog
							:visible.sync="dialogDeleteTypeVisible"
							:lock-scroll="false">
				      <el-alert
								title="{{__('Are you sure you want to do that ?')}}"
								type="warning"
								center
								:closable="false"
								description="{{__('You are about to delete this type. All data associated with it will be deleted and it will not be possible to retrieve it. This operation is irreversible.')}}">
        			</el-alert>			
				<div slot="title" class="el-dialog__title" v-if="deletingType !== null">
					{{__('Delete the type')}} « @{{ deletingType.name }} »
				</div>

				<!-- TODO: Insert alert -->

				<div slot="footer" class="dialog-footer">
					<el-button @click="dialogDeleteTypeVisible = false">{{__('Cancel')}}</el-button>
					<el-button type="danger"
										 :loading="deleteTypeForm.busy"
										 @click="destroyType">
						<span v-if="deleteTypeForm.busy">{{__('Delete in progress')}}</span>
						<span v-else>{{__('Delete')}}</span>
					</el-button>
				</div>
			</el-dialog>

		</div>
	</create-type-team-configuration>
</el-card>
