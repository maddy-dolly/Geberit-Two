<template>
      <div>
          <navbar></navbar>
      <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid" style="min-height:100vh">
<div class="row">
<div class="col-md-6">
<h2><img src="/icons/user.svg" style="height: 39px; width: 57px;">Edit Role:{{role.name}}  </h2>
</div>
<div class="ml-auto" style="margin-right:8px;">
<router-link :to="{name:'rolelist'}" class="btn btn-warning" style="color:white"><i class="fa fa-arrow-left"></i>&nbsp;Return to list</router-link>
</div>
</div><br>
<div class="card">
  <div class="card-body">
          <form @submit.prevent="roles">
          <div class="row">
             
                  <div class="col-md-6">
                    <div  class="form-group">
                    <label  for="name" class="lab">Name</label> 
                    <input  type="text" id="name" class="form-control" v-model.trim="$v.role.name.$model" :class="{'is-invalid' :$v.role.name.$error, 'is-valid' :!$v.role.name.$invalid}">
                    <div class="invalid-feedback">
                    <span v-if="!$v.role.name.required"><sup>*</sup>Name is required</span>
                    </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div  class="form-group">
                    <label  for="name" class="lab">Display Name</label> 
                    <input  type="text" id="name" class="form-control"  v-model.trim="$v.role.displayname.$model" :class="{'is-invalid' :$v.role.displayname.$error, 'is-valid' :!$v.role.displayname.$invalid}">
                    <div class="invalid-feedback">
                    <span v-if="!$v.role.displayname.required"><sup>*</sup>Displayname is required</span>
                    </div>
                    </div>
                  </div>
           
        
          </div>
          <div class="row">
             
                  <div class="col-md-6">
                    <div  class="form-group">
                    <label  for="name" class="lab">Discount</label> 
                    <input  type="text" id="name" class="form-control"  v-model.trim="$v.role.discount.$model">
                    <!-- <div class="invalid-feedback">
                    <span v-if="!$v.role.discount.required"><sup>*</sup>Discount is required</span>
                    </div> -->
                    </div>
                  </div>
                  <div class="col-md-6">
                    
                  </div>
           
        
          </div>
          <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="lab">Year 1</label>
                         <select  id="year1" class="form-control year" @change="checkYear(1)" v-model.trim="$v.role.year1.$model" :class="{'is-invalid' :$v.role.year1.$error, 'is-valid' :!$v.role.year1.$invalid}">
                              <option >Please select</option> 
                              <option v-for="year in years" :key="year.years" >{{year}}</option>
                        </select>
                           <div class="invalid-feedback">
                              <span v-if="!$v.role.year1.required"><sup>*</sup>Year 1 is required</span>
                              </div>
                            </div>
                  </div>
                  <div class="col-md-6">
                    <div  class="form-group">
                    <label  for="name" class="lab">Discount 1</label> 
                    <input  type="text" id="name" class="form-control" placeholder="eg. -1.5, 0, 1, 2" v-model.trim="$v.role.discount1.$model" :class="{'is-invalid' :$v.role.discount1.$error, 'is-valid' :!$v.role.discount1.$invalid}">
                    <div class="invalid-feedback">
                      <span v-if="!$v.role.discount1.required"><sup>*</sup>Discount 1 is required</span>
                    </div>
                    </div>
                    </div>
                  </div>
        
               <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="lab">Year 2</label>
                         <select  id="year2" class="form-control year" @change="checkYear(2)" v-model.trim="$v.role.year2.$model" :class="{'is-invalid' :$v.role.year2.$error, 'is-valid' :!$v.role.year2.$invalid}">
                              <option >Please select</option> 
                              <option v-for="year in years" :key="year.years" >{{year}}</option>
                              </select>
                              <div class="invalid-feedback">
                                <span v-if="!$v.role.year2.required"><sup>*</sup>Year 2 is required</span>
                              </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                    <div  class="form-group">
                    <label  for="name" class="lab">Discount 2</label> 
                    <input  type="text" id="name" class="form-control" placeholder="eg. -1.5, 0, 1, 2" v-model.trim="$v.role.discount2.$model" :class="{'is-invalid' :$v.role.discount2.$error, 'is-valid' :!$v.role.discount2.$invalid}">
                    <div class="invalid-feedback">
                      <span v-if="!$v.role.discount2.required"><sup>*</sup>Discount 2 is required</span>
                    </div>
                    </div>
                  </div>
              </div>
          <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="lab">Year 3</label>
                         <select  id="year3" class="form-control year" @change="checkYear(3)" v-model.trim="$v.role.year3.$model" :class="{'is-invalid' :$v.role.year3.$error, 'is-valid' :!$v.role.year3.$invalid}">
                              <option >Please select</option> 
                              <option v-for="year in years" :key="year.years" >{{year}}</option>
                              </select>
                              <div class="invalid-feedback">
                      <span v-if="!$v.role.year3.required"><sup>*</sup>Year 3 is required</span>
                    </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                    <div  class="form-group">
                    <label  for="name" class="lab">Discount 3</label> 
                    <input  type="text" id="name" class="form-control" placeholder="eg. -1.5, 0, 1, 2" v-model.trim="$v.role.discount3.$model" :class="{'is-invalid' :$v.role.discount3.$error, 'is-valid' :!$v.role.discount3.$invalid}">
                    <div class="invalid-feedback">
                      <span v-if="!$v.role.discount3.required"><sup>*</sup>Discount 3 is required</span>
                    </div>
                    </div>
                  </div>
          </div>
          <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="lab">Year 4</label>
                         <select  id="year4" class="form-control year" @change="checkYear(4)" v-model.trim="$v.role.year4.$model" :class="{'is-invalid' :$v.role.year4.$error, 'is-valid' :!$v.role.year4.$invalid}">
                              <option >Please select</option> 
                              <option v-for="year in years" :key="year.years" >{{year}}</option>
                              </select>
                              <div class="invalid-feedback">
                                <span v-if="!$v.role.year4.required"><sup>*</sup>Year 4 is required</span>
                              </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                    <div  class="form-group">
                    <label  for="name" class="lab">Discount 4</label> 
                    <input  type="text" id="name" class="form-control" placeholder="eg. -1.5, 0, 1, 2" v-model.trim="$v.role.discount4.$model" :class="{'is-invalid' :$v.role.discount4.$error, 'is-valid' :!$v.role.discount4.$invalid}">
                    <div class="invalid-feedback">
                      <span v-if="!$v.role.discount4.required"><sup>*</sup>Discount 4 is required</span>
                    </div>
                    </div>
                  </div>
          </div>
          <button class="btn btn-primary save" @click="$v.role.$touch" title="Edit role">Save&nbsp;<i class="fa fa-check"></i></button>
          </form>
  </div>
