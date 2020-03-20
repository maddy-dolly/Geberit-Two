<template>
    
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
             
          <div class="modal-header">
            <slot name="header">
             
                
              <h2>Reason</h2>
                  <svg @click="$emit('close')" aria-hidden="true" class="svg-icon iconClearSm" fill="grey" width="14" height="14" viewBox="0 0 14 14"><path d="M12 3.41L10.59 2 7 5.59 3.41 2 2 3.41 5.59 7 2 10.59 3.41 12 7 8.41 10.59 12 12 10.59 8.41 7 12 3.41z"></path></svg>
            </slot>
          </div>

          <div class="modal-body">
           
            <slot name="body">
           
        <form autocomplete="off" @submit.prevent="rejectQuotation" method="post">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group" >
                    <input type="text" id="name" class="form-control" v-model.trim="$v.reason.$model" :class="{'is-invalid' :$v.reason.$error, 'is-valid' :!$v.reason.$invalid}">
                    <div class="invalid-feedback">
                    <span v-if="!$v.reason.required" style="color:red"><sup>*</sup>Reason is required</span>
                    </div>
                </div>
                 
            </div>
        </div>
        <div class="row">
            <div class="col-md-8"></div>
        <div class="ml-auto">
         <button class="btn btn-primary" style="margin-left:-20%" @click="$v.reason.$touch">submit</button>
        </div> 
        </div>
        </form>
      
       
                      
            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>

</template>
<script>
import { required, minLength, maxLength, between, email } from 'vuelidate/lib/validators'
export default {
  props:["id"],
    data() {
      return {
        qid:this.id,
        reason:'',
        show:false,
        has_error: false,
        tags: null,
        name:sessionStorage.name,
        status:false,
        approved_user_id:localStorage.getItem('id'),

      }
    },
     validations: {
            reason:{ 
            required,
            }
     },
    mounted() {
     
    },
    
    methods: {
         rejectQuotation() {
                    if (this.$v.$invalid) { 
                    this.$toasted.error('Please fill the reason field'); 

                    }
                    else {
                    let app =this;
                    let formData = new FormData();
                    formData.append('reason',app.reason),
                    formData.append('last_updated_by',app.approved_user_id),
                    this.$http.post ( 'rejectquotation/'+this.qid, formData ).then(function (res) {
                    if (res.data.status=="success"){
                    app.$toasted.success('Reason updated successfully'); 
                    }
                    else {
                    app.$toasted.error('somthing went wrong');

                    } 
                     app.$emit('close'); 
                    });
                    }
    },
     
    }
}
</script>
<style scoped>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 400px;
  margin: 0px auto;
  padding-left:10px;
  padding-top: 5px; 
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
  
}

.modal-header  {
  margin-top: 0;
  padding-bottom: 0px;
  border: none !important;
  align-content: center;
  text-align: center;
}

.modal-body {
  /* margin: 10px 0; */
   border: none !important;
   align-content: center;
  text-align: center;
}
.modal-footer {
  /* margin: 10px 0; */
   border: none !important;
}
.closebtn{
    padding-left: 15px;
    padding-bottom: 20px;
}
span{
    font-size: 13px;
    color: grey;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
.userimg{
     height: 100px;
  width: 100px;
}

</style>
