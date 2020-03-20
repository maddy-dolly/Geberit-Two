
<template>
<div>
<navbar></navbar>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid" style="min-height:100vh;margin-left: 24px;">
<div class="row">               
<div class="col-md-4">
<h2><img src="/icons/add.svg" style="height: 39px; width: 57px;">Add User</h2>
</div>
</div>
<br>
<div class="card">
<div class="card-body">
<form @submit.prevent="addUser" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-3">
        <div class="col-md-12">
            <img :src=logoPreview class="thumb"> 
        </div>
        <div class="col-md-12">
            <div class="col imgbtn">
                <div class="upload-btn-wrapper">
                    <button class="btn btn1">
                        <i class="fa fa-upload" style=" margin-left: 8px;"></i> UPLOAD
                    </button> 
                        <input @change="imageChanged"  accept="image/jpg, image/jpeg, image/png, image/webp" type="file" name="profile" id="profile" :class="{ 'is-invalid': $v.user.profile_picture.$error }" >
                             <div class="invalid-feedback">
                              <span v-if="!$v.user.profile_picture.required"><sup>*</sup>File is required</span>
                             </div>
                        </div>
                        </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                  <label for="name" class="lab">Saluation</label>
                     <select  id="saluation" class="form-control year" v-model.trim="$v.user.saluation.$model" :class="{'is-invalid' :$v.user.saluation.$error, 'is-valid' :!$v.user.saluation.$invalid}" style="border-radius:0px">
                        <option value="" disabled >Please select saluation</option> 
                        <option v-for="ab in abb" :key="ab.abb" >{{ab}}</option>
                     </select>
                    <div class="invalid-feedback">
                    <span v-if="!$v.user.saluation.required"><sup>*</sup>Saluation is required</span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="name" class="lab">Name</label>
                    <input  type="text" id="name" class="form-control" v-model.trim="$v.user.name.$model" :class="{'is-invalid' :$v.user.name.$error, 'is-valid' :!$v.user.name.$invalid}" style="border-radius:0px" @change="changeName">
                    <div class="invalid-feedback">
                    <span v-if="!$v.user.name.required"><sup>*</sup>Name is required</span>
                    <span v-if="!$v.user.name.minLength"><sup>*</sup>Name must have at least {{$v.user.name.$params.minLength.min}} letters</span>
                    <span v-if="!$v.user.name.maxLength"><sup>*</sup>Name must have at mast {{$v.user.name.$params.maxLength.max}} letters</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2 -->
        <div class="form-group">
        <label for="name" class="lab">Contact Number</label>
        <input  type="text" id="name" class="form-control" v-model.trim="$v.user.contact_number.$model" :class="{'is-invalid' :$v.user.contact_number.$error, 'is-valid' :!$v.user.contact_number.$invalid}" style="border-radius:0px">
        <div class="invalid-feedback">
        <span v-if="!$v.user.contact_number.required"><sup>*</sup>contact is required</span>
        </div>
        </div>
      <!-- 3 -->
        <div class="form-group">
        <label for="name" class="lab">Password</label>
        <input  type="password" id="name" class="form-control" v-model.trim="$v.user.password.$model" :class="{'is-invalid' :$v.user.password.$error, 'is-valid' :!$v.user.password.$invalid}" style="border-radius:0px">
        <div class="invalid-feedback">
        <span v-if="!$v.user.password.required"><sup>*</sup>Password is required</span>
        <span v-if="!$v.user.password.minLength"><sup>*</sup>Password must have at least {{$v.user.password.$params.minLength.min}} letters</span>
        </div>
        </div>
     <!-- 4 -->
     <div class="form-group">
    <label for="name" class="lab">Countries</label>
    <multiselect v-model.trim="$v.user.countries_id.$model" :class="{'is-invalid' :$v.user.countries_id.$error, 'is-valid' :!$v.user.countries_id.$invalid}" :options="country_list" :multiple="true" placeholder="Please select country" label="text" track-by="text" @input="onChange">
   </multiselect>
    <div class="invalid-feedback">
    <span v-if="!$v.user.countries_id.required"><sup>*</sup>countries is required</span>
    </div>
    </div>

    </div>
    <div class="col-md-4">
            <!-- 2 -->
        <div class="form-group">
                    <label for="name" class="lab">Abbreviation</label>
                    <input  type="text" id="abbreviation" class="form-control" v-model.trim="$v.user.abbreviation.$model" :class="{'is-invalid' :$v.user.abbreviation.$error, 'is-valid' :!$v.user.abbreviation.$invalid}" style="border-radius:0px">
                    <div class="invalid-feedback">
                    <span v-if="!$v.user.abbreviation.required"><sup>*</sup>Abbreviation is required</span>
                    <span v-if="!$v.user.abbreviation.maxLength"><sup>*</sup>Abbreviation must have at mast {{$v.user.abbreviation.$params.maxLength.max}} letters</span>
                    </div>
      </div>
      <!-- 3 -->
         <div class="form-group">
                    <label for="name" class="lab">Email</label>
                    <input  type="text" id="name" class="form-control" v-model.trim="$v.user.email.$model" :class="{'is-invalid' :$v.user.email.$error, 'is-valid' :!$v.user.email.$invalid}" style="border-radius:0px">
                    <div class="invalid-feedback">
                    <span v-if="!$v.user.email.required"><sup>*</sup>Email is required</span>
                    <span v-if="!$v.user.email.email"><sup>*</sup>Please enter valid email</span>
                    </div>
     </div>
      <!-- 3 -->
      <div class="form-group">
                    <label for="name" class="lab">Confirm Password</label>
                    <input  type="password" id="name" class="form-control" v-model.trim="$v.user.password_confirmation.$model" :class="{'is-invalid' :$v.user.password_confirmation.$error, 'is-valid' :!$v.user.password_confirmation.$invalid}" style="border-radius:0px">
                    <div class="invalid-feedback">
                     <span v-if="!$v.user.password_confirmation.required"><sup>*</sup>Password is required</span>
                    </div>
     </div>
     <!-- 4 -->
     <div class="form-group">
    <label for="password_confirmation" class="lab">Role</label>
        <Select2 id="role" class="year" v-model.trim="$v.user.role_id.$model" :class="{'is-invalid' :$v.user.role_id.$error, 'is-valid' :!$v.user.role_id.$invalid}" style="border-radius:0px" :options="role_list" label='Select role' >
            <option disabled value="0">Select one</option>
        </Select2>
    <div class="invalid-feedback">
    <span v-if="!$v.user.role_id.required"><sup>*</sup>countries is required</span>
    </div>
    </div>

    </div>
