<template>
<div>
  <navbar></navbar>
  
          <div class="content-wrapper">
          <div class="content-header">

          <div class="container-fluid">
          <div class="row">     
          <div class="col-md-8">
          <h2><img src="/icons/draft.svg" style="height: 39px; width: 57px;">Reports- Retail Quotation PL Info</h2>
          </div>
          <div class="ml-auto" style="display:inherit">
          <a  :href="'/api/retailplexcel/'+id+'/'+role_id+'/'+excelExportdata.user+'/'+excelExportdata.currency+'/'+excelExportdata.from_date+'/'+excelExportdata.to_date" download="retail-report.xlsx" class="nav-link btn btn-primary" style="margin-right: 6px;color:white;height: 40px;
          width: 135px;"><i class="fas fa-file-excel"></i>&nbsp;Export Excel</a>
          </div>
          </div>
          <br>
          <form  @submit.prevent="getQuotation(1)">
           <div class="card">
                <div style="margin:20px">
                    <div class="row">
                         <div class="col-md-3">
                    <div class="form-group">
                        <label for="">User</label>
                          <Select2  class="year1" style="border-radius:0px" :options="userreport_list"  label='Select list' v-model="filter_arr.user_name">
                         </Select2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Currency</label>
                          <Select2  class="year1" style="border-radius:0px" :options="currency_list" label='Select list' v-model="filter_arr.currency">
                         </Select2>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">From Date</label>
                         <input type="date" class="form-control" style="border-radius:0px" v-model="filter_arr.from_date">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">To Date</label>
                         <input type="date" class="form-control" style="border-radius:0px" v-model="filter_arr.to_date">
                    </div>
                </div>
               <div class="col-md-2">
                <button class="btn btn-primary" style="margin: 17%;">Generate</button>
               </div>
                    </div>
            </div>
                </div>
          </form><br>
          <div class="card">
          <div class="card-body" style="    overflow-x: scroll;
    margin-right: 2%;"> 
          <div class="row">
          <div class="col-md-6 form-group" style="margin-left: 8px; display:inline">
          <div class="row">
          <div class="col-md-2">Show</div>
          <div class="col-md-2" style="margin-left: -51px;">
          <select name="price" v-model="itemPerPage" class='form-control' @change="changePageCount" style="width: 90px; height: 30px;">
          <option value=10>10</option>
          <option value=25>25</option>
          <option value=50>50</option>
          <option value=100>100</option>
          <option>All</option>
          </select> 
          </div>
          <div class="col-md-2">entries</div>
          </div>
          </div>
          <div class="ml-auto" >
          <form id="search" class="form-inline">
          <label class="form-group" style="font-weight:normal">Search: &nbsp;</label>
          <input name="query" v-model="searchQuery" class="form-control" style="width: 166px;height: 32px;border-radius:0px;margin-right:7px">
          </form>
          </div>
          </div>
          <data-table class="table" :data="indexedItems"  :child-hideable="true" :child-init-hide="true" :columns-to-display="gridColumns" :columnsToSort="sort" :display-names="displayNames" 
          :filter-key="searchQuery" :itemsPerPage=itemPerPage>
          <template slot="customers_id" slot-scope="props">
          <p v-if="props.entry.customer">{{props.entry.customer.name}}</p>
          <p v-else>-</p>
          </template>
          <template slot="revision" slot-scope="props">
          <p v-if="props.entry.revision">{{props.entry.revision}}</p>
          <p v-else>-</p>
          </template>
          <template slot="quotation_cost" slot-scope="props">
          <p v-if="props.entry.quotation_cost">{{props.entry.quotation_cost}}</p>
          <p v-else>-</p>
          </template>
          <template slot="created_by" slot-scope="props">
          <p v-if="props.entry.user">{{props.entry.user.name}} ({{props.entry.user.role.display_name}})</p>
          <p v-else>-</p>
          </template>
          <template slot="country" slot-scope="props">
          <p v-if="props.entry.customer.country">{{props.entry.customer.country.name}}</p>
          <p v-else>-</p>
          </template>
          <template slot="validity" slot-scope="props">
          <p v-if="props.entry.validity">{{props.entry.validity}}</p>
          <p v-else>-</p>
          </template>


          <!-- product line -->
          <template slot="PL 11" slot-scope="props">
            <p v-if="props.entry.pl11">{{props.entry.pl11}}</p>
            <p v-else>-</p>          
          </template>
          <template slot="PL 12_OEM" slot-scope="props">
            <p v-if="props.entry.pl12_oem">{{props.entry.pl12_oem}}</p>
            <p v-else>-</p>
          </template>
          <template slot="PL 12" slot-scope="props">
            <p v-if="props.entry.pl12">{{props.entry.pl12}}</p>
            <p v-else>-</p>
          </template>
          <template slot="PL 21" slot-scope="props">
            <p v-if="props.entry.pl21">{{props.entry.pl21}}</p>
            <p v-else>-</p>
          </template>
          <template slot="PL 22" slot-scope="props">
            <p v-if="props.entry.pl22">{{props.entry.pl22}}</p>
            <p v-else>-</p>
          </template>
          <template slot="PL 31" slot-scope="props">
            <p v-if="props.entry.pl31">{{props.entry.pl31}}</p>
            <p v-else>-</p>
          </template>
          <template slot="PL 32" slot-scope="props">
            <p v-if="props.entry.pl32">{{props.entry.pl32}}</p>
            <p v-else>-</p>
          </template>
          <template slot="PL 33" slot-scope="props">
            <p v-if="props.entry.pl33">{{props.entry.pl33}}</p>
            <p v-else>-</p>
          </template>
          <template slot="PL 34" slot-scope="props">
            <p v-if="props.entry.pl34">{{props.entry.pl34}}</p>
            <p v-else>-</p>
          </template>
          <template slot="PL 35" slot-scope="props">
            <p v-if="props.entry.pl1">{{props.entry.pl1}}</p>
            <p v-else>-</p>
          </template>
          <template slot="PL 21_TOOL" slot-scope="props">
            <p v-if="props.entry.pl21_tool">{{props.entry.pl21_tool}}</p>
            <p v-else>-</p>
          </template>
          <template slot="PL 22_TOOL" slot-scope="props">
            <p v-if="props.entry.pl22_tool">{{props.entry.pl11}}</p>
            <p v-else>-</p>
          </template>
          <!-- end product line -->
          <template slot="action" slot-scope="props">
              <div class="action-panel">
          <button class="btn btn-secondary btn-circle" data-toggle="modal" data-target="#myModal1" title="quotation info" @click="getRecord(props.entry.id,props.entry.refrence_number)"><i class="fas fa-info"></i></button>
           <div class="modal" id="myModal1">
          <div class="modal-dialog">
          <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <div class="">
              <h2>Material Details</h2>
            </div>
            <div class="ml-auto">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
           <table class="table">
    <thead>
      <tr>
        <th>Material No	</th>
        <th>List Price</th>
        <th>Discount</th>
        <th>Quantity</th>
        <th>Total Amount</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(pre,index) in product" :key="index">
       <td>{{pre.product.material_number}}</td>
       <td>{{pre.unit_price}}</td>
       <td>{{pre.discount}}</td>
       <td>{{pre.quantity}}</td>
       <td>{{pre.total_cost}}</td>
      </tr>
     
    </tbody>
  </table>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>

          </div>
          </div>
          </div>
           <a :href=salespdfpath+props.entry.id download="products.pdf" v-if="props.entry.status =='APPROVED'" class="btn btn-success btn-circle" title="download sales pdf"><i class="fas fa-file"></i></a>
         <a :href=userpdfpath+props.entry.id download="products.pdf" v-if="props.entry.status =='APPROVED'" class="btn btn-warning btn-circle" title="download user pdf"><i class="fas fa-file"></i></a>
         <a :href=exportpath+props.entry.id download="products.xlsx" class="btn btn-warning btn-circle"><i class="fas fa-file-excel"></i></a>
              </div>
          </template>
          </data-table>
          <v-dialog/>

          </div>  
          </div>
          </div>
          </div>
          </div>
  <footerr></footerr>    
