
<template>
<div>
<navbar></navbar>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid" >
<div class="row">               
<div class="col-md-4">
<h2><img src="/icons/order.svg" style="height: 39px; width: 57px;">Add Product</h2>
</div>
</div>
<br>
<div class="card">
    <div class="card-body">
<form @submit.prevent="addProduct">
     <div class="row" style="margin: 12px 0px;">
         <div class="seprate_heading">
        <span style="padding: 4px 10px; margin:0px 10px; background: #DCDCDC; color: black; font-weight: bold;">Material</span>
         </div>
     </div>
    <div class="row">     
        <div class="col-md-3">
           <div class="form-group">
                 <div class="form-group">
                    <label for="name" class="lab">Material Number</label>
                    <input  type="text" id="material_number" class="form-control" v-model.trim="$v.product.material_number.$model" :class="{'is-invalid' :$v.product.material_number.$error, 'is-valid' :!$v.product.material_number.$invalid}" style="border-radius:0px" placeholder="Enter material no">
                    <div class="invalid-feedback">
                    <span v-if="!$v.product.material_number.required"><sup>*</sup>Material_Number is required</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="password_confirmation" class="lab">Product Type</label>
                <select  id="product_types_id" class="form-control year" v-model.trim="$v.product.product_types_id.$model" :class="{'is-invalid' :$v.product.product_types_id.$error, 'is-valid' :!$v.product.product_types_id.$invalid}" style="border-radius:0px">
                 <option value="" disabled >Please select product</option> 
                <option v-for="ab in product_type" :key="ab.product_type" :value=ab.id>{{ab.name}}</option>
                </select>
                <div class="invalid-feedback">
                <span v-if="!$v.product.product_types_id.required"><sup>*</sup>Product_type is required</span>
                </div>
          </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="lab">Description</label> 
            <textarea class="form-control" v-model="product.description" style="border-radius:0px" placeholder="Enter description"></textarea>
        </div>
    </div>
    </div>

    <div class="row" style="margin: 12px 0px;">
         <div class="seprate_heading">
        <span style="padding: 4px 10px; margin:0px 10px; background: #DCDCDC; color: black; font-weight: bold;">Pricing</span>
         </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label class="lab">List Price(USD)</label>
                <input type="text" placeholder="Enter list price(USD)" style="border-radius:0px;" v-model="product.list_price_usd" class="form-control">
            </div>
        </div>
        <div class="col-md-2">
             <div class="form-group">
                <label class="lab">List Price(SGD)</label>
                <input type="text" placeholder="Enter list price(SGD)" style="border-radius:0px;" v-model="product.list_price_sgd" class="form-control">
            </div>
        </div>
        <div class="col-md-2">
             <div class="form-group">
                <label class="lab">Product Line</label>
                <input type="text" placeholder="Enter product line" style="border-radius:0px;" v-model="product.product_line" class="form-control">
            </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="password_confirmation" class="lab">Country Origin</label>
            <select  id="product_types_id" class="form-control year" v-model="product.countries_id"  style="border-radius:0px">
             <option value="" disabled >Please select country</option> 
            <option v-for="ab in country_list" :key="ab.country_list" :value=ab.id>{{ab.name}}</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
             <div class="form-group">
                <label class="lab">Origin Company</label>
                <input type="text" placeholder="Enter company" style="border-radius:0px;" v-model="product.origin_company" class="form-control">
            </div>
        </div>
    </div>

    <div class="row" style="margin: 12px 0px;">
         <div class="seprate_heading">
      <span style="padding: 4px 10px; margin:0px 10px; background: #DCDCDC; color: black; font-weight: bold;">Product Status</span>
         </div>
    </div>

     <div class="row">
         <div class="col-md-2">
       <div class="form-group">
            <label for="password_confirmation" class="lab">Material Status</label>
                <select  id="material_status" class="form-control year" v-model.trim="$v.product.material_status.$model" :class="{'is-invalid' :$v.product.material_status.$error, 'is-valid' :!$v.product.material_status.$invalid}" style="border-radius:0px">
                <option value="" disabled >Please select material status</option> 
                <option v-for="ab in material" :key="ab.material" :value="ab">{{ab}}</option>
                </select>
                <div class="invalid-feedback">
                <span v-if="!$v.product.material_status.required"><sup>*</sup>Material_status is required</span>
                </div>
          </div>
        </div>
        <div class="col-md-2">
             <div class="form-group">
                <label class="lab">St51 Since</label>
                <input type="date" placeholder="Enter st51 since" style="border-radius:0px;" v-model="product.st51_since" class="form-control">
            </div>
        </div>
        <div class="col-md-2">
             <div class="form-group">
                <label class="lab">St52 Since</label>
                <input type="date" placeholder="Enter st52 since" style="border-radius:0px;" v-model="product.st52_since" class="form-control">
            </div>
        </div>
        <div class="col-md-2">
             <div class="form-group">
                <label class="lab">Sales Replaced By</label>
                <input type="text" placeholder="Enter sales replace" style="border-radius:0px;" v-model="product.sales_replaced_by" class="form-control">
            </div>
        </div>
        <div class="col-md-2">
             <div class="form-group">
                <label class="lab">No Sales In</label>
                <input type="text" placeholder="Enter no sales in" style="border-radius:0px;" v-model="product.no_sales_in" class="form-control">
            </div>
        </div>
    </div>

    <div class="row" style="margin: 12px 0px;">
         <div class="seprate_heading">
        <span style="padding: 4px 10px; margin:0px 10px; background: #DCDCDC; color: black; font-weight: bold;">MOQ by Quantity</span>
         </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label class="lab">Quantity PU1</label>
                <input type="text" class="form-control" style="border-radius:0px;" v-model="product.quantity_pu_1" placeholder="Enter Quantity PU1">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="lab">Quantity PU2</label>
                <input type="text" class="form-control" style="border-radius:0px;" v-model="product.quantity_pu_2" placeholder="Enter Quantity PU2">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="lab">Quantity PU3</label>
                <input type="text" class="form-control" style="border-radius:0px;" v-model="product.quantity_pu_3" placeholder="Enter Quantity PU3">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="lab">Quantity PU4</label>
                <input type="text" class="form-control" style="border-radius:0px;" v-model="product.quantity_pu_4" placeholder="Enter Quantity PU4">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="lab">Net Weight</label>
                <input type="text" class="form-control" style="border-radius:0px;" v-model="product.net_weight" placeholder="Enter net weight">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="lab">Gross Weight</label>
                <input type="text" class="form-control" style="border-radius:0px;" v-model="product.gross_weight" placeholder="Enter gross weight">
            </div>
        </div>
    </div>
    <div class="row" style="margin: 12px 0px;">
         <div class="seprate_heading">
        <span style="padding: 4px 10px; margin:0px 10px; background: #DCDCDC; color: black; font-weight: bold;">MOQ by Volume</span>
         </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label>Volume PU1</label>
                <input type="text" placeholder="Enter volume PU1" class="form-control" style="border-radius:0px;" v-model="product.volume_pu_1">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Volume PU2</label>
                <input type="text" placeholder="Enter volume PU2" class="form-control" style="border-radius:0px;" v-model="product.volume_pu_2">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Volume PU3</label>
                <input type="text" placeholder="Enter volume PU3" class="form-control" style="border-radius:0px;" v-model="product.volume_pu_3">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Volume PU4</label>
                <input type="text" placeholder="Enter volume PU4" class="form-control" style="border-radius:0px;" v-model="product.volume_pu_4">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Unit Volume</label>
                <input type="text" placeholder="Enter unit volume" class="form-control" style="border-radius:0px;" v-model="product.unit_volume">
            </div>
        </div>
    </div>
    <div class="row" style="margin: 12px 0px;">
         <div class="seprate_heading">
           <span style="padding: 4px 10px; margin:0px 10px; background: #DCDCDC; color: black; font-weight: bold;">Unit</span>
         </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="lab">Base Unit of Measurement</label>
                <input type="text" placeholder="Enter base unit of measurment" class="form-control" v-model="product.base_unit" style="border-radius:0px;">
            </div>
        </div>
         <div class="col-md-3">
            <div class="form-group">
                <label class="lab">Weight Unit</label>
                <input type="text" placeholder="Enter weight unit" class="form-control" v-model="product.weight_unit" style="border-radius:0px;">
            </div>
        </div>
    </div>
    <div class="row" style="margin: 12px 0px;">
         <div class="seprate_heading">
          <span style="padding: 4px 10px; margin:0px 10px; background: #DCDCDC; color: black; font-weight: bold;">Other</span>
         </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label>Step Relevant</label>
                <input type="text" class="form-control" placeholder="Enter step relevant" style="border-radius:0px;" v-model="product.step_relevant">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Product Hierarchy</label>
                <input type="text" class="form-control" placeholder="Enter product hierarchy" style="border-radius:0px;" v-model="product.product_hierarchy">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>PM</label>
                <input type="text" class="form-control" placeholder="Enter pm" style="border-radius:0px;" v-model="product.pm">
            </div>
        </div>
    </div>
 <button class="btn btn-primary save" @click="$v.product.$touch" title="save product">Save&nbsp;<i class="fa fa-check"></i></button>
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
        return {
             product:{
            material_number:"",
            product_types_id:"",
            description:"",
            list_price_usd:"",
            list_price_sgd:"",
            product_line:"",
            countries_id:"",
            origin_company:"",
            material_status:"",
            st51_since:"",
            st52_since:"",
            sales_replaced_by:"",
            no_sales_in:"",
            quantity_pu_1:"",
            quantity_pu_2:"",
            quantity_pu_3:"",
            quantity_pu_4:"",
            net_weight:"",
            gross_weight:"",
            volume_pu_1:"",
            volume_pu_2:"",
            volume_pu_3:"",
            volume_pu_4:"",
            unit_volume:"",
            base_unit:"",
            weight_unit:"",
            step_relevant:"",
            product_hierarchy:"",
            pm:""

            
         },
         country_list:[],
         product_type:[],
         material:['50','51','52']
        }
    },
    validations: {
  product:{
            material_number:{
            required,
            },
            product_types_id:{
                required
            },
            material_status:{
                required
            },
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


      getProductType() {
          var app = this
                this.$http({
                url: `producttypelist`,
                method: 'GET',
                })
                .then((res) => {
                this.product_type= res.data.product_type
                }, () => {
                this.has_error = true
                }); 
      },


      addProduct() {
          if (this.$v.$invalid) { 
          this.$toasted.error('Please check all fields correctly'); 

          }
          else {      
          let app =this;
          let formData = new FormData();
          formData.append('material_number',app.product. material_number),
          formData.append('product_types_id',app.product.product_types_id),
          formData.append('description',app.product.description),
          formData.append('list_price_usd',app.product.list_price_usd),
          formData.append('list_price_sgd',app.product.list_price_sgd),
          formData.append('product_line',app.product.product_line),
          formData.append('countries_id',app.product.countries_id),
          formData.append('origin_company',app.product.origin_company),
          formData.append('material_status',app.product.material_status),
          formData.append('st51_since',app.product.st51_since),
          formData.append('st52_since',app.product.st52_since),
          formData.append('sales_replaced_by',app.product. sales_replaced_by),
          formData.append('no_sales_in',app.product.no_sales_in),
          formData.append('quantity_pu_1',app.product.quantity_pu_1),
          formData.append('quantity_pu_2',app.product.quantity_pu_2),
          formData.append('quantity_pu_3',app.product.quantity_pu_3),
          formData.append('quantity_pu_4',app.product.quantity_pu_4),
          formData.append('net_weight',app.product.net_weight),
          formData.append('gross_weight',app.product.gross_weight),
          formData.append('volume_pu_1',app.product.volume_pu_1),
          formData.append('volume_pu_2',app.product.volume_pu_2),
          formData.append('volume_pu_3',app.product.volume_pu_3),
          formData.append('volume_pu_4',app.product.volume_pu_4),
          formData.append('unit_volume',app.product.unit_volume),
          formData.append('base_unit',app.product.base_unit),
          formData.append('weight_unit',app.product.weight_unit),
          formData.append('step_relevant',app.product.step_relevant),
          formData.append('product_hierarchy',app.product.product_hierarchy),
          formData.append('pm',app.product.pm),
          

           this.$http.post ( 'addproduct', formData ).then(function (res) {
                    if (res.data.status=="success"){
                        app.$toasted.success('Product added successfully'); 
                        app.$router.push({name:'productlist'});
                    }
                     else {
                        app.$toasted.success('somthing went wrong');
                        
                    } 
 
                      }); 
          }
       
      }
    },
    created() {
        this.getProductType();
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
    margin-bottom: -32px;
    margin-top:-35px;
    float: right;
    margin-right: 30px;
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
</style>