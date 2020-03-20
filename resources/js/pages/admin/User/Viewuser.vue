
<template>
<div>
<navbar></navbar>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid" style="min-height:100vh">
<div class="row">
<div class="col-md-4">
    <h2><img src="/icons/view.svg" style="height: 39px; width: 57px;">User Details:{{tasks['name']}}  </h2>
</div>
    <div class="ml-auto" style="margin-right: 8px;">
        <router-link :to="{name:'userlist'}" class="btn btn-warning" style="color:white"><i class="fa fa-arrow-left" style="color:white"></i>&nbsp;Return to list</router-link>
        &nbsp;&nbsp;<router-link :to="{name:'edituser'}" class="btn btn-primary"><i class="fa fa-edit" style="color:white"></i>&nbsp;Edit</router-link>&nbsp;
        <button style="color:white" class="btn btn-danger" v-if="tasks.status==='Active'"  @click="active('Deactive',tasks.id)"><i  class="fa fa-times faa" style="color:white"></i>&nbsp;Deactive</button>
         <button style="color:white" class="btn btn-success" v-else @click="active('Active',tasks.id)"><i class="fa fa-check faa" style="color:white" ></i>&nbsp;Active</button>
    </div>
</div><br>
<div class="card">
    <div class="card-body">
<div class="row">
    <div class="col-md-3">
        <div class="card" >
            <div class="card-body" >
        <div class="row">
            <div class="col-md-6"><img :src= url+tasks.profile_picture class="thumb"></div>
       </div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
<div class="col-lg-4">
<div class="card-heading">
    <h3 class="card-title"><i class="fa fa-user"></i>&nbsp;&nbsp;Name</h3>
    <p>{{tasks.saluation}} {{tasks.name}}({{role.name}})</p>

</div>
<br>


<div class="card-heading">
    <h3 class="card-title"><i class="fa fa-phone"></i>&nbsp;&nbsp;Contact</h3>
    <p>{{tasks.contact_number}}</p>
</div>
<br>

<div class="card-heading">
   <h3 class="card-title"><i class="fa fa-globe-asia"></i>&nbsp;&nbsp;Countries</h3>
    <li v-for="(task,index) in tasks.country" :key="index" style="list-style:none;margin-left:28px;">
  {{task}}
   </li>
</div>
<br>
<div class="card-heading">
    <h3 class="card-title"><i class="fa fa-calendar-alt"></i>&nbsp;&nbsp;Created Date</h3>
    <p>{{tasks.created_at}}</p>
</div>
<br>

<div class="card-heading">
     <h3 class="card-title"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Status</h3>
    <p>{{tasks.status}}</p>
   
</div>

</div> 
<div class="col-lg-4">

<div class="card-heading">
    <h3 class="card-title"><i class="fa fa-user"></i>&nbsp;&nbsp;Abbreviation</h3>
    <p>{{tasks.abbreviation}}{{role.name}}</p>
</div>
<br>

<div class="card-heading">
     <h3 class="card-title"><i class="fa fa-envelope"></i>&nbsp;&nbsp;Email</h3>
    <p>{{tasks.email}}</p>
    
</div>
<br>

<div class="card-heading">
   <h3 class="card-title"><i class="fa fa-user-tag"></i>&nbsp;&nbsp;Role</h3>
    <p>{{role.display_name}}({{role.name}})</p>
</div>
<br>

<div class="card-heading">
    <h3 class="card-title"><i class="fa fa-clock"></i>&nbsp;&nbsp;Last Login Time</h3>
    <p>{{tasks.updated_at}}</p>
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
            tasks:[],
            role:[],
            url:'/uploads/',
            country:[],

        }
    },
    methods: {
        getRecord() {
       this.$http({
                url: `users/`+this.$route.params.id,
                method: 'GET',
                })
                .then((res) => {
                this.tasks = res.data.user; 
                this.role = res.data.user.role;    
                }, () => {
                this.has_error = true
                }); 
     } , 
     getUser() {
          var app = this
                this.$http({
                url: `users`,
                method: 'GET',
                })
                .then((res) => {
                this.gridData= res.data.users
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
                this.getRecord();     
                }, () => {
                this.has_error = true
                }); 
     } ,  
    },
    mounted() {
        this.getRecord();
    }
}
</script>

<style scoped>
.thumb {
    padding: 0.25rem;
    background-color: #f8fafc;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    height: 239px;
    width: 230px;
}
h3 {
  color: #76838f;  
}
h2 {
    color: #76838f;
    font-size: 20px;
    font-weight: bold;
}
i{
    color: rgb(55, 110, 180);
}
p {
    color: black;
     margin-left: 28px;
}
li {
   color: black; 

}
.back {
    float: right;
    background: #376eb4;
    color: white
}
</style>








