<template>
   
      <div>
      <navbar></navbar>
      <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid" >
           <div class="row" v-if="$auth.check(1) || $auth.check(2)">
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">TOTAL QUOTATIONS</span>
                <router-link :to="{name:'projectquotation'}"><span class="info-box-number">{{count[0]}}</span></router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
      
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-clock"></i></span>

                       
              <div class="info-box-content">
                <span class="info-box-text">PENDING QUOTATIONS</span>
                   <router-link :to="{name:'projectquotation'}">  <span class="info-box-number">{{count[1]}}</span>
                  </router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
         
          <!-- /.col -->
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-check" style="color:white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">APPROVED QUOTATIONS</span>
                <router-link :to="{name:'projectquotation'}"><span class="info-box-number">{{count[2]}}</span></router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">USERS</span>
                <router-link :to="{name:'userlist'}"><span class="info-box-number">{{count[3]}}</span></router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <!-- /.col -->
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-secondary"><i class="fas fa-users" style="color:white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">CUSTOMERS</span>
                <router-link :to="{name:'customerlist'}"><span class="info-box-number">{{count[4]}}</span></router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <!-- /.col -->
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-primary"><i class="fas fa-box" style="color:white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">MATERIALS</span>
                <router-link :to="{name:'productlist'}"><span class="info-box-number">{{count[5]}}</span></router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

         <div class="row">
          <div class="col-md-4 col-sm-6 col-12" v-if="$auth.check(10) || $auth.check(9) || $auth.check(8) || $auth.check(7)">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-clock"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">PENDING QUOTATIONS</span>
                <router-link :to="{name:'projectquotation'}"><span class="info-box-number">{{count[1]}}</span></router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-6 col-12" v-if="$auth.check(4) || $auth.check(5) || $auth.check(6) || $auth.check(3)">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-drafting-compass"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">DRAFTED QUOTATIONS</span>
                <router-link :to="{name:'draftquotation'}"><span class="info-box-number">{{count[6]}}</span></router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-6 col-12" v-if="$auth.check(10) || $auth.check(9) || $auth.check(8) || $auth.check(7) || $auth.check(6) || $auth.check(5) || $auth.check(4) || $auth.check(3)">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-check" style="color:white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">APPROVED QUOTATIONS</span>
                <router-link :to="{name:'projectquotation'}"><span class="info-box-number">{{count[2]}}</span></router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
         
         
          <div class="col-md-4 col-sm-6 col-12" v-if="$auth.check(10) || $auth.check(9) || $auth.check(8) || $auth.check(7) || $auth.check(6) || $auth.check(5) || $auth.check(4) || $auth.check(3)">
            <div class="info-box">
              <span class="info-box-icon bg-primary"><i class="fas fa-box" style="color:white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">MATERIALS</span>
                <router-link :to="{name:'productlist'}"><span class="info-box-number">{{count[5]}}</span></router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <line-chart v-if="loaded" :datacollection="datacollection"
      :options="options"></line-chart>
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
         count:{},
         loaded:false,
         datacollection: {
//Data to be represented on x-axis
labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
datasets: [
{
label: 'Pending',
backgroundColor: '#cbd1d6',
pointBackgroundColor: 'white',
borderWidth: 1,
pointBorderColor: 'white',
//Data to be represented on y-axis
data: [0,0,0,0,0,0,0,0,0,0,0,0]
},
{
label: 'total',
backgroundColor: '#9ab6d4',
pointBackgroundColor: 'white',
borderWidth: 1,
pointBorderColor: 'white',
//Data to be represented on y-axis
data: [0,0,0,0,0,0,0,0,0,0,0,0]
},
]
},
//Chart.js options that controls the appearance of the chart
options: {
scales: {
yAxes: [{
ticks: {
beginAtZero: true
},
gridLines: {
display: true
}
}],
xAxes: [ {
gridLines: {
display: true
}
}]
},
legend: {
display: true
},
responsive: true,
maintainAspectRatio: false
}
      }
    },
    methods:{
      countData() {
         var app=this;
         this.$http({
                url: `countdata`,
                method: 'GET',
                })
                .then((res) => {
                app.count = res.data; 
                //console.log(app.count)   

      
                }, () => {
                app.has_error = true
                }); 
      },
      setData(){
    var app=this;
         this.$http({
                url: `countgraph`,
                method: 'GET',
                })
                .then((res) => {
                app.result = res.data; 
                app.loaded=true;
                //console.log(res);
                $.each(app.result.pending,function(index, value) {
                   app.datacollection.datasets[0].data[value.month-1]= value.count;
                }); 
                $.each(app.result.total,function(index, value) {
                    app.datacollection.datasets[1].data[value.month-1]= value.count;
                });
                app.loaded=true;
                console.log(app.loaded)
                }, () => {
                app.has_error = true
                }); 
}
    },
    created() {
     this.countData();
    },
    mounted(){
      this.setData();
    }
  }
</script>
