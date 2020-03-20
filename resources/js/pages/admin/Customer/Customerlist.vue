<template>
<div>
  <navbar></navbar>
  
    <div class="content-wrapper">
      <div class="content-header">
       
        <div class="container-fluid">
           <div class="row">
                  
                    <div class="col-md-4">
                       <h2><img src="/icons/value.svg" style="height: 39px; width: 57px;">Customers</h2>
                    </div>
    
                     <div class="ml-auto" style="display:inherit">
          <button class="btn" style="background:#d64a4a;color:white;height: 36px;width: 136px;" @click="bulkDelete" title="bulk delete"><i class="fa fa-trash"></i>Bulk Delete</button>
          &nbsp;&nbsp;<router-link :to="{name:'addcustomer'}" class="nav-link btn" style="background:#4fd23f;color:white;height: 36px;
       width: 124px;"><i class="fas fa-plus-circle i" title="add customer"></i>Add New</router-link>
                     </div>
                </div>
                <br>
            <div class="card">
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
                <button type="submit" class="btn btn-primary button" :loading="loading" @click="upload" title="import file" >Import</button>
                </div>
                    </div>
                  <span style="color:#5d5353" title="sample file">Download sample file: <span style="color:rgb(55, 110, 180);">Product Excel File</span></span>

            </div>
                </div><br>
                 <div class="card">
            <div class="container" style="margin-top:20px"> 
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
                <data-table class="table" :data="indexedItems"  :child-hideable="true" :child-init-hide="true" :columns-to-display="gridColumns" :columnsToSort="sort" 
                :filter-key="searchQuery" :itemsPerPage=itemPerPage :display-names="displayNames">
                    <template slot="Select" slot-scope="props">
                        <input type="checkbox" class="check_id" :value=props.entry.id name="check_id[]" @click="checkBoxID" >
                    </template>
                     <template slot="countries_id" slot-scope="props">
                       {{props.entry.country.name}}
                    </template>
                    <template slot="action" slot-scope="props">
                      <router-link :to="{name:'viewcustomer', params:{id:props.entry.id}}" title="view customer" class="btn btn-secondary btn-circle"><i class="fa fa-eye"></i></router-link>             
                      <router-link :to="{name:'editcustomer',params:{id:props.entry.id}}" title="edit customer" class="btn btn-circle" style="background-color: #2B71B9;color:white"><i class="fa fa-edit"></i></router-link>
                      <button class="btn btn-danger btn-circle" @click="deleteModel(props.entry.id);" title="delete customer"><i class="fa fa-trash faa" ></i></button>
                           <!-- The Modal -->

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


export default {
  props: {
    beforeUpload: Function, // eslint-disable-line
    onSuccess: Function// eslint-disable-line
  },
    data(){
    return {
     tasks:[],
     tasksdata: {},
     gridColumns: ['#','name', 'countries_id','currency','action','Select'],
     gridData: [],
     searchQuery:'',
     checkID:[],
     selectedFile:'',
     CustomerName:'', 
     import1:'Choose File',    
     itemPerPage:10,
     displayNames: {  'countries_id':'Countries'},
     sort:['#','countries_id', 'currency','name'],
     loading: false,
      excelData: {
        header: null,
        results: null
      }
    }
  },

  methods:{
      getCustomer() {
          var app = this
                this.$http({
                url: `customer`,
                method: 'GET',
                })
                .then((res) => {
                this.gridData= res.data.user
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
              handler: () => { this.deleteCustomer(id) }
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
      

     deleteCustomer(id) {
         let app = this
       this.$http({
                url: `deletecustomer/`+id,
                method: 'GET',
                })
                .then((res) => {
                  this.$modal.hide('dialog');
                app.$toasted.success('Customer deleted successfully');  
                this.getCustomer();     
                }, () => {
                this.has_error = true
                }); 
     } ,  
    checkBoxID(){
        let app =this;
        app.checkID=[];
        $(".check_id").each(function(index,value){
            if($(this).is(":checked")){
                app.checkID.push($(this).val())
            }
        })    
    },
    changePageCount() {
        this.itemPerPage = Number(this.itemPerPage);
    },
    
    bulkDelete() {
          let app =this;
        if(app.checkID=='') {
             app.$toasted.error('Please select atleast one Customer !');
        }
       else {
          this.$http({
                      url: `customerbulkdelete`,
                      method: 'POST',
                      data:{
                          users_ids:app.checkID
                      }
                      })
                      .then((res) => {
                      app.getCustomer();
                      app.$toasted.success('Selected user deleted successfully !');
                          }, () => {
                      this.has_error = true
                      });
        }
    },

    //for xls genration
     generateData({ header, results }) {
      this.excelData.header = header
      this.excelData.results = results
      this.onSuccess && this.onSuccess(this.excelData)
      this.addAll();
      this.getCustomer();
    },
    addAll() {
       
     let app= this;
                this.$http({
                url: `addallcustomer`,
                method: 'POST',
                data:
                  app.excelData,
                  
                })
                .then((res) => {
                  if(res.data.status== 'success') {
                      app.$toasted.success('Customer excel file imported successfully');
                  }
                  else{
                    app.CustomerName = res.data.cust['Customers Name']
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
      this.getCustomer()
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