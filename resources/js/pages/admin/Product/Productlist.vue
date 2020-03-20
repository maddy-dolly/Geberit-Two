<template>
<div>
  <navbar></navbar>
  
    <div class="content-wrapper">
      <div class="content-header">
       
        <div class="container-fluid">
           <div class="row">
                  
                    <div class="col-md-4">
                      <h2><img :src="product_icon" style="height: 39px; width: 57px;">Products</h2>
                    </div>
    
                     <div class="ml-auto" style="display:inherit" v-if="$auth.check(1) || $auth.check(2)">
         <router-link :to="{name:'addproduct'}" class="nav-link btn" style="margin-right: 6px;background:#4fd23f;color:white;height: 40px;
    width: 135px;" title="add new"><i class="fas fa-plus-circle i"></i>Add New</router-link>
                     </div>
                </div>
                <br>
            <div class="card" v-if="$auth.check(1) || $auth.check(2)">
                <div style="margin:20px">
                    <div class="row">
                        <div class="col-md-3">
                    <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                <label class="custom-file-label" for="exampleInputFile">{{import1}}</label>
                              </div>
                               <input ref="excel-upload-input"  class=" custom-file-input" type="file" accept=".xlsx,.xls" @change="handleClick">
                    </div>
                        </div>
                    <div class="drop col-md-3" @drop="handleDrop" @dragover="handleDragover" @dragenter="handleDragover">
                <button type="submit" class="btn btn-primary button" :loading="loading" @click="upload" title="import file">Import</button>
                </div>
                    </div>
                    <span style="color:#5d5353">Download sample file: <span style="color:#1138f7;">Product Excel File</span></span>
            </div>
                </div><br>
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
                     <template slot="country" slot-scope="props">
                       <p v-if="props.entry.country">{{props.entry.country.name}}</p>
                       <p v-else>-</p>
                    </template>
                    <template slot="description" slot-scope="props">
                       <p v-if="props.entry.description">{{props.entry.description}}</p>
                       <p v-else>-</p>
                    </template>
                    <template slot="list_price_usd" slot-scope="props">
                       <p v-if="props.entry.list_price_usd">{{props.entry.list_price_usd}}</p>
                       <p v-else>-</p>
                    </template>
                    <template slot="list_price_sgd" slot-scope="props">
                       <p v-if="props.entry.list_price_sgd">{{props.entry.list_price_sgd}}</p>
                       <p v-else>-</p>
                    </template>
                    <template slot="product_line" slot-scope="props">
                       <p v-if="props.entry.product_line">{{props.entry.product_line}}</p>
                       <p v-else>-</p>
                    </template>
                    <template slot="action" slot-scope="props">
                      <router-link :to="{name:'viewproduct', params:{id:props.entry.id}}" class="btn btn-secondary btn-circle" title="view product"><i class="fa fa-eye"></i></router-link>             
                      <router-link :to="{name:'editproduct',params:{id:props.entry.id}}" title="edit product" v-if="$auth.check(1) || $auth.check(2)" class="btn btn-circle" style="background-color: #2B71B9;color:white"><i class="fa fa-edit"></i></router-link>
                      <button title="delete product" class="btn btn-danger btn-circle" @click="deleteModel(props.entry.id);"  v-if="$auth.check(1) || $auth.check(2)"><i class="fa fa-trash faa" ></i></button>
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
     gridColumns: ['#','material_number', 'description','list_price_usd','list_price_sgd', 'product_line','country','material_status','action'],
     displayNames: {  'material_number':'Material Number','list_price_usd': 'LP (USD)','list_price_sgd': 'LP (SGD)','product_line':'Product Line','material_status':'Material Status', 'country':'Country'},
     gridData: [],
     sort:['material_number', 'description','list_price_usd','list_price_sgd', 'product_line','country','material_status',],
     searchQuery:'',
     checkID:[],
     selectedFile:'',
     CustomerName:'', 
     import1:'Choose File',    
     itemPerPage:10,
     loading: false,
      excelData: {
        header: null,
        results: null
      },
      product_icon:''
    }
  },
  mounted(){
    this.product_icon = constants.product_icon
  },

  methods:{
      getProduct() {
          var app = this
                this.$http({
                url: `showproduct`,
                method: 'GET',
                })
                .then((res) => {
                this.gridData= res.data.product
                console.log(this.gridData);
                
                
                }, () => {
                this.has_error = true
                }); 
      },
     
deleteModel(id) {
              console.log(id);
              
              this.$modal.show('dialog', {
              text: 'Are you sure to delete',
              buttons: [
              {
              title: 'YES',
              handler: () => { this.deleteProduct(id) }
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
      

     deleteProduct(id) {
         let app = this
       this.$http({
                url: `deleteproduct/`+id,
                method: 'GET',
                })
                .then((res) => {
                  this.$modal.hide('dialog');
                app.$toasted.success('Product deleted successfully');  
                this.getProduct();     
                }, () => {
                this.has_error = true
                }); 
     } ,  
  
    changePageCount() {
        this.itemPerPage = Number(this.itemPerPage);
    },
    
   

    //for xls genration
     generateData({ header, results }) {
      this.excelData.header = header
      this.excelData.results = results
      this.onSuccess && this.onSuccess(this.excelData)
      this.addAll();
      this.getProduct();
    },
    addAll() {
       
     let app= this;
                this.$http({
                url: `addallproduct`,
                method: 'POST',
                data:
                  app.excelData,
                  
                })
                .then((res) => {
                  if(res.data.status== 'success') {
                      app.$toasted.success('Customer excel file imported successfully');
                  }
                  else{
                    app.CustomerName = res.data.cust['Material no.']
                    app.$toasted.error(app.CustomerName + ' is already exist');
                    
                  }
                 
                
                }, () => {
                this.has_error = true
                app.$toasted.error('Please select valid file');
                }); 
       
    },
    handleDrop(e) {
      e.stopPropagation()
      e.preventDefault()
      if (this.loading) return
      const files = e.dataTransfer.files
      if (files.length !== 1) {
        this.$message.error('Only support uploading one file!')
        return
      }
      const rawFile = files[0] // only use files[0]
      if (!this.isExcel(rawFile)) {
        this.$message.error('Only supports upload .xlsx, .xls, .csv suffix files')
        return false
      }
      this.upload(rawFile)
      e.stopPropagation()
      e.preventDefault()
    },
    handleDragover(e) {
      e.stopPropagation()
      e.preventDefault()
      e.dataTransfer.dropEffect = 'copy'
    },
    handleUpload() {
      this.$refs['excel-upload-input'].click()
    },
    handleClick(e) {
      const files = e.target.files
      this.import1 = e.target.files[0].name
      const rawFile = files[0] // only use files[0]
      this.selectedFile = rawFile;
    },
    upload() {
        let app =this;
         if(this.selectedFile=='') {
            app.$toasted.error('Please select file first then import !')
        }
        else {
      const rawFile = this.selectedFile;
      
      this.$refs['excel-upload-input'].value = null // fix can't select the same excel
      if (!this.beforeUpload) {
        this.readerData(rawFile)
        return
      }
      const before = this.beforeUpload(rawFile)
      if (before) {
        this.readerData(rawFile)
      }
        }
    },
    readerData(rawFile) {
        
      this.loading = true
      return new Promise((resolve, reject) => {
        const reader = new FileReader()
        reader.onload = e => {
          const data = e.target.result
          const workbook = XLSX.read(data, { type: 'array' })
          const firstSheetName = workbook.SheetNames[0]
          const worksheet = workbook.Sheets[firstSheetName]
          const header = this.getHeaderRow(worksheet)
          const results = XLSX.utils.sheet_to_json(worksheet)
          this.generateData({ header, results })
          this.loading = false
          resolve()
        }
        reader.readAsArrayBuffer(rawFile)
      })
    },
    getHeaderRow(sheet) {
      const headers = []
      const range = XLSX.utils.decode_range(sheet['!ref'])
      let C
      const R = range.s.r
      /* start in the first row */
      for (C = range.s.c; C <= range.e.c; ++C) { /* walk every column in the range */
        const cell = sheet[XLSX.utils.encode_cell({ c: C, r: R })]
        /* find the cell in the first row */
        let hdr = 'UNKNOWN ' + C // <-- replace with your desired default
        if (cell && cell.t) hdr = XLSX.utils.format_cell(cell)
        headers.push(hdr)
      }
      return headers
    },
    isExcel(file) {
      return /\.(xlsx|xls|csv)$/.test(file.name)
    }

    
  },

  created() {
      this.getProduct()
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

</style>