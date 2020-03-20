<template>
<div>
  <navbar></navbar>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid" style="min-height:100vh">
           <div class="row">
                    <div class="col-md-4" style="margin-left: 8px;">
    <h2><img src="/icons/man.svg" style="height: 39px; width: 57px;">Users</h2>
                     </div>
                     <div class="ml-auto" style="display:inherit;padding-top:12px">
                         <button class="btn" style="background:#d64a4a;color:white" @click="bulkDelete"><i class="fa fa-trash"></i>Bulk Delete</button>
            &nbsp;&nbsp; <router-link :to="{name:'adduser'}" class="nav-link btn" style="background:#4fd23f;color:white"><i class="fas fa-plus-circle i"></i>Add New</router-link>
                     </div>
                </div>
                <br>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 form-group" style="margin-left: 8px; display:inline">
                        <div class="row">
                            <div class="col-md-2">Show</div>
                            <div class="col-md-2" style="margin-left: -55px;">
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
                     <template slot="role" slot-scope="props">
                       {{props.entry.role.display_name}}
                    </template>
                    <template slot="action" slot-scope="props">
                      <router-link :to="{name:'viewuser', params:{id:props.entry.id}}" title="View user" class="btn btn-secondary btn-circle"><i class="fa fa-eye"></i></router-link>             
                      <router-link :to="{name:'edituser',params:{id:props.entry.id}}" title="Edit User" class="btn btn btn-circle" style="background-color: #2B71B9;color:white"><i class="fa fa-edit"></i></router-link>
                      <button class="btn btn-danger btn-circle" title="Deactivate" v-if="props.entry.status==='Active'" @click="active('Deactive',props.entry.id)"><i  class="fa fa-times" ></i></button>
                      <button class="btn  btn-circle" v-else style="background-color: #2ecc71;color:white" @click="active('Active',props.entry.id)" title="Activate"><i  class="fa fa-check faa" ></i></button>
                    </template>
                </data-table>
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
    data(){
    return {
     tasks:[],
     tasksdata: {},
     gridData:[],
     gridColumns: ['#','name', 'role','email', 'contact_number','action','Select'],
     displayNames: { 'contact_number':'Contact Number'}, 
     sort:['name', 'role','email','contact_number'],
     searchQuery:'',
     checkID:[],     
     itemPerPage:10,
     
    }
  },

  methods:{
      getUser() {
          var app = this
                this.$http({
                url: `users`,
                method: 'GET',
                })
                .then((res) => {
                this.gridData= res.data.users,
                console.log(this.gridData);
                
               
                console.log(res);
                
                }, () => {
                this.has_error = true
                }); 
      },

      

     active(status,id) {
         let app = this
       this.$http({
                url: `status/`+id,
                method: 'POST',
                data:{
                  status:status
                }
                })
                .then((res) => {
                app.$toasted.success('User status updated successfully');
               
                this.getUser();     
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
             app.$toasted.error('Please select atleast one role !');
        }
       else {
          this.$http({
                      url: `userdelete`,
                      method: 'POST',
                      data:{
                          users_ids:app.checkID
                      }
                      })
                      .then((res) => {
                      app.getUser();
                      app.$toasted.success('Selected user deleted successfully !');
                          }, () => {
                      this.has_error = true
                      });
        }
    }
    
  },

  created() {
      this.getUser()
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
.btn-circle {
    width: 30px;
    height: 30px;
    padding: 7px 0px;
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