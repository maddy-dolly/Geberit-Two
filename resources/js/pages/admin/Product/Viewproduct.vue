
<template>
<div>
<navbar></navbar>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid" >
<div class="row">
<div class="col-md-4">
    <h2><img src="/icons/product.svg" style="height: 39px; width: 57px;">Product Details:{{product['material_number']}}  </h2>
</div>
    <div class="ml-auto" style="margin-right:8px;">
        <router-link :to="{name:'productlist'}" class="btn btn-warning" style="color:white"><i class="fa fa-arrow-left"></i>&nbsp;Return to list</router-link>
        &nbsp;&nbsp;<router-link :to="{name:'editproduct'}" v-if="$auth.check(1) || $auth.check(2)" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Edit</router-link>
    </div>
</div><br>      
 <div class="card">
  <div class="card-body">
     <div class="row">
         <div class="seprate_heading">
        <span style="padding: 4px 10px; margin:0px 10px; background: #DCDCDC; color: black; font-weight: bold;">Material</span>
         </div>
     </div>
    <div class="row">     
        <div class="col-md-3">
           <div class="form-group">
                 <div class="form-group">
                    <label for="name" class="lab">Material Number</label><br>
                   <span v-if="product.material_number" style="color: #6f6565;font-weight: bold;">{{product.material_number}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="password_confirmation" class="lab">Product Type</label><br>
                <span v-if="producttype" style="color: #6f6565;font-weight: bold;">{{producttype}}</span>
                <span v-else style="color: #6f6565;font-weight: bold;">-</span>
                
          </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="lab">Description</label><br>
                <span v-if="product.description" style="color: #6f6565;font-weight: bold;">{{product.description}}</span>
                <span v-else style="color: #6f6565;font-weight: bold;">-</span>
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
                <label class="lab">List Price(USD)</label><br>
                   <span v-if="product.list_price_usd" style="color: #6f6565;font-weight: bold;">{{product.list_price_usd}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
             <div class="form-group">
                <label class="lab">List Price(SGD)</label><br>
                   <span v-if="product.list_price_sgd" style="color: #6f6565;font-weight: bold;">{{product.list_price_sgd}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
             <div class="form-group">
                <label class="lab">Product Line</label><br>
                   <span v-if="product.product_line" style="color: #6f6565;font-weight: bold;">{{product.product_line}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="password_confirmation" class="lab">Country Origin</label><br>
                   <span v-if="country" style="color: #6f6565;font-weight: bold;">{{country}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
          </div>
        </div>
        <div class="col-md-2">
             <div class="form-group">
                <label class="lab">Origin Company</label><br>
                   <span v-if="product.origin_company" style="color: #6f6565;font-weight: bold;">{{product.origin_company}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
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
            <label for="password_confirmation" class="lab">Material Status</label><br>
                   <span v-if="product.material_status" style="color: #6f6565;font-weight: bold;">{{product.material_status}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
          </div>
        </div>
        <div class="col-md-2">
             <div class="form-group">
                <label class="lab">St51 Since</label><br>
                   <span v-if="product.st51_since" style="color: #6f6565;font-weight: bold;">{{product.st51_since}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
             <div class="form-group">
                <label class="lab">St52 Since</label><br>
                   <span v-if="product.st52_since" style="color: #6f6565;font-weight: bold;">{{product.st52_since}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
             <div class="form-group">
                <label class="lab">Sales Replaced By</label><br>
                   <span v-if="product.sales_replaced_by" style="color: #6f6565;font-weight: bold;">{{product.sales_replaced_by}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
             <div class="form-group">
                <label class="lab">No Sales In</label><br>
                   <span v-if="product.no_sales_in" style="color: #6f6565;font-weight: bold;">{{product.no_sales_in}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
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
                <label class="lab">Quantity PU1</label><br>
                   <span v-if="product.quantity_pu_1" style="color: #6f6565;font-weight: bold;">{{product.quantity_pu_1}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="lab">Quantity PU2</label><br>
                   <span v-if="product.quantity_pu_2" style="color: #6f6565;font-weight: bold;">{{product.quantity_pu_2}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="lab">Quantity PU3</label><br>
                   <span v-if="product.quantity_pu_3" style="color: #6f6565;font-weight: bold;">{{product.quantity_pu_3}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="lab">Quantity PU4</label><br>
                   <span v-if="product.quantity_pu_4" style="color: #6f6565;font-weight: bold;">{{product.quantity_pu_4}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="lab">Net Weight</label><br>
                   <span v-if="product.net_weight" style="color: #6f6565;font-weight: bold;">{{product.net_weight}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="lab">Gross Weight</label><br>
                   <span v-if="product.gross_weight" style="color: #6f6565;font-weight: bold;">{{product.gross_weight}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
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
                <label>Volume PU1</label><br>
                   <span v-if="product.volume_pu_1" style="color: #6f6565;font-weight: bold;">{{product.volume_pu_1}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Volume PU2</label><br>
                   <span v-if="product.volume_pu_2" style="color: #6f6565;font-weight: bold;">{{product.volume_pu_2}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Volume PU3</label> <br>
                   <span v-if="product.volume_pu_3" style="color: #6f6565;font-weight: bold;">{{product.volume_pu_3}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Volume PU4</label><br>
                   <span v-if="product.volume_pu_4" style="color: #6f6565;font-weight: bold;">{{product.volume_pu_4}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Unit Volume</label><br>
                   <span v-if="product.unit_volume" style="color: #6f6565;font-weight: bold;">{{product.unit_volume}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
    </div>
    <div class="row" style="margin: 12px 0px;">
         <div class="seprate_heading">
         </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="lab">Base Unit of Measurement</label><br>
                   <span v-if="product.base_unit" style="color: #6f6565;font-weight: bold;">{{product.base_unit}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
            </div>
        </div>
         <div class="col-md-3">
            <div class="form-group">
                <label class="lab">Weight Unit</label><br>
                   <span v-if="product.weight_unit" style="color: #6f6565;font-weight: bold;">{{product.weight_unit}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
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
                <label>Step Relevant</label><br>
                   <span v-if="product.step_relevant" style="color: #6f6565;font-weight: bold;">{{product.step_relevant}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
                
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Product Hierarchy</label><br>
                   <span v-if="product.product_hierarchy" style="color: #6f6565;font-weight: bold;">{{product.product_hierarchy}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
                
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>PM</label><br>
                   <span v-if="product.pm" style="color: #6f6565;font-weight: bold;">{{product.pm}}</span>
                   <span v-else style="color: #6f6565;font-weight: bold;">-</span>
                
            </div>
        </div>
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
         product:[],   
         country_list:[],
         country:[],
         product_type:[],
         producttype:'',
         material:['50','51','52']
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

      getRecord() {
        var app=this;
       this.$http({
                url: `showproduct/`+this.$route.params.id,
                method: 'GET',
                })
                .then((res) => {
                app.product= res.data.product;
                this.country =res.data.product.country.name;
                this.producttype =res.data.product.producttype.name;
                //console.log(res);
                
                
                
                }, () => {
                this.has_error = true
                }); 
     } ,


      
    },
    created() {
        this.getProductType();
        this.getCountry();
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