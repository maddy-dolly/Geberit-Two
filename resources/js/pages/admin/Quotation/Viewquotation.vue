
<template>
<div>
<navbar></navbar>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid" >
<div class="row">
<div class="col-md-4">
    <h2><img src="/icons/product.svg" style="height: 39px; width: 57px;">Quotation Details:{{quotation['refrence_number']}}  </h2>
</div>
    <div class="ml-auto" style="margin-right:8px;">
        <router-link :to="{name:'draftquotation'}" class="btn btn-warning" style="color:white"><i class="fa fa-arrow-left"></i>&nbsp;Return to list</router-link>
        &nbsp;&nbsp;<router-link :to="{name:'editquotation'}" class="btn btn-primary" title="Edit quotation"><i class="fa fa-edit"></i>&nbsp;Edit</router-link>
    </div>
</div><br> 
<div v-for="quo in quotation" :key="quo.id">     
 <div class="card">
  <div class="card-body">
      
     <div class="row">
         <div class="seprate_heading">
        <span style="padding: 4px 10px; margin:0px 10px; background: #DCDCDC; color: black; font-weight: bold;">{{quo['refrence_number']}} 
            <span v-if="quo.revision==0"></span>
            <span v-else> R-{{quo['revision']}}</span>
        </span>
         </div>
     </div>
    <div class="row">     
        <div class="col-md-4">
           <div class="form-group">
                 <div class="form-group">
                    <label for="name" class="lab">Customer Name</label><br>
                   <span v-if="quo.customer" style="color: #6f6565;font-weight: bold;">{{quo.customer.name}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="password_confirmation" class="lab">Country</label><br>
                <span v-if="country" style="color: #6f6565;font-weight: bold;">{{country}}</span>
                <span v-else style="color: #6f6565;font-weight: bold;">-</span>
                
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="password_confirmation" class="lab">Project Name</label><br>
                <span v-if="quo.project_name" style="color: #6f6565;font-weight: bold;">{{quo.project_name}}</span>
                <span v-else style="color: #6f6565;font-weight: bold;">-</span>  
          </div>
        </div>
    </div>
<br>

<div class="row">     
         <div class="col-md-4">
          <div class="form-group">
            <label for="password_confirmation" class="lab">Product Type</label><br>
                <span v-if="quo.quotation_for" style="color: #6f6565;font-weight: bold;">{{quo.quotation_for}}</span>
                <span v-else style="color: #6f6565;font-weight: bold;">-</span>  
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="password_confirmation" class="lab">Currency</label><br>
                <span v-if="quo.currency" style="color: #6f6565;font-weight: bold;">{{quo.currency}}</span>
                <span v-else style="color: #6f6565;font-weight: bold;">-</span>
                
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="password_confirmation" class="lab">Remarks</label><br>
                <span v-if="quo.remarks" style="color: #6f6565;font-weight: bold;">{{quo.remarks}}</span>
                <span v-else style="color: #6f6565;font-weight: bold;">-</span>  
          </div>
        </div>
    </div>

   <br>

<div class="row">     
        <div class="col-md-4">
           <div class="form-group">
                 <div class="form-group">
                    <label for="name" class="lab">Incoterm</label><br>
                   <span v-if="quo.incoterm" style="color: #6f6565;font-weight: bold;">{{quo.incoterm}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="password_confirmation" class="lab">Validity</label><br>
                <span v-if="quo.validity" style="color: #6f6565;font-weight: bold;">{{quo.validity}}</span>
                <span v-else style="color: #6f6565;font-weight: bold;">-</span>
                
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="password_confirmation" class="lab">Payment</label><br>
                <span v-if="quo.payment" style="color: #6f6565;font-weight: bold;">{{quo.payment}}</span>
                <span v-else style="color: #6f6565;font-weight: bold;">-</span>  
          </div>
        </div>
    </div>
      
    <br>

    
<div class="row" v-for="(pre,index) in quo.productquotation" :key="index">
        <div class="col-md-3">
            <div class="form-group">
                <label class="lab">Material Number</label><br>
                   <span v-if="pre.product.material_number" style="color: #6f6565;font-weight: bold;">{{pre.product.material_number}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="lab">Description</label><br>
                   <span v-if="pre.product_description" style="color: #6f6565;font-weight: bold;">{{pre.product_description}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="lab">List Price</label><br>
                   <span v-if="pre.unit_price" style="color: #6f6565;font-weight: bold;">{{pre.unit_price}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="lab">Discount </label><br>
                   <span v-if="pre.discount" style="color: #6f6565;font-weight: bold;">{{pre.discount}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="lab">Net Price</label><br>
                   <span v-if="pre.total_cost" style="color: #6f6565;font-weight: bold;">{{pre.total_cost}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="lab">Quantity </label><br>
                   <span v-if="pre.quantity" style="color: #6f6565;font-weight: bold;">{{pre.quantity}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="lab">Unit</label><br>
                   <span v-if="pre.product.base_unit" style="color: #6f6565;font-weight: bold;">{{pre.product.base_unit}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
         <div class="col-md-3">
            <div class="form-group">
                <label class="lab">Total Amount</label><br>
                   <span v-if="pre.total_cost" style="color: #6f6565;font-weight: bold;">{{pre.total_cost}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        
    </div>
    <br>
    
   
</div>
       </div>
     
</div>
</div>
</div>
</div>
<footerr></footerr> 
</div>
</template>

<script>
export default {
    data() {
        return {
         quotation:[],   
         product:[],
         country:[],
         base_unit:"",
         product_quotation:[],
         customer:''
        }
    },
    

    methods:{
            getUserCustomer() {
            var app = this
            this.$http({
            url: `usercustomer/`+localStorage.getItem('id'),
            method: 'GET',
            })
            .then((res) => {
            app.country = res.data.user[0].country.name;
            }, () => {
            this.has_error = true
            }); 
            },


            getRecord() {
            var app=this;
            this.$http({
            url: `quotationsingle/`+this.$route.params.id+'/'+btoa(this.$route.params.ref_no),
            method: 'GET',
            })
            .then((res) => {
            app.quotation= res.data.quotation;
            
            }, () => {
            this.has_error = true
            }); 
            } ,



    },
    created() {
            this.getRecord();
            this.getUserCustomer();
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
    margin-bottom: 20px;
    margin-left: 77%;
   
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
h2 {
     color: #76838f;
    font-size: 20px;
    font-weight: bold;
}
</style>