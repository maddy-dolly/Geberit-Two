<template>
<div>
   <body class="hold-transition sidebar-mini">
     <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top" style="background: #376eb4;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars" style="color:white"></i></a>
            </li>
            </ul>
         <ul class="nav navbar-nav ml-auto">
                <li class="dropdown">
                    <a href="#" class="" data-toggle="dropdown">
                        <img :src="user" class="img-circle" alt="User Image" height="30px" width="30px">
                        <span class="fa fa-caret-down" style="color: #322b2b;"></span>
                    </a>
                    <ul class="dropdown-menu" style="min-height: 175px;">
                        <li class="pro-li">
                            <img :src="user" class="profile-img">
                            <div class="profile-body">
                            <h5>{{users1.name}}</h5>
                            <h6>{{users1.email}}</h6>
                        </div>
                        </li>
                        <li class="divider"></li>
                        <li class="class-full-of-rum">
                          <router-link :to="{name:'admin.dashboard'}" class="aa">
                            <i class="fa fa-user i"></i>&nbsp;
                              Profile
                          </router-link>
                        </li>
                       
                        <li>
                          <div class="row">
                            <div class="col-md-6" style="margin-left:3px">
                              <button class="btn btn-danger" @click="logout">Logout <i class="fa fa-sign-out-alt"></i></button>
                            </div>
                          </div>
                        </li>
                      
        </ul> 
                </li>
        </ul>
  </nav>

        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
             <router-link :to="{name:''}" style="background-color:white">
            <div class="row" style="background-color:white;display:inline-flex">
              <div class="col-md-2" style="text-align:center;padding-left:25px;">
                  <img :src="image_src" alt="AdminLTE Logo" class=""  height="35px"  style="opacity: .8; margin-top: 10px;
             margin-bottom: 10px;">
              </div>
              <div class="col-md-10" style="margin-top: 8px;">
               <span class="title" style="font-weight: bold; color: black; font-size:25px; padding:0px 39px">GEBERIT</span>
              </div>
            </div>
          </router-link>

            
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img :src="user" class="img-circle" alt="User Image">
        </div>
        <div class="info">
          <router-link :to="{name:''}" class="" style="color:white;font-weight:bold">{{users1.name}} ({{role}})</router-link>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           <li class="nav-item">
            <router-link :to="{name:'admin.dashboard'}"  class="nav-link">
              <img src="/icons/speedometer.svg" class="nav-icon svg-role" >
              <p>{{this.dashname}}</p>
            </router-link>
          </li>
          <!-- Role menu -->
           <li v-if="$auth.check(1) || $auth.check(2)" class="nav-item has-treeview">
            <a href="#roleside" data-toggle="collapse" aria-expanded="false" class="nav-link">
              <img :src="role_icon" class="nav-icon svg-role" aria-hidden="true"/>
              <p>
                Role
                <i class="right fa fa-angle-down" aria-hidden="true"></i>
              </p>
            </a>
            <ul class="collapse" id="roleside" style="list-style: none; padding-left: 21px; ">
              <li class="nav-item">
                  <router-link :to="{ name: 'rolelist'}" class="nav-link"><img src="/icons/task.svg" class="sub nav-icon svg-role" aria-hidden="true"></i>
                  <p>Role Listing</p></router-link>
              </li>
              <li class="nav-item" v-if="$auth.check(1)">
                  <router-link :to="{ name: 'addrole'}" class="nav-link"><img src="/icons/add1.svg"  class="sub nav-icon svg-role" aria-hidden="true">
                  <p>Add Role</p></router-link>
              </li>
            </ul>
        </li>
        
        <!-- User menu -->
        <li class="nav-item has-treeview" v-if="$auth.check(1) || $auth.check(2)">
            <a href="#userside" data-toggle="collapse" aria-expanded="false" class="nav-link">
              <img :src="user_icon" class="nav-icon svg-role" aria-hidden="true">
              <p>
                User
                <i class="right fa fa-angle-down" aria-hidden="true"></i>
              </p>
            </a>
            <ul class="collapse" id="userside" style="list-style: none; padding-left:21px;">
              <li class="nav-item">
                  <router-link :to="{ name: 'userlist'}" class="nav-link"><img :src="user_list_icon" class="sub nav-icon svg-role" aria-hidden="true"></i>
                  <p>User Listing</p></router-link>
              </li>
              <li class="nav-item">
                  <router-link :to="{ name: 'adduser'}" class="nav-link"><img :src="user_add_icon"  class="sub nav-icon svg-role" aria-hidden="true">
                  <p>Add User</p></router-link>
              </li>
            </ul>
        </li>
          <!--Customer menu  -->
          <li class="nav-item has-treeview" v-if="$auth.check(1) || $auth.check(2)">
            <a href="#customerside" data-toggle="collapse" aria-expanded="false" class="nav-link">
              <img :src="customer_icon" class="nav-icon svg-role" aria-hidden="true">
              <p>
                Customer
                <i class="right fa fa-angle-down" aria-hidden="true"></i>
              </p>
            </a>
            <ul class="collapse" id="customerside" style="list-style: none; padding-left:21px;">
              <li class="nav-item">
               
                  <router-link class="nav-link" :to="{ name: 'customerlist'}"><img :src="customer_list_icon" class="sub nav-icon svg-role" aria-hidden="true"></i>
                  <p>Customer Listing</p></router-link>
    
              </li>
              <li class="nav-item">
               
                  <router-link class="nav-link" :to="{ name: 'addcustomer'}"><img :src="customer_add_icon"  class="sub nav-icon svg-role" aria-hidden="true">
                  <p>Add Customer</p></router-link>
    
              </li>
            </ul>
        </li>
          <!--  -->
           <li class="nav-item has-treeview" v-if="$auth.check(1) || $auth.check(2) || $auth.check(3) || $auth.check(4) || $auth.check(5) || $auth.check(6) || $auth.check(7) || $auth.check(8) || $auth.check(9) || $auth.check(10)">
            <a href="#productside" data-toggle="collapse" aria-expanded="false" class="nav-link">
              <img src="/icons/order.svg" class="nav-icon svg-role" aria-hidden="true">
              <p>
                Product
                <i class="right fa fa-angle-down" aria-hidden="true"></i>
              </p>
              </a>
            <ul class="collapse" id="productside" style="list-style: none; padding-left:21px;">
              <li class="nav-item">
               
                  <router-link class="nav-link" :to="{ name: 'productlist'}"><img src="/icons/checklist.svg" class="sub nav-icon svg-role" aria-hidden="true"></i>
                  <p>Product Listing</p></router-link>
    
              </li>
              <li class="nav-item" v-if="$auth.check(1) || $auth.check(2)">
               
                  <router-link class="nav-link" :to="{ name: 'addproduct'}"><img src="/icons/add-product.svg" class="sub nav-icon svg-role" aria-hidden="true">
                  <p>Add Product</p></router-link>
    
              </li>
            </ul>
        </li>
