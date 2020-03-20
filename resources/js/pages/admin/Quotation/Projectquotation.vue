<template>
<div>
  <navbar></navbar>
  
          <div class="content-wrapper">
          <div class="content-header">

          <div class="container-fluid">
          <div class="row">     
          <div class="col-md-4">
          <h2><img src="/icons/draft.svg" style="height: 39px; width: 57px;">Project Quotation</h2>
          </div>
          <div class="ml-auto" style="display:inherit">
          <router-link :to="{name:'addquotation'}" class="nav-link btn" style="margin-right: 6px;background:#4fd23f;color:white;height: 40px;
          width: 135px;" title="add new quotation"><i class="fas fa-plus-circle i"></i>Add New</router-link>
          </div>
          </div>
          <br>
          <div class="card">
          <div class="card-body" style=""> 
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
          <p v-if="props.entry.user">{{props.entry.user.name}}</p>
          <p v-else>-</p>
          </template>
          <template slot="validity" slot-scope="props">
          <p v-if="props.entry.validity">{{props.entry.validity}}</p>
          <p v-else>-</p>
          </template>
          <template slot="action" slot-scope="props">
             <div class="action-panel">
          <button class="btn btn-secondary btn-circle" data-toggle="modal" data-target="#myModal1" title="quotation info" @click="getRecord(props.entry.id,props.entry.refrence_number)"><i class="fas fa-info"  ></i></button>
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
         <a :href=exportpath+props.entry.id download="products.xlsx" class="btn btn-info btn-circle" title="download excel file"><i class="fas fa-file-excel"></i></a>
         <a :href=salespdfpath+props.entry.id download="products.pdf" class="btn btn-success btn-circle" title="download sales pdf" v-if="props.entry.status =='APPROVED'"><i class="fas fa-file"></i></a>
         <a :href=userpdfpath+props.entry.id download="products.pdf" class="btn btn-warning btn-circle" title="download user pdf" v-if="props.entry.status =='APPROVED'"><i class="fas fa-file"></i></a>
            
          <router-link :to="{name:'viewquotation', params:{id:props.entry.id,ref_no:props.entry.refrence_number}}" class="btn btn-dark btn-circle" title="view quotation"><i class="fas fa-eye"></i></router-link>             
          <router-link v-if="created_by==approved_user_id" :to="{name:'editquotation',params:{id:props.entry.id}}" class="btn btn-primary btn-circle" title="edit quotation"><i class="fas fa-edit"></i></router-link>
         <i v-if="props.entry.assigned_to_flag  && props.entry.status=='PENDING' && props.entry.approved_to_flag" title="accept quotation" class="fas fa-check btn  btn-circle" @click="approveQuotation(props.entry.id)" style="background-color:#3b9ee5;color:white"></i>
         <i v-if="props.entry.assigned_to_flag && props.entry.status=='PENDING' && props.entry.approved_to_flag" title="reject quotation" class="fas fa-times btn  btn-circle"  @click="rejectid = props.entry.id" style="background-color:#e95866;color:white"></i>
          <rejectquotation v-if="rejectid === props.entry.id" @close="rejectid = '';getQuotation()" :id="props.entry.id" title="reject quotation"></rejectquotation>

          <i class="fas fa-trash faa btn btn-danger btn-circle"  @click="deleteModel(props.entry.id);" title="delete quotation"></i>&nbsp;&nbsp;&nbsp;&nbsp;
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
export default {
  props: {
    beforeUpload: Function, // eslint-disable-line
    onSuccess: Function// eslint-disable-line
  },
    data(){
    return {
     tasks:[],
     tasksdata: {},
     gridColumns: ['#','refrence_number', 'revision','project_name','customers_id', 'created_at','quotation_cost','status','created_by','validity','action'],
     displayNames: {  'refrence_number':'Refrence Number','project_name': 'Project Name','customers_id': 'Customer','created_at':'Quotation Date','created_by':'Created By', 'quotation_cost':'Amount'},
     gridData: [],
     sort:['refrence_number', 'revision','project_name','customers_id', 'created_at','quotation_cost','status','created_by','validity'],
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
      created_by:''
    }
  },
  mounted(){
    this.product_icon = constants.product_icon
  },

  methods:{
          deleteModel(id) {
              console.log(id);
              
              this.$modal.show('dialog', {
              text: 'Are you sure to delete',
              buttons: [
              {
              title: 'YES',
              handler: () => { this.deleteQuotation(id) }
              },
              {
              title: '',       // Button title
              default: true,    // Will be triggered by default if 'Enter' pressed.
              handler: () => {} // Button click handler
              },
              {
              title: 'NO'
              }
              ]
              })
            },
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
      getQuotation() {
          var app = this
                this.$http({
                url: `quotationlist/`+localStorage.getItem('id'),
                method: 'GET',
                })
                .then((res) => {
                
               
               //let assigned_to = res.data.quotation.assigned_to;
               $.each(res.data.data.project, function(index,value) {
                  let assigned_to=[];
                  let approved_to=[];
                 app.created_by = value.created_by;
                   assigned_to=value.assigned_to.split(",");
                   value.approved_to_flag = true;
                   if(value.approved_by) {
                     approved_to=value.approved_by.split(",");
                   }
                   if(assigned_to.indexOf(localStorage.getItem('id')) !== -1){
                       value.assigned_to_flag=true;
                   }
                   else{
                       value.assigned_to_flag=false;
                   }
                 // console.log(approved_to);
                  
                     
                   if(approved_to.indexOf(localStorage.getItem('id')) == -1){
                       value.approved_to_flag=true;
                   }
                   else{
                       value.approved_to_flag=false;
                   }
               });
               this.gridData= res.data.data.project;
                
                
                }, () => {
                this.has_error = true
                }); 
      },
     

      

     deleteQuotation(id) {
       console.log(id);
       
         let app = this
       this.$http({
                url: `quotationdelete/`+id,
                method: 'GET',
                })
                .then((res) => {
                   this.$modal.hide('dialog');
                app.$toasted.success('Product deleted successfully');  
                this.getQuotation();     
                }, () => {
                this.has_error = true
                }); 
     } ,  
  
    changePageCount() {
        this.itemPerPage = Number(this.itemPerPage);
    },

    approveQuotation(id) {
                    let app =this;
                    let formData = new FormData();
                    formData.append('approved_by',app.approved_user_id),
                    formData.append('last_updated_by',app.approved_user_id),
                    
                    
                    this.$http.post ( 'approvequotation/'+id, formData ).then(function (res) {
                      app.getQuotation();
                    if (res.data.status=="success"){
                    app.$toasted.success('quotation updated successfully'); 
                    }
                    else {
                    app.$toasted.error('somthing went wrong');

                    } 
                    });
    }
    
  },

  created() {
      this.getQuotation();
     // this.getRecord();
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
.action-panel {
    display: flex;
}
.action-panel .btn {
    margin: 0 2px;
}

</style>