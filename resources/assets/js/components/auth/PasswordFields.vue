<template>
	<div class="register__form__row" id="passGroup">
		<el-form-item label="Mot de passe"
									prop="password"
									:error="registerForm.errors.get('password')"
									required
									:rules="rulesPass.pass">
			<el-input type="password" name="password" id="password" v-model="registerForm.password">
			</el-input>
		</el-form-item>
		<!-- confirm password -->
		<el-form-item label="Confirmation du mot de passe"
									prop="password_confirmation"
									:error="registerForm.errors.get('password_confirmation')"
									:rules="rulesPass.checkPass">
			<el-input type="password" name="password_confirmation" id="password_confirmation" v-model="registerForm.password_confirmation">
			</el-input>
		</el-form-item>
	</div>
</template>

<script>
	export default {
	  data() {
      var validatePass2 = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('Please input the password again'));
        } else if (value !== this.registerForm.password) {
          callback(new Error('Two inputs don\'t match!'));
        } else {
          callback();
        }
      };
      return {
        rulesPass: {
          pass: [
            { 'min': 6, message: 'Le mot de passe doit faire au moins 6 caractères', trigger: ['blur', 'change'] }
          ],
          checkPass: [
            { validator: validatePass2, trigger: ['blur', 'change'] }
          ]
        }
      }
		},
    props: ['registerForm']
	}
</script>

<!--<script>
  var vm = new Vue({
    el: '#passGroup',
    data(){
      var validatePass = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('Please input the password'));
        } else {
          if (this.registerForm.password_confirmation !== '') {
            this.$refs.registerForm.validateField('password_confirmation');
          }
          callback();
        }
      };
      var validatePass2 = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('Please input the password again'));
        } else if (value !== this.registerForm.password) {
          callback(new Error('Two inputs don\'t match!'));
        } else {
          callback();
        }
      };
      return {
        rulesPass: {
          pass: [
            { validator: validatePass, trigger: 'blur' }
          ],
          checkPass: [
            { validator: validatePass2, trigger: 'blur' }
          ]
        }
      }
    }
  })
</script>-->
