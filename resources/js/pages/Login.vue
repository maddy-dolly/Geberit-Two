<template>
<div style="background:url('bg.jpg');height:100vh;">
 <div class="container">
    
     <div class="row">
          <img src="geberit-logo.svg" class="img">
     </div>
     <div class="row">
     <div class=" card col-md-5 form" >
     <div>
         <p>{{this.formLine}}</p>
         <form @submit.prevent="logins" class="register-form" id="login-form">
            <div class="form-group" style="padding: 0 18px 0 16px;">
                <label for="your_name"><i class="fa fa-envelope fa1"></i></label>
                <input type="text" name="your_name" class="form-control" id="your_name" placeholder="Your Email" v-model.trim="$v.login.email.$model" :class="{'is-invalid' :$v.login.email.$error, 'is-valid' :!$v.login.email.$invalid}"/>

                <div class="invalid-feedback">
                    <span v-if="!$v.login.email.required"><sup>*</sup>Email is required</span>
                    <span v-if="!$v.login.email.email"><sup>*</sup>Please enter valid email</span>
                </div>
            </div>
            <div class="form-group" style="padding: 0 18px 0 16px;">
                <label for="your_pass"><i class="fa fa-lock fa2"></i></label>
                <input type="password" class="form-control" name="your_pass" id="your_pass" placeholder="Password" v-model.trim="$v.login.password.$model" :class="{'is-invalid' :$v.login.password.$error, 'is-valid' :!$v.login.password.$invalid}"/>
                <div class="invalid-feedback">
                    <span v-if="!$v.login.password.required"><sup>*</sup>Password is required</span>
                </div>
            </div>
                <span style="color:red"><sup></sup>{{err}}</span>
            <div class="form-group1 mb-2" style="padding-left: 4%;">
                <router-link :to="{name:'forgotpassword'}" class="forgot-password">I forgot my password</router-link>
                <button  type="submit" name="signin" id="signin" class="btn btn-primary"  @click="$v.login.$touch" style="height: 42px;
    margin-right: 4%;" > Sign in</button>
            </div>
        </form>
     </div>
 </div>
</div>
</div>
</div>
</template>
<script>
import { required, minLength, maxLength, between, email } from 'vuelidate/lib/validators'
import constants from '../constant.js'
export default{
data(){
    return {
        login:{
            email:"",
            password:""
        },
        status:false,
        success:"",
        error:"",
        submitStatus:null,
        formLine:'',
        sta:"",
        err:""
        

    }
},
validations: {
  login:{
  email:{
   required,
   email
  },
  password:{
    required,
  }
  }
},

mounted(){
    this.formLine = constants.name
},

methods:{
    logins(){
       this.$v.$touch() 
          if (this.$v.$invalid) { 
          
          }
          else {
       let currentObj=this;
          

        var redirect = this.$auth.redirect()
        var app = this
        this.$auth.login({
          params: {
            email: app.login.email,
            password: app.login.password
          },
          success: function(res) {
            //   console.log(res);
              
            //  console.log(this.$auth.user());
             localStorage.setItem('id',res.data.data.id);
             localStorage.setItem('role_id',res.data.data.role_id);
             app.$toasted.success('You loggedin successfully');
            // const redirectTo = redirect ? redirect.from.name : this.$auth.user().role_id === 6 ? 'admin.dashboard' : 'dashboard'
            this.$router.push({name: 'admin.dashboard'}) 
          },
          error: function() {
              app.err='*Your credential is not matched ';
            app.$toasted.error(app.err);
            app.has_error = true
          },
          rememberMe: true,
          fetchUser: true
        })
          }
      },
      
        
},



created(){
    //console.log(constants.name);
    
}
}


</script>


<style scoped>
.form {
   margin: auto;
   margin-top:3%;
}
.img {
    margin:auto;
    margin-top:20%;
    height: 31px;
}
.card {
    border-radius: 0
}
p{
    text-align: center;
    color: gray;
    margin-top: 7%;
    margin-bottom: 0;
   
}
.form-control {
    border-radius: 0;
    position: relative;
}
.fa1{
    color: gray;
    position: absolute;
    right: 30px;
    top: 36px;
    z-index: 1;
    bottom: 0;
}
.fa2{
    color: gray;
    position: absolute;
    right: 30px;
    top: 37px;
    z-index: 1;
    font-size: 17px;
}
.form-group {
    margin-bottom: 0
}
.forgot-password {
   color:  #51B8EE;
   cursor: pointer;
}
.btn {
    float: right;
    padding-left: 31px;
    margin-bottom: 17px;
    padding-right: 27px;
}
.form-group1{
    margin-top: 4%; 
}
.form-control.is-invalid{
  background-image: none;
}
.register-form .form-group {
    position: relative;
}
 .form-control:valid {
    background-image:none;
}

</style>