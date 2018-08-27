@section('custom-class', 'settings-page')

<spark-update-profile-photo :user="user" inline-template >
    <el-form class="form" :model="form">
        <!-- Title -->
        <div class="settings-bloc-title">
            <h2 class="title__settings">{{__('My profile')}}</h2>
        </div>
        <el-card>
            <div slot="header" class="with-icon">
                <img src="{{ asset('icons/list-user.svg') }}" width="19" height="23" alt="" class="svg-title">
                <span>{{__('Photo de profil')}}</span>
            </div>
            <div class="alert alert-danger" v-if="form.errors.has('photo')">
                @{{ form.errors.get('photo') }}
            </div>
            <el-form class="form" :model="form">
                <div class="form-group row justify-content-center">
					<div class="col-md-6 d-flex align-items-center">
						<div class="image-placeholder mr-4">
							<span role="img" class="profile-photo-preview" :style="previewStyle"></span>
						</div>
						<div class="spark-uploader mr-4">
							<input ref="photo" type="file" class="spark-uploader-control" name="photo" @change="update"
									:disabled=
								    "form.busy">
							<div class="btn btn-outline-dark">{{__('Update Photo')}}</div>
						</div>
					</div>
				</div>
            </el-form>
        </el-card>
    </el-form>
</spark-update-profile-photo>