</div>
</template>

<script>
import XLSX from 'xlsx'
import constants from '../../../constant.js'
import Select2 from 'v-select2-component';
import Multiselect from 'vue-multiselect'
export default {
    components: {
      Select2,
      Multiselect
  },
  props: {
    beforeUpload: Function, // eslint-disable-line
    onSuccess: Function// eslint-disable-line
  },
    data(){
    return {
     tasks:[],
     tasksdata: {},
     gridColumns: ['#','refrence_number', 'revision','project_name','customers_id', 'currency','quotation_cost','created_by','country','validity','PL 11', 'PL 12_OEM', 'PL 12', 'PL 21', 'PL 22', 'PL 31', 'PL 32', 'PL 33', 'PL 34', 'PL 35','PL 21_TOOL', 'PL 22_TOOL','action'],
     displayNames: {  'refrence_number':'Refrence Number','project_name': 'Project Name','customers_id': 'Customer','country': 'Country','currency':'Currency','created_by':'Created By', 'quotation_cost':'Amount'},
     gridData: [],
     sort:['refrence_number', 'revision','project_name','customers_id','country', 'currency','quotation_cost','created_by','validity','PL 11', 'PL 12_OEM', 'PL 12', 'PL 21', 'PL 22', 'PL 31', 'PL 32', 'PL 33', 'PL 34', 'PL 35','PL 21_TOOL', 'PL 22_TOOL'],
     searchQuery:'',
     checkID:[],
     selectedFile:'',
     CustomerName:'', 
     itemPerPage:10,
     loading: false,
      excelData: {
        header: null,
        results: null
      },
      product_icon:'',
      product:[],
      exportpath:'../api/quotationexcel/',
      salespdfpath:'../api/quotation/sales/pdf/',
      userpdfpath:'../api/quotation/user/pdf/',
      approved_user_id:localStorage.getItem('id'),
      rejectid:'',
      created_by:'',
      userreport_list:[],
      currency_list:['USD','SGD'],
      filter_arr: {
        user_name:'',
        currency:'',
        from_date:'',
        to_date:''
      },
      excelExportdata: {
        user: 0,
        currency: 0,
        from_date: 0,
        to_date: 0,
      },
      id:localStorage.getItem('id'),
      role_id:localStorage.getItem('role_id')
    }
  },
  mounted(){
    this.product_icon = constants.product_icon
  },

  methods:{
          
        getRecord(id, ref_no) {

              console.log(btoa(ref_no));
              
            var app=this;
            this.$http({
            url: `quotationsingle/`+id+'/'+ btoa(ref_no),
            method: 'GET',
            })
            .then((res) => {
            app.product = res.data.qp;
            /* $.each(pro,function(index, value){
            app.product.push(value);
            }) ; */

            }, () => {
            this.has_error = true
            }); 
            } ,
      getQuotation(val=null) {
        if(val==null) {
           var app = this
          
                     this.$http.get("retail-pl-report/"+localStorage.getItem('id')+"/"+localStorage.getItem('role_id') ).then((res) => {
                  let users_id = localStorage.getItem('role_id');
                  this.gridData= res.data.data;
                //   console.log(res.data.data[0].productquotation);

                  
                }, () => {
                this.has_error = true
                }); 
        }
        else {
              var app = this
               if(app.filter_arr.user_name != '') {
                  app.excelExportdata.user = app.filter_arr.user_name;
                }
                if(app.filter_arr.currency != '') {
                  app.excelExportdata.currency = app.filter_arr.currency;
                }
                if(app.filter_arr.from_date != '') {
                  app.excelExportdata.from_date = app.filter_arr.from_date;
                }
                if(app.filter_arr.to_date != '') {
                  app.excelExportdata.to_date = app.filter_arr.to_date;
                }
                // console.log(app.excelExportdata);
                
                 let formData = new FormData();
                    formData.append('user_name',app.filter_arr.user_name),
                    formData.append('currency',app.filter_arr.currency),
                    formData.append('from_date',app.filter_arr.from_date),
                    formData.append('to_date',app.filter_arr.to_date),
                     this.$http.post("retail-pl-report/"+localStorage.getItem('id')+"/"+localStorage.getItem('role_id'), formData ).then((res) => {
                  let users_id = localStorage.getItem('role_id');
                  this.gridData= res.data.data;
                }, () => {
                this.has_error = true
                }); 
        }
          
      },
    changePageCount() {
        this.itemPerPage = Number(this.itemPerPage);
    },

    userreport( ) {
      var app=this;
            this.$http({
            url: `userreport/`+localStorage.getItem('id'),
            method: 'GET',
            })
            .then((res) => {
                let users_id = localStorage.getItem('role_id');

                  if(users_id == 4 || users_id == 5 || users_id == 6) {
                      let user_arr= res.data.user.country;
                      $.each(user_arr,function(index, value){
                      app.userreport_list.push({'id':value.id,'text':value.name})
                    }) ;
              }
       else {
          let user_arr= res.data.user.all;
                    $.each(user_arr,function(index, value){
                    app.userreport_list.push({'id':value.id,'text':value.name})
                    });
       }
           
            }, () => {
            this.has_error = true
            }); 
    },

    /* filterReport() {
                   let app =this;
                    app.load = false;
                    let formData = new FormData();
                    formData.append('user_name',app.filter_arr.user_name),
                    formData.append('currency',app.filter_arr.currency),
                    formData.append('from_date',app.filter_arr.from_date),
                    formData.append('to_date',app.filter_arr.to_date),
                    this.$http.post ( 'filterreport', formData ).then(function (res) {
                    if (res.data.status=="success"){
                    app.load = true;
                    app.$toasted.success('quotation added successfully'); 
                    }
                    else {
                    app.$toasted.error('somthing went wrong');
                    app.load = true;
                    } 
                    }); 
    } */
  },

  created() {
      this.getQuotation();
      this.getRecord();
      this.userreport();
  },

  computed:{
        indexedItems () {
        return this.gridData.map((item, index) => ({
            '#': index+1,
            ...item
            }));   
    }
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
/deep/thead {
    background: rgb(55, 110, 180);
    color: white
}
/deep/ tbody tr td {
    border: 1px solid #DEE2E6;
    padding: 15px;
}
/deep/ .table tr {
    border: 1px solid #DEE2E6;
    font-size:13px;
}
/deep/th.active .arrow {
  opacity: 1;
}

/deep/.arrow {
  display: inline-block;
  vertical-align: middle;
  width: 0;
  height: 0;
  margin-left: 5px;
  opacity: 0.66;
}

/deep/.arrow.asc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-bottom: 4px solid white;
}

/deep/.arrow.dsc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 4px solid white;
}
.i{
  font-size: 21px;
  letter-spacing: 15px;
}
i:hover {
  cursor: pointer;
}
.action-panel {
    display: flex;
}
.action-panel .btn {
    margin: 0 2px;
}

