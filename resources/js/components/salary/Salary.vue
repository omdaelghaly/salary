<template>
    <div>

             <div class="container">
          <div class="row">

       
          <router-link class="btn btn-info col-3" to="/addemp"> اضف موظف جديده</router-link>
             
          </div>
          </div>


<hr>


    </div>
</template>




<script>
export default {
    data(){
        return{
            infoauth:{
                 sid:this.$route.params.id,
                 myid:this.$store.state.user.id,
            }

        }
        
    },
    methods:{


    },
    created(){
             console.log(this.infoauth.sid+'+'+this.infoauth.myid )
            setTimeout(() => {
                 axios.post('/api/getallempsinfo',this.infoauth).then(res=>{
                console.log(res.data.data)
            })
            }, 5000);
           
    }
}
</script>