</div>
         </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
   
    <!-- Main content -->
   
      </div>
      <footerr></footerr>
      </div>
</template>
<script>
import { required, minLength, maxLength, between, email } from 'vuelidate/lib/validators'

  export default {
      data() {
          return {
               role:{
            name:"",
            displayname:"",
            discount:"",
            year1:"",
            year2:"",
            year3:"",
            year4:"",
            discount1:"",
            discount2:"",
            discount3:"",
            discount4:"",
        },
            years:['2020','2021','2022','2023','2024','2025'],
            tasks:{}
          }
      },
      validations: {
  role:{
  name:{
   required,
   
  },
  displayname:{
    required,
  },
  discount:{
    // required,
  },
  discount1:{
    required,
  },
  discount2:{
    required,
  },
  discount3:{
    required,
  },
  discount4:{
    required,
  },
  year1:{
    required,
  },
  year2:{
    required,
  },
  year3:{
    required,
  },
  year4:{
    required,
  }
  }
},
methods:{
  roles() {
     this.$v.$touch() 
          if (this.$v.$invalid) { 
          
          }
          else {
       let currentObj=this;
          
          let app =this;
          this.$http({
                      url: `updaterole/`+this.$route.params.id,
                      method: 'POST',
                      data: {
                      name:app.role.name,
                      display_name:app.role.displayname,
                      discount:app.role.discount,
                      year_1:app.role.year1,
                      discount_1:app.role.discount1,
                      year_2:app.role.year2,
                      discount_2:app.role.discount2,
                      year_3:app.role.year3,
                      discount_3:app.role.discount3,
                      year_4:app.role.year4,
                      discount_4:app.role.discount4,
                      }
                      })
                      .then((res) => {
                      this.status = res.data.status;
                      app.$toasted.success('Role updated successfully'); 
                      app.$router.push({name:'rolelist'}); 
                      }, () => {
                      this.has_error = true
                      }); 
          }

  },

    getRecord() {
       this.$http({
                url: `showrole/`+this.$route.params.id,
                method: 'GET',
                })
                .then((res) => {
                this.role.name= res.data.users['name'],
                this.role.displayname= res.data.users['display_name'],
                this.role.discount= res.data.users['discount'],
                this.role.year1= res.data.users['year_1'],
                this.role.discount1= res.data.users['discount_1'],
                this.role.year2= res.data.users['year_2'],
                this.role.discount2= res.data.users['discount_2'],
                this.role.year3= res.data.users['year_3'],
                this.role.discount3= res.data.users['discount_3'],
                this.role.year4= res.data.users['year_4'],
                this.role.discount4= res.data.users['discount_4'],
                console.log(this.tasks);
                
                this.status = res.data.status
                //console.log(res);
                
                }, () => {
                this.has_error = true
                }); 
     } , 

  checkYear(element) {
      let app = this;
      var curr_year=$("#year"+element).val();
      $(".year").each(function(index,value){
          if(index!==element-1){
          if($(this).val()==curr_year){
              //$("#year"+element).val('');
              //console.log( app.$refs[this.role.year+element].value);
              if(element==1)
                app.role.year1='';
              else if(element==2)
                app.role.year2='';
              else if(element==3)
                app.role.year3='';
              else if(element==4)
                app.role.year4='';
              app.$toasted.error('This value already selected in other years');
          }
          }
      })
  }
},
      
    mounted() {
     this.getRecord();
    }
  }
</script>
<style scoped>
label {
    font-weight: normal;
    color: black;
}
.save {
    color: white;
    margin-top: 4%;
    float: right;
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