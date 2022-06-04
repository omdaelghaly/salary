
<template>
  <div class="" >

    <div class="row" style="">



    <div class="card " v-for="(school,index) in schools" :key="index"
    style="width: 25rem; margin-bottom:15px; box-shadow: 5px 10px gray ; margin:auto ; position:relative">
    
    <!-- controllschool edit delete btns -->
    <div style="border-radius:30px 20px;z-index:10;position:absolute;">
    
    <!-- <li class="nav-item dropdown"> -->
        <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        ...
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <router-link :to="{ name: 'editschool', params: { id: school.id } }"  class="dropdown-item">تعديل</router-link>
          <router-link to="/eleteschool"   class="dropdown-item">حذف</router-link>
        
        </div>
      <!-- </li> -->

    </div>
    <!-- ----------------- -->
      <img class="card-img-top" @click="gotosalary(school.id)" :src="getschoolimg()" alt="Card image cap"  />
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">
          Some quick example text to build on the card title and make up the
          bulk of the card's content.
        </p>
      </div>

      <ul class="list-group list-group-flush">
        <li class="list-group-item">Cras justo odio</li>
        <li class="list-group-item">Dapibus ac facilisis in</li>
        <li class="list-group-item">Vestibulum at eros</li>
      </ul>

      <div class="card-body">
        <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a>
      </div>
    </div>



    </div>

<!-- ++++++++++ {{myid}}++++++
++++++++++ {{schools}}++++++ -->
+++{{$store.state.user.id}}={{myid}}=
+++{{$store.state.user.email}}

  </div>
</template>

<script>
export default {
  data() {
    return {
             myid:'',
             schools:'',
                
            };
  },
  methods: {
       
        

       getschoolimg() {
         return "images/schools/a.jpg";
        },
       gotosalary(sid){
      // this.$store.commit('userauth','gggggggggg')
          this.$router.push('/salary/'+sid)
        }
    

  },
  watch:{
        myid:function(){
              // axios.post('api/getschools',{'myid':this.myid}).then(res=>{
              //     // console.log(res.data.data)
              //      this.schools=res.data.data;

              // });
                                  
        }
  },
    created(){
         
         axios.post('api/getschools',{'myid':this.$store.state.user.id}).then(res=>{
                  // console.log(res.data.data)
                   this.schools=res.data.data;

              });
      // this.myid=this.$store.state.user.id
        //      window.axios.defaults.headers.common['Authorization'] = `Bearer `+localStorage.getItem('token');
        // axios.get('api/user/').then((response)=>{
        //     this.myid= response.data.id
        // }).catch((errors)=>{
        //     console.log(errors)
        // });
        
    },
    


};
</script>