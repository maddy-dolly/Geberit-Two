
<template>
<div>
<navbar></navbar>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid" style="min-height:100vh;">
<div class="row">
<div class="col-md-6">
    <h2><img src="/icons/man.svg" style="height: 39px; width: 57px;">Edit User:{{user['name']}}  </h2>
</div>
    <div class="ml-auto" style="margin-right:8px;">
        <router-link :to="{name:'userlist'}" class="btn btn-warning" style="color:white"><i class="fa fa-arrow-left"></i>&nbsp;Return to list</router-link>
    </div>
</div><br> 
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
                        <i class="fa fa-upload"></i> UPLOAD
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
                        <option value="" disabled>Please select</option> 
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
        <input  type="password" id="name" class="form-control" v-model.trim="$v.user.password.$model" style="border-radius:0px">
        
        </div>
     <!-- 4 -->
     <div class="form-group">
    <label for="name" class="lab">Countries</label>
        <multiselect v-model.trim="$v.user.countries_id.$model" :class="{'is-invalid' :$v.user.countries_id.$error, 'is-valid' :!$v.user.countries_id.$invalid}" :options="country_list" :multiple="true" placeholder="Pick some" label="text" track-by="text" @input="onChange">
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
                    <input  type="password" id="name" class="form-control" v-model="user.password_confirmation" style="border-radius:0px">
                    <div class="invalid-feedback">
                     <!-- <span v-if="!$v.user.password_confirmation.required"><sup>*</sup>Password is required</span> -->
                    </div>
     </div>
     <!-- 4 -->
     <div class="form-group">
    <label for="password_confirmation" class="lab">Role</label>
         <Select2 id="role" class="year" v-model.trim="$v.user.role_id.$model" :class="{'is-invalid' :$v.user.role_id.$error, 'is-valid' :!$v.user.role_id.$invalid}" style="border-radius:0px" :options="role_list" >
            <option disabled value="0" hidden>Select one</option>
        </Select2>
    <div class="invalid-feedback">
    <span v-if="!$v.user.role_id.required"><sup>*</sup>countries is required</span>
    </div>
    </div>
    </div>
</div>
<button class="btn btn-primary save" @click="$v.user.$touch">Save<i class="fa fa-check"></i></button>
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
        tasks:[],
        value:[],

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
           // minLength:minLength(3),
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
            profile_picture:{
            required,
            },
            role_id:{
            required,
            },
            countries_id:{
            //required,
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
         this.$v.$touch() 
          if (this.$v.$invalid) { 
          
          }
          else {      
       let currentObj=this;
          
          let app =this;
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
           this.$http.post ( 'update/'+this.$route.params.id, formData ).then(function (res) {
                    if (res.data.status=="success"){
                        app.$toasted.success('User updated successfully'); 
                        app.$router.push({name:'userlist'});
                    }
                     else {
                        let errors=res.data.errors.email;
                        app.$toasted.error(errors);
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
       getRecord() {
        var app=this;
       this.$http({
                url: `users/`+this.$route.params.id,
                method: 'GET',
                })
                .then((res) => {
                app.user= res.data.user;
                
                app.logoPreview="/uploads/"+app.user.profile_picture;
                app.user.countries_id=[];
                app.value=app.user.country_id;
                let country_ids=res.data.user.country_id;
                $.each(app.country_list,function(index,value){
                    if($.inArray(value.id, country_ids )!=-1){
                        app.user.countries_id.push({'text': value.text, 'id': value.id});
                    }
                });
                }, () => {
                this.has_error = true
                }); 
     } ,
     
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
      onChange (value) {
        console.log(value); 
        let app=this;
        app.value=[];
        $.each(value,function(index,val){
            app.value.push(val.id);

        })
        
    },
 },
 created() {
        this.getRole();
        this.getCountry();
        this.getRecord();
     

 }   
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
    margin-left: 8px;
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
    margin-right:30px;
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
h2 {
    color: black;
    font-size: 20px;
    font-weight: bold;
}
p {
    color: black;
}
li {
   color: black; 
}
.form-control.is-invalid{
  background-image: none;
}
 .form-control:valid {
    background-image:none;
}
</style>