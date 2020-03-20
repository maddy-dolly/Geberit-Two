<template>
<div style="background:url('../bg.jpg');height:100vh;">
 <div class="container">
    
     <div class="row">
          <img :src="img_url" class="img">
     </div>
     <div class="row">
     <div class=" card col-md-5 form" >
     <div>
         <p>Reset your password</p>
         <form @submit.prevent="logins" class="register-form" id="login-form">
             <div class="form-group" style="padding: 0 18px 0 16px;">
                <label for="your_pass"><i class="fa fa-lock fa1"></i></label>
                <input type="password" class="form-control" name="your_pass" id="your_pass" placeholder="Password" v-model.trim="$v.login.password.$model" :class="{'is-invalid' :$v.login.password.$error, 'is-valid' :!$v.login.password.$invalid}"/>
                <div class="invalid-feedback">
                    <span v-if="!$v.login.password.required"><sup>*</sup>Password is required</span>
                </div>
            </div>
            <div class="form-group" style="padding: 0 18px 0 16px;">
                <label for="your_pass"><i class="fa fa-lock fa2"></i></label>
                <input type="password" class="form-control" name="your_pass" id="your_pass" placeholder="password confirm" v-model.trim="$v.login.password_confirmation.$model" :class="{'is-invalid' :$v.login.password_confirmation.$error, 'is-valid' :!$v.login.password_confirmation.$invalid}"/>
                <div class="invalid-feedback">
                    <span v-if="!$v.login.password_confirmation.required"><sup>*</sup>Confirm Password is required</span>
                </div>
            </div>
            <div class="form-group1 mb-2" style="padding-left: 4%;">
                <button  type="submit" name="signin" id="signin" class="btn btn-primary"  @click="$v.login.$touch" style="height: 42px;margin-right: 4%;" >Reset Password</button>
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
            password_confirmation:"",
            password:""
        },
        status:false,
        success:"",
        error:"",
        submitStatus:null,
        formLine:'',
        sta:"",
        err:"",
        img_url:"../geberit-logo.svg"
        

    }
},
validations: {
  login:{
  password_confirmation:{
   required,
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
       let app =this;
          let formData = new FormData();
          formData.append('password',app.login.password),
          formData.append('password_confirmation',app.login.password_confirmation),
          formData.append('token',this.$route.params.token);
           this.$http.post ( 'forgotpassword', formData ).then(function (res) {
                    if (res.data.status=="success"){
                        app.$toasted.success('Password update successfully');
                        app.$router.push({name:'login'});
 
                    }
                     else if(res.data.status=="error2") {
                        app.$toasted.error('Token validity is expire.');
                        
                    } 
                    else if(res.data.status=="error3") {
                        app.$toasted.error('The password is not updated for particular email');
                    }
                    else {
                        app.$toasted.error('The confirm password is not match.');
                    }
 
                      }); 
      }
    }
        
},



created(){
    console.log(this.$route.params);
    
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
.register-form .form-group {
    position: relative;
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

 .form-control:valid {
    background-image:none;
}


</style>