.fa-plus {
    font-size: 15px;
    text-align: center;
    font-weight: normal;
    background: #f4f6f9;
    color: #4fd23f;
    border-radius: 50%;
    width: 17px;
    height: 18px;
    padding: 2px;
}
/* .fa-trash {
    font-size: 19px;
    white-space: 0px;
    position: relative;
    left: 7px;
}
.fa-info {
    color: white;
    background: rgb(81, 85, 89);
    text-align: center;
    height: 24px;
    width: 22px;
    padding-left: 7px;
    padding-top: 2px;
}
.fa-edit {
    background-color: #2B71B9;
    color: white;
    text-align: center;
    height: 24px;
    width: 22px;
    padding-left: 3px;
    padding-top: 5px;
    font-size: 17px;
}
.fa-eye {
    color: white;
    background: rgb(81, 85, 89);
    text-align: center;
    height: 24px;
    width: 27px;
    padding-left: 3px;
    padding-top: 1px;
}
.faa {
    color: white;
    background: #d64a4a;
    text-align: center;
    height: 24px;
    width: 21px;
    padding-left: 2px;
    padding-top: 2px;
}
.fa-check {
   color: white;
    background: #2ecc71;
    text-align: center;
    height: 24px;
    width: 23px;
    padding-left: 2px;
    padding-top: 2px;
} */
.head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    padding: 1rem;
}
/deep/.previousPage {
  position: relative;
}
/deep/.previousPage:before {
  content: "\f104";
  font-family: FontAwesome;
  position: absolute;
}
 
