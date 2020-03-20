<template>
<div>
<navbar></navbar>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid" style="min-height:100vh">
<div class="row">
<div class="col-md-6">
    <h2><img src="/icons/view.svg" style="height: 39px; width: 57px;">Customer Details:{{customer['name']}}  </h2>
</div>
    <div class="ml-auto" style="margin-right: 8px;">
        <router-link :to="{name:'customerlist'}" class="btn btn-warning" style="color:white"><i class="fa fa-arrow-left" style="color:white;"></i>&nbsp;Return to list</router-link>
        &nbsp;&nbsp;<router-link :to="{name:'editcustomer'}" class="btn btn-primary"><i class="fa fa-edit" style="color:white;"></i>&nbsp;Edit</router-link>&nbsp;
        <button class="btn btn-danger"><i class="fa fa-trash faa" @click="deleteCustomer(customer.id)" style="color:white"></i>&nbsp;Delete</button>
    </div>
</div><br> 
<div class="card">
    <div class="card-body">
<div class="row">
    <div class="col-md-4">
        <div class=" card-header">
           <h3>  <i class="fa fa-user"></i>&nbsp;Name</h3>
             <p> {{customer.name}}</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class=" card-header">
            <h3><i class="fa fa-hashtag"></i>&nbsp;Customer Code</h3>
              <p> {{customer.customer_code}}</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class=" card-header">
            <h3><i class="far fa-money-bill-alt"></i>&nbsp;Currency</h3>
             <p>  {{customer.currency}}</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class=" card-header">
            <h3><i class="far fa-file"></i>&nbsp;Payment Terms</h3>
               <p>{{customer.payment_terms}}</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class=" card-header">
            <h3><i class="fa fa-globe-asia"></i>&nbsp;Country</h3>
              <p> {{country}}</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class=" card-header">
            <h3><i class="fa fa-hashtag"></i>&nbsp;Customer Number</h3>
               <p>{{customer.customer_number}}</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class=" card-header">
            <h3><i class="fas fa-location-arrow"></i>&nbsp;Customer Address</h3>
               <p>{{customer.customer_address}}</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class=" card-header">
            <h3><i class="fa fa-calendar-alt"></i>&nbsp;Created date</h3>
              <p> {{customer.created_at}}</p>
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
            customer:[],
            country:''
        }
    },
    methods:{
        getRecord() {
        var app=this;
       this.$http({
                url: `customer/`+this.$route.params.id,
                method: 'GET',
                })
                .then((res) => {
                this.customer= res.data.user;
                 this.country =res.data.user.country.name;
                
                }, () => {
                this.has_error = true
                }); 
     } ,
      deleteCustomer(id) {
         let app = this
       this.$http({
                url: `deletecustomer/`+id,
                method: 'GET',
                })
                .then((res) => {
                app.$toasted.success('Customer deleted successfully');  
                this.getRecord();     
                }, () => {
                this.has_error = true
                }); 
     } ,  
    },

    created() {
        this.getRecord();
    }
}
</script>

<style scoped>
.card-header {
   border-bottom: 0px
}
h2 {
     color: #76838f;
    font-size: 20px;
    font-weight: bold;
}
h3{
     color: #76838f;
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
i{
    color: rgb(55, 110, 180);
}
</style>