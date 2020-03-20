<template>
<div>
   <body class="hold-transition sidebar-mini">
     <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background: #376eb4;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars" style="color:white"></i></a>
            </li>
            </ul>
         <ul class="nav navbar-nav ml-auto">
                <li class="dropdown">
                    <a href="#" class="" data-toggle="dropdown">
                        <img src="user.png" class="img-circle" alt="User Image" height="30px" width="30px">
                        <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                            <img :src=" image_src" class="img-thumbnail" >
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong class="log_name"></strong></p>
                                        <p class="text-left small log_email"></p>
                                        <p class="text-left">
                                          <a class="nav-link log" style="color:black;font-weight:bold;padding-left:90px;">LOGOUT&nbsp;<i class="fa fa-sign-out" style="color:black"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                        </li>
                      
        </ul>
                </li>
        </ul>
  </nav>

        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <div style="text-align:center;background:white">
             <img :src="image_src" alt="AdminLTE Logo" class="" style="opacity: .8" height="55px" width="130px">
            </div>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="user.png" class="img-circle" alt="User Image" height="50px" width="50px">
        </div>
        <div class="info">
          <router-link :to="{name:''}" class="" style="color:white;font-weight:bold">Developer</router-link>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <li class="nav-item">
            <router-link :to="{name:'na'}"  class="nav-link">
              <i class="nav-icon fa fa-tachometer" ></i>
              <p>{{this.dashname}}</p>
            </router-link>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                {{this.users}}
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Flot</p>
                </a>
              </li>
        </ul>
          </li>
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                {{this.customer}}
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Flot</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inline</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                {{this.roles}}
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link  :to="{name:'addrole'}" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>{{this.roleadd}}</p>
                </router-link>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="fa fa-list nav-icon"></i>
                  <p>{{this.rolelist}}</p>
                </a>
              </li>
            </ul>
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
          image_src: 'geberit-logo.svg',
          dashname:'',
          users:'',
          customer:'',
          roles:'',
          roleadd:'',
          rolelist:''

        }
         
    },
    mounted(){
    this.dashname = constants.dashname,
    this.users = constants.user,
    this.customer = constants.customer,
    this.roles = constants.roles,
    this.roleadd = constants.roleadd,
    this.rolelist = constants.rolelist

},
}
</script>

<style scoped>
/deep/.user-panel {
    border-bottom: 0px;
}
</style>