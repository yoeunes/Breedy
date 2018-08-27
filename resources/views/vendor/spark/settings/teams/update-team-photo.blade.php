@section('custom-class', 'settings-page')

<spark-update-team-photo :user="user" :team="team" inline-template>
	<div v-if="user">
		<div class="settings-bloc-title">
			<h2 class="title__settings">{{__('Profile de l\'élevage')}}</h2>
			<el-button type="primary" size="medium">{{__('Sauvegarder')}}</el-button>
		</div>
		<div class="settings-container">
			<div class="alert alert-danger" v-if="form.errors.has('photo')">
				@{{ form.errors.get('photo') }}
			</div>
			<el-form class="form">

				<!-- Champ Image -->
				<el-form-item label="Logo">
					<el-upload
									class="avatar-uploader"
									action="https://jsonplaceholder.typicode.com/posts/"
									:show-file-list="false"
									:on-success="handleAvatarSuccess"
									:before-upload="beforeAvatarUpload">
						<img v-if="imageUrl" :src="imageUrl" class="avatar">
						<i v-else class="el-icon-plus avatar-uploader-icon"></i>
					</el-upload>
				</el-form-item>

				<!-- Champ Nom élevage -->
				<el-form-item label="Nom de l'élevage"
											prop="name"
											required>
					<el-input v-model="form.name"></el-input>
				</el-form-item>

				<div>
					<h3 class="title__subtitle">{{__('Adresse complète')}}</h3>

					<!-- Champ Rue & Numéro -->
					<el-form-item label="Rue et numéro"
												prop="address"
												required>
						<el-input v-model="form.address"></el-input>
					</el-form-item>

					<!-- Champ Rue & Numéro Ligne 2 -->
					<el-form-item label="Rue (ligne 2)"
												prop="address">
						<el-input v-model="form.address"></el-input>
					</el-form-item>
					<div class="form__address">
						<!-- Champ Ville -->
						<el-form-item label="Ville"
													prop="city"
													required>
							<el-input v-model="form.city"></el-input>
						</el-form-item>

						<!-- Champ Province -->
						<el-form-item label="Etat/Province"
													prop="province">
							<el-input v-model="form.province"></el-input>
						</el-form-item>

						<!-- Champ Code Postal -->
						<el-form-item label="Code postal"
													prop="postal"
													required>
							<el-input v-model="form.postal"></el-input>
						</el-form-item>

						<!-- Champ Pays -->
						<el-form-item label="Pays"
													prop="country"
													required>
							<el-select filterable placeholder="Choisissez un pays" id="country">
								<select-country></select-country>
							</el-select>
						</el-form-item>
					</div>
				</div>
				<div>
					<h3 class="title__subtitle">{{__('Informations de facturation')}}</h3>

					<div class="tips tips--infos middle">
						<span>{{__('Utile pour générer vos factures')}}</span>
						<p>
							Si vous remplissez les informations ci-dessous, elles apparaitront
							lorsque vous générerez des factures pour vos clients
						</p>
					</div>

					<!-- Champ Dénomination sociale -->
					<el-form-item label="Dénomination sociale"
												prop="sociale">
						<el-input v-model="form.social"></el-input>
					</el-form-item>

					<div class="form__address">

						<!-- Champ N° élevage/accréditation -->
						<el-form-item label="N° d'élevage / accréditation"
													prop="accréditation">
							<el-input v-model="form.accréditation"></el-input>
						</el-form-item>

						<!-- Champ TVA -->
						<el-form-item label="N° de TVA"
													prop="tva">
							<el-input v-model="form.tva"></el-input>
						</el-form-item>

						<!-- Champ Compte bancaire -->
						<el-form-item label="N° de compte bancaire"
													prop="bancaire">
							<el-input v-model="form.bancaire"></el-input>
						</el-form-item>

						<!-- Champ BIC/SWIFT -->
						<el-form-item label="Code BIC/SWFIT"
													prop="bic">
							<el-input v-model="form.bic"></el-input>
						</el-form-item>
					</div>

					<!-- Champ Informations supplémentaires -->
					<el-form-item label="Informations supplémenentaires"
												prop="informations">
						<el-input v-model="form.informations" type="textarea" rows="5"></el-input>
					</el-form-item>

					<el-button type="primary" size="medium">{{__('Sauvegarder')}}</el-button>

				</div>
			</el-form>

		</div>
	</div>
</spark-update-team-photo>
