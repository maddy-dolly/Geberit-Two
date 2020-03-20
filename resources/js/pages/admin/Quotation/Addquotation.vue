<template>
<div>
<navbar></navbar>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid" style="min-height:100vh">
<div class="row">               
<div class="col-md-4">
<h2><img src="/icons/newsadd.svg" style="height: 39px; width: 57px;">Add Quotation</h2>
</div>
</div>
<br>
<form @submit.prevent="addQuotation">
<div class="card">
    <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Customer Name</label>
                          <Select2  class="year1" style="border-radius:0px" :options="usercustomer_list" label='Select list' v-model="quotation.customers_id" @change="autoUpdateCountryCurrency">
                         </Select2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Country</label>
                    <input type="text" class="form-control" disabled style="border-radius:0px;" placeholder="Country" v-model="quotation.countries_id">
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top:2%">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Project Name</label>
                        <input type="text" class="form-control"  style="border-radius:0px;" placeholder="Project Name" v-model="quotation.project_name">
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Quotation For</label>
                     <Select2  class="year" style="border-radius:0px" :options="quotation_for_list" label='Select role' v-model="quotation.quotation_for">
                     </Select2>
                </div>
            </div>
            <div class="row" style="margin-top:2%">
                <div class="col-md-12">
                    <div class="form-group">
                    <label>Remarks</label>
                    <textarea style="border-radius:0px;" class="form-control" placeholder="Remarks" v-model.trim="$v.quotation.remarks.$model" :class="{'is-invalid' :$v.quotation.remarks.$error, 'is-valid' :!$v.quotation.remarks.$invalid}">
                   </textarea>
                    <div class="invalid-feedback">
                    <span v-if="!$v.quotation.remarks.required"><sup>*</sup>Remarks is required</span>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top:2%">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Currency</label>
                        <input type="text" class="form-control" placeholder="Currency" disabled v-model="quotation.currency" style="border-radius:0px">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Incoterm</label>
                        <input type="text" class="form-control" placeholder="Incoterm" style="border-radius:0px" v-model="quotation.incoterm">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Validity</label>
                        <input type="date" class="form-control" placeholder="Validity" style="border-radius:0px" v-model="quotation.validity">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Payment</label>
                        <input type="text" class="form-control" placeholder="Payment" style="border-radius:0px" v-model="quotation.payment">
                    </div>
                </div>
            </div>

            <div class="row" v-for="(t,index) in quotation.quotation_array" :key="index" style="margin-top:4%">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Material No.</label>
                        <Select2  class="year" style="border-radius:0px" :options="material_list" label='Select role' v-model="t.products_id" @change="autoUpdateMaterialDetail(index)" >
                        </Select2>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" placeholder="Description" class="form-control" style="border-radius:0px;" v-model="t.product_description" >
                        <!-- <div class="invalid-feedback">
                    <span v-if="!$v.t.product_description[index].required"><sup>*</sup>Product Description is required</span>
                    </div> -->
                    </div>
                    
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Unit</label>
                       <input type="text" placeholder="Unit" class="form-control" style="border-radius:0px;" v-model="t.unit_price">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="text" placeholder="Quantity" class="form-control"  @keyup="autoUpdateindex(index)" style="border-radius:0px;" v-model="t.quantity">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label>Discount%</label>
                        <input type="text" placeholder="Discount%" class="form-control" style="border-radius:0px;" v-model="t.discount" @keyup="checkDiscount(index),autoUpdateindex(index)">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label>List Price</label>
                        <input type="text" placeholder="List Price"  @keyup="autoUpdateindex(index)" class="form-control" style="border-radius:0px;" v-model="t.discount_price" >
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <p style="font-weight: 700;">Total Net Price</p>
                        <span>{{t.quantity}}</span>
                        <span>*</span>
                        <span>{{t.discount_price}}</span>
                        <span>=</span>
                        <span>{{t.total_price}}</span>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label></label>
                       <p style="margin-top:8%"> 
                       <a class="btn-sm btn-primary" @click="addItem"  style="cursor:pointer;color:white" id="add">+</a>
                       <a class="btn-sm btn-danger" v-if="count>1" @click="removeItem(index)" style="cursor:pointer;color:white" id="add">-</a></p>
                    </div>
                </div>
            </div>
                <div v-if="showExtra" >
                 <div class="row" style="margin-top:2%">
                    <div class="seprate_heading">
                    <span style="padding: 4px 10px; margin:0px 10px; background: #DCDCDC; color: black; font-weight: bold;">For discount exceeding authority</span>
                    </div>
                </div>
                <div class="row" style="margin-top:4%">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Project Detail</label>
                            <input type="text" placeholder="" class="form-control" style="border-radius:0px;" v-model="quotation.project_detail">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:2%">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Project Location</label>
                            <input type="text" placeholder="" class="form-control" style="border-radius:0px;" v-model="quotation.project_location">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Delivery Schedule</label>
                            <input type="date" placeholder="" class="form-control" style="border-radius:0px;" v-model="quotation.delivery_schedule">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Distributor's Margin</label>
                            <input type="text" placeholder="" class="form-control" style="border-radius:0px;" v-model="quotation.distributor_margin">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:2%">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Strategic Reason</label>
                            <textarea  placeholder="" class="form-control" style="border-radius:0px;" v-model="quotation.strategic_reason"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Competition</label>
                            <textarea  placeholder="" class="form-control" style="border-radius:0px;" v-model="quotation.competition"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Chance Improvement</label>
                            <textarea  placeholder="" class="form-control" style="border-radius:0px;" v-model="quotation.chance_improvement"></textarea>
                        </div>
                    </div>
                </div>
                </div>
            <div class="panel-footer" style="margin-left: 4%;margin-top:5%">
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-3">
                         <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label style="position: relative;top: 7px;">Total Amount:</label>
                        <span class="input-group-text" id="basic-addon1" style="background: white;">USD</span>
                    </div>
                   <input type="text" class="form-control" value=quotation.total_cost readonly="" style="border-radius:0px" id="total_amount" v-model="quotation.total_cost">
                </div>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn save" name="action" value="draft" style="background: #41D080" @click="$v.quotation.$touch,chececkAction('draft')" title="quotation save as draft">Save as Draft&nbsp;<i class="fas fa-file-alt"></i></button>
                    </div>&nbsp;
                    <div class="col-md-1" style="margin-left: 4%;">
                     <button type="submit" v-if="load==false" class="btn btn-primary save" name="action" value="save"  @click="$v.quotation.$touch,chececkAction('save')" title="save quotation">Save<vue-loaders-ball-spin-fade-loader color="white" scale="0.3" /></button>
                     <button type="submit" v-else class="btn btn-primary save" name="action" value="save"  @click="$v.quotation.$touch,chececkAction('save')" title="save quotation">Save&nbsp;<i class="fa fa-check"></i></button>
                    </div>
                </div>
              
            </div>


    </div>
