<template>
<div style="background:url('bg.jpg');height:100vh;">
 <div class="container">
    
     <div class="row">
          <img src="geberit-logo.svg" class="img">
     </div>
     <div class="row">
     <div class=" card col-md-5 form" >
     <div>
         <p>Your email for forgot password</p>
         <form @submit.prevent="forgotpasswords" class="register-form" id="login-form">
            <div class="form-group" style="padding: 0 18px 0 16px;">
                <label for="your_name"><i class="fa fa-envelope fa1"></i></label>
                <input type="text" name="your_name" class="form-control" id="your_name" placeholder="Your Email" v-model.trim="$v.forgotpassword.email.$model" :class="{'is-invalid' :$v.forgotpassword.email.$error, 'is-valid' :!$v.forgotpassword.email.$invalid}"/>

                <div class="invalid-feedback">
                    <span v-if="!$v.forgotpassword.email.required"><sup>*</sup>Email is required</span>
                    <span v-if="!$v.forgotpassword.email.email"><sup>*</sup>Please enter valid email</span>
                </div>
            </div>
            <div class="form-group1 mb-2">
                <router-link :to="{name:'login'}" class="btn btn-primary" style="margin-right:4%">Back To Login</router-link>
                <button  v-if="load==false" type="submit" name="signin" id="signin" class="btn btn-primary"  @click="$v.forgotpassword.$touch" style="height: 40px;margin-right:25%;width:148px;"><span class="loader"><vue-loaders-ball-spin-fade-loader color="white" scale="0.3" />
              </span><span class="send">Send Email</span></button>
               <button  v-else type="submit" name="signin" id="signin" class="btn btn-primary"  @click="$v.forgotpassword.$touch" style="height: 40px;margin-right:26%;">Send Email</button>
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
        forgotpassword:{
            email:"",
        },
        status:false,
        success:"",
        error:"",
        submitStatus:null,
        formLine:'',
        sta:"",
        err:"",
        load:true,
        

    }
},
validations: {
  forgotpassword:{
  email:{
   required,
   email
  },
  }
},

mounted(){
    this.formLine = constants.name
},

methods:{
    forgotpasswords(){
       this.$v.$touch() 
          if (this.$v.$invalid) { 
          
          }
          else {
      let app =this;
          let formData = new FormData();
          app.load = false;
          formData.append('email',app.forgotpassword.email),
         
           this.$http.post ( 'forgotpasswordemailsending', formData ).then(function (res) {
                    if (res.data.status=="success"){
                        app.load = true;
                        app.$toasted.success('Email send to this ' + app.forgotpassword.email + ' successfully'); 
                    }
                     else {
                         app.load = true;
                        app.$toasted.error('Email does not exist');
                    } 
 
                      }); 
          }
       
      }
        
},



created(){
    //console.log(constants.name);
    
}
}


</script>


<style scoped>
.send {
    position: relative;
    top: -47px;
    bottom: 0px;
    right: 52px;
}
.loader {
        position: relative;
    top: -20px;
    bottom: 0px;
    left: -43px;
    right: 0px;
}
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
.fa1 {
    color: gray;
    position: absolute;
    left: 89%;
    right: 0%;
    top: 92px;
    z-index: 1;
    bottom: 0
}
.fa2 {
    color: gray;
    position: absolute;
    left: 89%;
    right: 0%;
    top: 154px;
    z-index: 1;
    bottom: 0;
    font-size: 20px;
}
.form-group {
    margin-bottom: 0
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