/deep/.nextPage {
  position: relative;
}
/deep/.nextPage:before {
  content: "\f105";
  font-family: FontAwesome;
  position: absolute;
  left: 5px;
}
.button::before {
  font-family: "FontAwesome";
    font-weight: 900;
    content: "\F019";
    left: 0px;
    /* margin-left: 1px; */
    right: 0px;
    padding: 6px;
    font-weight: bolder;
}

.button {
    padding: 0px 26px;
    -webkit-text-decoration: bold;
    text-decoration: bold;
    text-transform: none;
    cursor: pointer;
    font-size: 14px;
    border-radius: 3px;
    height: 37px;
    white-space: nowrap;
    display: -webkit-box;
    display: -ms-flexbox;
    -ms-flex-pack: center;
    justify-content: center;
    -ms-flex-align: center;
    align-items: center;
    position: relative;
}
.button:hover {
     background-color: #007bbc;
}
.fa-plus-circle {
  white-space: 0px;
    position: relative;
    left: 7px;
    top:2px;
}
.btn-circle {
    width: 30px;
    height: 26px;
    padding: 5px 0px;
    border-radius: 0px;
    text-align: center;
    font-size: 12px;
    line-height: 1.42857;
}
.btn-circle.btn-xl {
    width: 70px;
    height: 70px;
    padding: 10px 16px;
    border-radius: 35px;
    font-size: 24px;
    line-height: 1.33;
}
</style>