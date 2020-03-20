<template>
<div>
<navbar></navbar>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid" style="min-height:100vh">
<div class="row">
<div class="col-md-4">
    <h2><img src="/icons/view.svg" style="height: 39px; width: 57px;">Role Details:{{tasks['display_name']}}  </h2>
</div>
    <div class="ml-auto" style="margin-right: 8px;">
        <router-link :to="{name:'rolelist'}" class="btn btn-warning" style="color:white"><i class="fa fa-arrow-left"></i>&nbsp;Return to list</router-link>
        &nbsp;&nbsp;<router-link :to="{name:'editrole'}" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp;Edit</router-link>
    </div>
</div><br>
<div class="card">
<div class="card-body">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Name</label><br>
            <p>{{tasks['name']}}</p>
        </div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Display Name</label><br>
            <p>{{tasks['display_name']}}</p>
        </div>
    </div>
 </div>

 <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Discount</label><br>
            <p>{{tasks['discount']}}</p>
        </div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
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
            tasks:[]
        }
    },
    methods: {
        getRecord() {
       this.$http({
                url: `showrole/`+this.$route.params.id,
                method: 'GET',
                })
                .then((res) => {
                this.tasks = res.data.users; 
                this.status = res.data.status
                
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

h2 {
    color: #76838f;
    font-size: 20px;
    font-weight: bold;
}
p {
    color: #76838f;
}
li {
   color: #76838f; 
}
</style>