<!--  -->
        <li class="nav-item has-treeview">
            <a href="#quotationside" data-toggle="collapse" aria-expanded="false" class="nav-link">
              <img src="/icons/document.svg" class="nav-icon svg-role" aria-hidden="true">
              <p>
                Quotation
                <i class="right fa fa-angle-down" aria-hidden="true"></i>
              </p>
            </a>
            <ul class="collapse" id="quotationside" style="list-style: none; padding-left:21px;">
              <li class="nav-item">
               
                  <router-link class="nav-link" :to="{ name: 'projectquotation'}"><img src="/icons/newspaper.svg" class="sub nav-icon svg-role" aria-hidden="true"></i>
                  <p>Product Quotation</p></router-link>
    
              </li>
              <li class="nav-item">
               
                  <router-link class="nav-link" :to="{ name: 'retailquotation'}"><img src="/icons/barcode.svg"  class="sub nav-icon svg-role" aria-hidden="true">
                  <p>Retail Quotation</p></router-link>
    
              </li>
              <li class="nav-item" v-if="$auth.check(1) || $auth.check(3) || $auth.check(4) ||  $auth.check(5) || $auth.check(6)">
               
                  <router-link class="nav-link" :to="{ name: 'draftquotation'}"><img src="/icons/draft.svg"  class="sub nav-icon svg-role" aria-hidden="true">
                  <p>Drafted Quotation</p></router-link>
    
              </li>
              <li class="nav-item" v-if="$auth.check(1) || $auth.check(3) || $auth.check(4) ||  $auth.check(5) || $auth.check(6)">
               
                  <router-link class="nav-link" :to="{ name: 'addquotation'}" ><img  src="/icons/plus.svg"  class="sub nav-icon svg-role" aria-hidden="true">
                  <p>Add quotation</p></router-link>
    
              </li>
            </ul>
        </li>
          <!--  -->

          <!--  -->
        <li class="nav-item has-treeview">
            <a href="#reportside" data-toggle="collapse" aria-expanded="false" class="nav-link">
              <img src="/icons/report.svg" class="nav-icon svg-role" aria-hidden="true">
              <p>
                Reports
                <i class="right fa fa-angle-down" aria-hidden="true"></i>
              </p>
            </a>
            <ul class="collapse" id="reportside" style="list-style: none; padding-left:21px;">
              <li class="nav-item">
               
                  <router-link class="nav-link" :to="{ name: 'projectuserinfo'}"><img src="/icons/newspaper.svg" class="sub nav-icon svg-role" aria-hidden="true"></i>
                  <p>Project Quotation User Info</p></router-link>
    
              </li>
              <li class="nav-item">
               
                  <router-link class="nav-link" :to="{ name: 'retailuserinfo'}"><img src="/icons/barcode.svg"  class="sub nav-icon svg-role" aria-hidden="true">
                  <p>Retail Quotation User Info</p></router-link>
    
              </li>
              <li class="nav-item">
               
                  <router-link class="nav-link" :to="{ name: 'projectplinfo'}"><img src="/icons/draft.svg"  class="sub nav-icon svg-role" aria-hidden="true">
                  <p>Project Quotation PL Info</p></router-link>
    
              </li>
              <li class="nav-item">
               
                  <router-link class="nav-link" :to="{ name: 'retailplinfo'}" ><img  src="/icons/plus.svg"  class="sub nav-icon svg-role" aria-hidden="true">
                  <p>Retail Quotation PL Info</p></router-link>
    
              </li>
            </ul>
        </li>
          <!--  -->

          <li class="nav-item">
            <a class="nav-link" @click="logout">
              <img src="/icons/logout.svg" class="nav-icon svg-role" >
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

 
  

  <!-- Main Footer -->