</div>
        </form>

</div>
<br></div>
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
            quotation:{
            quotation_for:['Project'],//for quotation
            countries_id:'',
            customers_id:'',
            currency:'SGD',
            refrence_number:'',
            project_name:'',
            remarks:'',
            validity:'',
            incoterm:'',
            payment:'',
            quotation_cost:'',
            status:'',
            reason:'',
            project_detail:'',
            project_location:'',
            strategic_reason:'',
            competition:'',
            chance_improvement:'',
            delivery_schedule:'',
            distributor_margin:'',
            created_by:'',
            assigned_by:'',
            approved_by:'',
            last_updated_by:'',
            quotation_array:[{quotations_id:'', products_id:'',product_description:'',quantity:'0', discount:'0',unit_price:'', discount_price:'0', total_price:'00'}],
            total_cost:''  
            },
            count:'',
            usercustomer_list:[],
            material_list:[],
            material_arr_list:[],
            quotation_for_list:['Project', 'Retail'],
            showExtra:false,
            country_code:'',
            user_id:'',
            user_idd:'',
            qutation_array:[],
            role_discount:'',
            status:'PENDING',
            action:'',
            load:true
            
        }
    },
      validations: {
  quotation:{
            remarks:{
            required,
            },
            
            
  }
  },
    methods:{
        chececkAction(value) {
            console.log(this.action=value);
            
        },

             addItem(){
                this.quotation.quotation_array.push({quotations_id:'', products_id:'',product_description:'',quantity:'0', discount:'0',unit_price:'', discount_price:'0', total_price:'00' });
                this.count = this.quotation.quotation_array.length;
             },

             removeItem(index) {
                this.quotation.quotation_array.splice(index,1);
                this.count = this.quotation.quotation_array.length;
                this.checkDiscount();
             },

             getUser(id) {
                var app = this
                this.$http({
                url: `users/`+localStorage.getItem('id'),
                method: 'GET',
                })
                .then((res) => {
                let app =this;
                app.role_discount = res.data.user.role;
                app.user_id = res.data.user.abbreviation;
                app.user_idd = res.data.user.id;    
                }, () => {
                this.has_error = true
                }); 
              },
              getUserCustomer() {
                    var app = this
                    this.$http({
                    url: `usercustomer/`+localStorage.getItem('id'),
                    method: 'GET',
                    })
                    .then((res) => {
                        console.log(res);
                        
                    let country_arr= res.data.user;
                    app.usercustomer_country = res.data.user;
                    $.each(country_arr,function(index, value){
                    app.usercustomer_list.push({'id':value.id,'text':value.name})

                    }) 

                    let material_arr= res.data.product;
                    app.material_arr_list = res.data.product;
                    $.each(material_arr,function(index, value){
                    app.material_list.push({'id':value.id,'text':value.material_number})
                    }) 


                    }, () => {
                    this.has_error = true
                    }); 
               },

               autoUpdateCountryCurrency() {
                    let app =this;
                    $.each(app.usercustomer_country,function(index, value) {
                    if(app.quotation.customers_id==value.id){
                    app.quotation.countries_id = value.country.name;
                    app.country_code = value.country.country_code;
                    //console.log(app.country_code);

                    app.quotation.currency = value.currency;
                    }
                    });

                    $.each(app.quotation.quotation_array,function(index, value) {
                        app.autoUpdateMaterialDetail(index) 
                    });
               },
               autoUpdateindex(i) {
                    let app =this;
                    let dis;
                    app.dis = ((app.quotation.quotation_array[i].quantity*app.quotation.quotation_array[i].discount)/100)* (app.quotation.quotation_array[i].discount_price)
                    app.quotation.quotation_array[i].total_price=   app.quotation.quotation_array[i].discount_price-app.dis;
                    app.totalPriceCalculation();
               }, 
               totalPriceCalculation() {
                    let app=this;
                    let total_price_vari=0;
                    $.each(app.quotation.quotation_array,function(index, value){
                        total_price_vari = parseInt(total_price_vari) + parseInt(value.total_price);
                    });
                    app.quotation.total_cost=total_price_vari;
                },
                autoUpdateMaterialDetail(i) {
                    let app =this;
                    $.each(app.material_arr_list,function(index, value) {  

                    if(app.quotation.quotation_array[i].products_id==value.id)  {

                    app.quotation.quotation_array[i].product_description = value.description;
                    app.quotation.quotation_array[i].quantity = value.quantity_pu_1;
                    app.quotation.quotation_array[i].unit_price = value.base_unit;
                    if(app.quotation.currency=='USD') {
                    app.quotation.quotation_array[i].discount_price = value.list_price_usd;
                    }
                    else {
                    app.quotation.quotation_array[i].discount_price = value.list_price_sgd;
                    }
                    let dis;
                    app.dis = ((app.quotation.quotation_array[i].quantity*app.quotation.quotation_array[i].discount)/100)* (app.quotation.quotation_array[i].discount_price)
                    app.quotation.quotation_array[i].total_price=   app.quotation.quotation_array[i].discount_price-app.dis;

                    app.totalPriceCalculation();
                    }
                    app.quotation.quotation_array[i].discount;
                    });
          
                },
                checkDiscount() {
                    let app= this;
                    app.showExtra = false;
                    $.each(app.quotation.quotation_array,function(index, value) {
                    if(value.discount >=60) {
                    app.showExtra = true;
                    }
                    });
                },

                addQuotation() {
                    if (this.$v.$invalid) { 
                    this.$toasted.error('Please check all fields correctly'); 

                    }
                    else {  
                    let app =this;
                    app.load = false;
                    let formData = new FormData();
                    formData.append('quotation_for',app.quotation.quotation_for),
                    formData.append('customers_id',app.quotation.customers_id),
                    formData.append('currency',app.quotation.currency),
                    formData.append('status',app.status);
                    formData.append('action',app.action)
                    //request for refrence number
                    formData.append('user_id',app.user_id),
                    formData.append('user_idd',app.user_idd),
                    formData.append('country_code',app.country_code),

                    formData.append('project_name',app.quotation.project_name),
                    formData.append('remarks',app.quotation.remarks),
                    formData.append('validity',app.quotation.validity),
                    formData.append('incoterm',app.quotation.incoterm),
                    formData.append('payment',app.quotation.payment),
                    formData.append('quotation_cost',app.quotation.total_cost),
                    formData.append('reason',app.quotation.remarks),
                    formData.append('quotation_array',JSON.stringify(app.quotation.quotation_array)),
                    //console.log(app.quotation.quotation_array);

                    formData.append('project_detail',app.quotation.project_detail),
                    formData.append('project_location',app.quotation.project_location),
                    formData.append('strategic_reason',app.quotation.strategic_reason),
                    formData.append('competition',app.quotation.competition),
                    formData.append('chance_improvement',app.quotation.chance_improvement),
                    formData.append('delivery_schedule',app.quotation.delivery_schedule),
                    formData.append('distributor_margin',app.quotation.distributor_margin),
                    
                    this.$http.post ( 'addquotation', formData ).then(function (res) {
                    if (res.data.status=="success"){
                    app.load = true;
                    app.$toasted.success('quotation added successfully');
                    if (res.data.status=="success"){
                    app.$toasted.success('quotation updated successfully'); 
                    if(app.quotation.quotation_for == 'Project') {
                        app.$router.push({name:'projectquotation'}); 
                    }
                    else if(app.quotation.quotation_for == 'Retail') {
                        app.$router.push({name:'retailquotation'}); 
                    }
                    else {
                        app.$router.push({name:'draftquotation'});
                    }
                    }
                    else {
                    app.$toasted.error('somthing went wrong');
                    }
                    
                    }
                    else {
                    app.$toasted.error('somthing went wrong');
                    app.load = true;
                    } 
                    }); 
                    }

                    },

                    

                },
                created() {
                    this.getUserCustomer();
                    this.getUser();
                }

}
</script>
<style scoped>
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
.save {
  color: #fbecec;
}
.seprate_heading {
    position: relative;
    width:100%;

}
.seprate_heading::after {
    content:'';
    position: absolute;
    left: 10px;
    top:10px;
    width: 100%;
    height: 3px;
    background-color:#ebebeb; 
}

.seprate_heading span {
    position: relative;
    z-index: 9;
}
/deep/.vue-loaders.ball-spin-fade-loader {
    top: auto;
    left: auto;
    border: 5px solid transparent;
    width: 26px;
    height: 3px;
}
</style>