</div>
<button v-if="load==false" class="btn btn-primary save" @click="$v.user.$touch">Save<vue-loaders-ball-spin-fade-loader color="white" scale="0.3" /></button>

<button v-else class="btn btn-primary save" @click="$v.user.$touch">Save&nbsp;<i class="fa fa-check"></i></button>
</form>
</div>
</div>
</div>
</div>
</div>
<footerr></footerr> 
</div>
</template>
<script>
import { required, minLength, maxLength, between, email } from 'vuelidate/lib/validators'
import Select2 from 'v-select2-component';
import Multiselect from 'vue-multiselect'
export default {
     components: {
      Select2,
      Multiselect
  },
 data() {
    return {
         user:{
            name:"",
            email:"",
            password:"",
            password_confirmation:"",
            saluation:"",
            abbreviation:"",
            contact_number:"",
            profile_picture:"",
            role_id:"",
            countries_id:[]
        },
        abb:['Mr.','Mrs.','Miss'],
        logo:'',
        logoPreview:'/user.jpeg',
        country_list:[],
        role_list:[],
        value: [],
        load:true
    }
 },
  validations: {
  user:{
            name:{
            required,
            minLength:minLength(3),
            maxLength:maxLength(15)
            },
            email:{
            required,
            email
            },
            password:{
            required,
            minLength:minLength(3),
            },
            saluation:{
            required,
            },
            abbreviation:{
            required,
            maxLength:maxLength(4)
            },
            contact_number:{
            required,
            },
            password_confirmation:{
            required,
            },
            profile_picture:{
            //required,
            },
            role_id:{
            required,
            },
             countries_id:{
            required,
            },
           
  }
  },
  
 methods: {
    
    changeName(){
        let app=this;
        app.user.abbreviation='';
        let name_arr=app.user.name.split(" ");
        let count=name_arr.length;
        $(name_arr).each(function(index,value){
            app.user.abbreviation=app.user.abbreviation + value.substring(0,1).toUpperCase();
        });
        
    },
     addUser() {
          if (this.$v.$invalid) { 
          
          }
          else {      
       let currentObj=this;
          
          let app =this;
          app.load = false;
          let formData = new FormData();
          formData.append('name',app.user.name),
          formData.append('email',app.user.email),
          formData.append('password',app.user.password),
          formData.append('password_confirmation',app.user.password_confirmation),
          formData.append('saluation',app.user.saluation),
          formData.append('abbreviation',app.user.abbreviation),
          formData.append('contact_number',app.user.contact_number),
          formData.append('role_id',app.user.role_id),
          formData.append('profile_picture',app.user.profile_picture),
          formData.append('countries',app.value)
           this.$http.post ( 'auth/register', formData ).then(function (res) {
                    if (res.data.status=="success"){
                        app.load = true;
                        app.$toasted.success('User added successfully'); 
                        app.$router.push({name:'userlist'});
                    }
                    else if(res.data.status=="error1") {
                         app.load = true;
                        app.$toasted.error('User with this role already exists.');
                    }
                     else {
                        app.load = true;
                        let errors=res.data.errors.email;
                        app.$toasted.error(errors);
                        let error=res.data.errors.password;
                        app.$toasted.error(error);
                    } 
                    
 
                      }); 
          }
          
     },
   
     getRole() {
          var app = this
                this.$http({
                url: `showrole`,
                method: 'GET',
                })
                .then((res) => {
                let role_arr= res.data.users;
                //console.log(this.gridData);
                $.each(role_arr,function(index, value){
                    app.role_list.push({'id':value.id,'text':value.display_name})
                })
                this.status = res.data.status
                //console.log(res);
                
                }, () => {
                this.has_error = true
                }); 
      },
      getCountry() {
          var app = this
                this.$http({
                url: `countrylist`,
                method: 'GET',
                })
                .then((res) => {
                let country_arr= res.data.country;
                //console.log(this.gridData);
                 $.each(country_arr,function(index, value){
                    app.country_list.push({'id':value.id,'text':value.name})
                }) 
                this.status = res.data.status
                //console.log(res);
                
                }, () => {
                this.has_error = true
                }); 
      },
      onChange (value) {
          
        let app=this;
        app.value=[];
        $.each(value,function(index,val){
        app.value.push(val.id);
        })
        },
     
      imageChanged(e) {
         this.logo = e.target.files[0];
         this.user.profile_picture = e.target.files[0];
         console.log(this.user.profile_picture);
         let reader = new FileReader();
         reader.addEventListener("load", function () {
         this.logoPreview = reader.result;
         }.bind(this), false);
         reader.readAsDataURL(this.logo);
      },
 },
 created() {
        this.getRole();
        this.getCountry();
 },
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
.imgbtn {
    margin-left: 10%;
}
.upload-btn-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
}
.btn1 {
    color: black;
    background-color: white;
    padding: 8px 20px;
    cursor: pointer;
    font-size: 1.1em;
    font-weight: bold;
}
.btn1 i {
    color: #2B71B9;
}
i {
    cursor: pointer;
    opacity: .56;
   
}
.upload-btn-wrapper input[type=file] {
    cursor: pointer;
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
}
input {
    overflow: visible;
}
.thumb {
    padding: 0.25rem;
    background-color: #f8fafc;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    height: 239px;
    width: 230px;
}
label {
    font-weight: normal;
    color: black;
}
.save {
    color: white;
    margin-top: 4%;
    float: right;
    margin-right: 30px;
}

label {
    color: black;
}

/deep/.select2-container--default .select2-selection--single {
    height: 40px;
    border-radius: 0px;
  
}
/deep/.select2-container--default .select2-selection--single .select2-selection__rendered {
  
    line-height: 34px;
}
/deep/.select2-container--default .select2-selection--single .select2-selection__arrow b {
    top:61%;
    margin-top: 0;
    
}
/deep/.vue-loaders.ball-spin-fade-loader {
    top: auto;
    left: auto;
    border: 5px solid transparent;
    width: 26px;
    height: 3px;
}
.form-control.is-invalid{
  background-image: none;
}
 .form-control:valid {
    background-image:none;
}
</style>