</div>
<!-- ./wrapper -->
   </body>
</div>
</template>

<script>
import constants from '../../constant.js'
export default {
      data(){
        return{
          image_src: '/logo.jpg',
          user:'',
          users1:'',
          dashname:'',
          users:'',
          customer:'',
          roles:'',
          roleadd:'',
          rolelist:'',
          active_el:1,
          role_icon:'',
          user_icon:'',
          user_add_icon:'',
          user_list_icon:'',
          customer_icon:'',
          customer_add_icon:'',
          customer_list_icon:'',
          role:''

        }
         
    },
    mounted(){
    this.dashname = constants.dashname,
    this.users = constants.user,
    this.customer = constants.customer,
    this.roles = constants.roles,
    this.roleadd = constants.roleadd,
    this.rolelist = constants.rolelist,
    this.role_icon = constants.role_icon,
    this.user_icon = constants.user_icon,
    this.user_add_icon = constants.user_add_icon,
    this.user_list_icon = constants.user_list_icon,
    this.customer_icon= constants.customer_icon,
    this.customer_add_icon = constants.customer_add_icon,
    this.customer_list_icon = constants.customer_list_icon

},
methods:{
    activate:function(el){
this.active_el = el;
},
 getRecord() {
        var app=this;
       this.$http({
                url: `users/`+localStorage.getItem('id'),
                method: 'GET',
                })
                .then((res) => {
                app.users1= res.data.user;   
              app.role = app.users1.role.display_name;
                   
                app.user="/uploads/"+app.users1.profile_picture;
      
                }, () => {
                this.has_error = true
                }); 
     } ,

     logout() {
      let currentObj=this;
    localStorage.removeItem('id');
    localStorage.removeItem('laravel-vue-spa');
    this.$router.push({name:'login'});
    currentObj.$toasted.success('You logout successfully');
     }
     

},
created() {
  this.getRecord();
  
}
}
</script>

<style scoped>
/deep/.user-panel {
    border-bottom: 0px;
}

.dropdown-toggle::after {
display: block;
margin-top: -25px;
margin-left: 200px;
transform: translateY(-50%);
}
.dropdown-menu {
   
    top: 100%;
    left:-170px;
    z-index: 1000;
    min-width: 10rem;
    padding: 0.5rem 0;
    margin: 0.125rem 0 0;
    font-size: 0.9rem;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 0.25rem;
}
a{
  color: black;
  text-decoration:none;
}
.nav:after, .nav:before {
    display: table;
    content: " ";
}
nav:before {
    display: table;
    content: " ";
}
.profile-img {
    height: 50px;
    width: 50px;
    float: left;
    border-radius: 50%;
    margin: 7px;
    border: 0;
     color: #777;
    
}
.pro-li {
    padding: 0;
    overflow: hidden;
    margin: 2px 0;
     color: #777;
}
.profile-body {
    padding-left: 10px;
     color: #777;
}
h5 {
    float: left;
    margin-bottom: 5px;
    margin-top: 14px;
    font-size: 14px;
    font-family: inherit;
    font-weight: 500;
    line-height: 1.1;
    margin-left: 2px;
    color: inherit;
    text-shadow: rgba(0,0,0,.15) 0 0 1px;
     color: #777;
}
 h6 {
    margin-top: 0;
    font-weight: 200;
    width: 115px;
    text-overflow: ellipsis;
    overflow: hidden;
    font-size: 12px;
    float: left;
    text-shadow: rgba(0,0,0,.15) 0 0 1px;
    margin-bottom: 10px;
     color: #777;
}
.class-full-of-rum{
    padding: 0 5px;
    margin: 2px 15px;
     color: #777;
}
.divider {
    margin-top: 20px;
    background-color: #f1f1f1;
    margin: 6px 0
}
.aa {
  display: block;
    padding: 10px 5px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #777;
    white-space: nowrap;
    text-align: left;
    transition: color .3s ease;
    border-radius: 3px;
    cursor: pointer;
}
.i {
    position: relative;
    top: 2px;
     color: #777;
}
.btn-danger {
      padding: 4px 70px;
      background: #fa2a00;
}
.svg-role{
  filter: invert(73%);
  height: 22px;
  cursor: pointer;
}
.svg-role:hover {
  filter: invert(1);
  cursor: pointer;
}
p:hover {
  color: white;
}
.sub {
  height:20px;
}
li {
  
}
</style>