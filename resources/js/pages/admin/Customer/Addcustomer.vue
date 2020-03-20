
<template>
<div>
<navbar></navbar>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid" style="min-height:100vh">
<div class="row">               
<div class="col-md-4">
<h2><img src="/icons/add.svg" style="height: 39px; width: 57px;">Add Customer</h2>
</div>
</div>
<br>
<div class="card">
<div class="card-body">
    <form @submit.prevent="addCustomer" enctype="multipart/form-data">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                 <div class="form-group">
                    <label for="name" class="lab">Name</label>
                    <input  type="text" id="name" class="form-control" v-model.trim="$v.customer.name.$model" :class="{'is-invalid' :$v.customer.name.$error, 'is-valid' :!$v.customer.name.$invalid}" style="border-radius:0px">
                    <div class="invalid-feedback">
                    <span v-if="!$v.customer.name.required"><sup>*</sup>Name is required</span>
                    <span v-if="!$v.customer.name.minLength"><sup>*</sup>Name must have at least {{$v.customer.name.$params.minLength.min}} letters</span>
                    <span v-if="!$v.customer.name.maxLength"><sup>*</sup>Name must have at mast {{$v.customer.name.$params.maxLength.max}} letters</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                 <div class="form-group">
                    <label for="name" class="lab">Customer Code</label>
                    <input  type="text" id="customer_code" class="form-control" v-model.trim="$v.customer.customer_code.$model" :class="{'is-invalid' :$v.customer.customer_code.$error, 'is-valid' :!$v.customer.customer_code.$invalid}" style="border-radius:0px">
                    <div class="invalid-feedback">
                    <span v-if="!$v.customer.customer_code.required"><sup>*</sup>Customer Code is required</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
            <label for="password_confirmation" class="lab">Currency</label>
                <select  id="saluation" class="form-control year" v-model.trim="$v.customer.currency.$model" :class="{'is-invalid' :$v.customer.currency.$error, 'is-valid' :!$v.customer.currency.$invalid}" style="border-radius:0px">
                <option v-for="ab in currency_array" :key="ab.currency_array"  >{{ab}}</option>
                </select>
                <div class="invalid-feedback">
                <span v-if="!$v.customer.currency.required"><sup>*</sup>Currency is required</span>
                </div>
                </div>
         </div>

        <div class="col-md-6">
            <div class="form-group">
                 <div class="form-group">
                    <label for="name" class="lab">Payment Terms</label>
                    <input  type="text" id="payment_terms" class="form-control" v-model.trim="$v.customer.payment_terms.$model" :class="{'is-invalid' :$v.customer.payment_terms.$error, 'is-valid' :!$v.customer.payment_terms.$invalid}" style="border-radius:0px">
                    <div class="invalid-feedback">
                    <span v-if="!$v.customer.payment_terms.required"><sup>*</sup>Payment Terms is required</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
            <label for="password_confirmation" class="lab">Country</label>
                <select  id="saluation" class="form-control year" v-model.trim="$v.customer.countries_id.$model" :class="{'is-invalid' :$v.customer.countries_id.$error, 'is-valid' :!$v.customer.countries_id.$invalid}" style="border-radius:0px">
                <option v-for="ab in country_list" :key="ab.country_list" :value=ab.id>{{ab.name}}</option>
                </select>
                <div class="invalid-feedback">
                <span v-if="!$v.customer.countries_id.required"><sup>*</sup>Country is required</span>
                </div>
                </div>
         </div>

         <div class="col-md-6">
            <div class="form-group">
                 <div class="form-group">
                    <label for="name" class="lab">Contact</label>
                    <input  type="text" id="customer_number" class="form-control" v-model.trim="$v.customer.customer_number.$model" :class="{'is-invalid' :$v.customer.customer_number.$error, 'is-valid' :!$v.customer.customer_number.$invalid}" style="border-radius:0px">
                    <div class="invalid-feedback">
                    <span v-if="!$v.customer.customer_number.required"><sup>*</sup>Customer Number is required</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                 <div class="form-group">
                    <label for="name" class="lab">Addresss</label>
                    <textarea   id="customer_address" class="form-control" v-model.trim="$v.customer.customer_address.$model" :class="{'is-invalid' :$v.customer.customer_address.$error, 'is-valid' :!$v.customer.customer_address.$invalid}" style="border-radius:0px"></textarea>
                    <div class="invalid-feedback">
                    <span v-if="!$v.customer.customer_address.required"><sup>*</sup>Customer Address is required</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
 <button class="btn btn-primary save" @click="$v.customer.$touch" title="save customer">Save&nbsp;<i class="fa fa-check"></i></button>
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
export default {
 data() {
     return{
         customer:{
            name:"",
            customer_code:"",
            currency:"",
            payment_terms:"",
            countries_id:"",
            customer_number:"",
            customer_address:"",
         },
         currency_array:['USD','SGD'],
         country_list:[]

     }
 },
  validations: {
  customer:{
            name:{
            required,
            minLength:minLength(3),
            maxLength:maxLength(30)
            },
            customer_code:{
                required
            },
            currency:{
                required
            },
            payment_terms:{
                required
            },
            countries_id:{
                required
            },
            customer_number:{
                required
            },
            customer_address:{
                required
            }
  }
  },
  methods:{
      getCountry() {
          var app = this
                this.$http({
                url: `countrylist`,
                method: 'GET',
                })
                .then((res) => {
                this.country_list= res.data.country
                }, () => {
                this.has_error = true
                }); 
      },
      addCustomer() {
          if (this.$v.$invalid) { 
          
          }
          else {      
       let currentObj=this;
          
          let app =this;
          let formData = new FormData();
          formData.append('name',app.customer.name),
          formData.append('customer_code',app.customer.customer_code),
          formData.append('currency',app.customer.currency),
          formData.append('payment_terms',app.customer.payment_terms),
          formData.append('countries_id',app.customer.countries_id),
          formData.append('customer_number',app.customer.customer_number),
          formData.append('customer_address',app.customer.customer_address),

           this.$http.post ( 'addcustomer', formData ).then(function (res) {
                    if (res.data.status=="success"){
                        app.$toasted.success('customer added successfully'); 
                         app.$router.push({name:'customerlist'});
                    }
                     else {
                        app.$toasted.success('somthing went wrong');
                        
                    } 
 
                      }); 
          }
       
      }
  },
  
  created() {
      this.getCountry();
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
    margin-right: 30px;
}
.form-control.is-invalid{
  background-image: none;
}
 .form-control:valid {
    background-image:none;
}
</style>