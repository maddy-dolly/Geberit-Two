<template>
<div>
  <navbar></navbar>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid" style="min-height:100vh">
           <div class="row">
                    <div class="col-md-4">
                      <h2><img src="/icons/user.svg" style="height: 39px; width: 57px;">Roles</h2>
                    </div>
                     <div class="ml-auto" style="display:inherit;padding:4px">
                          <button class="btn" style="background:#d64a4a;color:white" v-if="$auth.check(1)" @click="bulkDelete" title="Bulk delete"><i class="fa fa-trash"></i>Bulk Delete</button>
                         &nbsp;&nbsp;<router-link :to="{name:'addrole'}" v-if="$auth.check(1)" class="nav-link btn" style="background:#4fd23f;color:white" title="Add new role"><i class="fas fa-plus-circle i"></i>Add New</router-link>
                     </div>
                </div>
                <br>
                <div class="card">
                  <div class="card-body">
                <div class="row">
                  <div class="col-md-6 form-group" style=" display:inline">
                        <div class="row">
                            <div class="col-md-2">Show</div>
                            <div class="col-md-2" style="margin-left: -55px;" >
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
                    <template slot="Select" slot-scope="props" v-if="$auth.check(1)" >
                        <input type="checkbox" class="check_id" :value=props.entry.id name="check_id[]" @click="checkBoxID" >
                    </template>
                    <template slot="action" slot-scope="props">
                           <button class="btn btn-secondary btn-circle" @click="getRecord(props.entry.id)" data-toggle="modal" data-target="#myModal" title="Role info"><i class="fa fa-info"></i></button>
                                <div class="modal" id="myModal">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="head">
                                            <h2 class="modal-title" style="text-align:center">Role Info</h2> 
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="row">
                                              <div class="col-md-4">
                                                  <div class="form-group">
                                                        <label class="label_">Sr.No</label><br>
                                                        <p>1</p>
                                                        <p>2</p>
                                                        <p>3</p>
                                                        <p>4</p>
                                                    </div>
                                              </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="label_">Year</label><br>
                                                        <p>{{tasks['year_1']}}</p>
                                                        <p>{{tasks['year_2']}}</p>
                                                        <p>{{tasks['year_3']}}</p>
                                                        <p>{{tasks['year_4']}}</p>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="label_">Discount</label><br>
                                                        <p>{{tasks['discount_1']}}</p>
                                                        <p>{{tasks['discount_2']}}</p>
                                                        <p>{{tasks['discount_3']}}</p>
                                                        <p>{{tasks['discount_4']}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>       
                                    </div>
                                    </div>
                                </div>
                          <router-link :to="{name:'viewrole', params:{id:props.entry.id}}" title="View role" v-if="$auth.check(1) || $auth.check(2)" class="btn btn-dark btn-circle"><i class="fa fa-eye"></i></router-link>             
                           <router-link :to="{name:'editrole',params:{id:props.entry.id}}" title="Edit role" v-if="$auth.check(1) || $auth.check(2)" class="btn btn-circle" style="background-color: #2B71B9;color:white"><i class="fa fa-edit"></i></router-link>
                           <button class="btn btn-danger btn-circle" @click="deleteModel(props.entry.id);" title="delete customer" v-if="$auth.check(1)"><i class="fa fa-trash faa" ></i></button>

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
export default {
    data(){
    return {
     tasks:[],
     tasksdata: {},
     gridColumns: ['Select','#','display_name', 'discount','action',],
     displayNames: {  'display_name':'Display Name'},
     gridData: [],
     searchQuery:'',
     checkID:[],     
     itemPerPage:10,
     sort:['#','display_name', 'discount'],
    }
  },

  methods:{
      getRole() {
          var app = this
                this.$http({
                url: `showrole`,
                method: 'GET',
                })
                .then((res) => {
                this.gridData= res.data.users,
                //console.log(this.gridData);
                
                this.status = res.data.status
                //console.log(res);
                
                }, () => {
                this.has_error = true
                }); 
      },

      getRecord(id) {
       this.$http({
                url: `showrole/`+id,
                method: 'GET',
                })
                .then((res) => {
                this.tasks= res.data.users,
                // console.log(this.tasks);
                
                this.status = res.data.status
                //console.log(res);
                
                }, () => {
                this.has_error = true
                }); 
     } , 
     deleteModel(id) {
              console.log(id);
              
              this.$modal.show('dialog', {
              text: 'Are you sure to delete',
              buttons: [
              {
              title: 'YES',
              handler: () => { this.deleteRole(id) }
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
      

     deleteRole(id) {
         let app = this
       this.$http({
                url: `deleterole/`+id,
                method: 'GET',
                })
                .then((res) => {
                   this.$modal.hide('dialog');
                app.$toasted.success('Role deleted successfully');
                this.status = res.data.status;
                this.getRole();     
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
                      url: `bulkdelete`,
                      method: 'POST',
                      data:{
                          check_ids:app.checkID
                      }
                      })
                      .then((res) => {
                      this.status = res.data.status;
                      app.$toasted.success('Selected role deleted successfully !');
                      app.role()  
                      }, () => {
                      this.has_error = true
                      });
        }
    }
    
  },

  created() {
      this.getRole()
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
/*.fa-trash {
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
    padding-top: 4px;
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