<template>
    <div>
      
      <div class="container">
          <div class="row">

          <router-link class="btn btn-info col-3" to="/addnewschool"> اضف مدرسة جديده</router-link>

          </div>
        </div>

<hr>

 <div class="container">

   <myschools ></myschools>
  

                    
             
        
    </div>
    </div>
</template>


<script>
import myschools from './Myschools.vue'

export default {
    components:{
       myschools,
    },
     data(){
        return{
               
        }
    },
    methods:{
       
    },
    // mounted(){
    //     window.axios.defaults.headers.common['Authorization'] = `Bearer `+localStorage.getItem('token');
    //     axios.get('api/user/').then((response)=>{
    //         this.user.myid= response.data.id
    //     }).catch((errors)=>{
    //         console.log(errors)
    //     });
        
    // },
    // created(){
    //           axios.get('api/getschools').then(res=>{
    //               console.log(res.data.data)
    //           })
        

    // },
  
}
</script>