<template>
    <div>


<div class="container">

<br>

   <div class="btn btn-success form-control " v-if="success" >  تم اضافة موظف بنجاح</div>


 <span class="d-flex justify-content-center bd-highlight "><h3>ادخال بيانات موظف جديد </h3></span>

<hr>
<br>

<form action="/addemp" >

  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label"> اسم الموظف</label>
    <div class="col-sm-10">
      <input type="text" v-model="emp.name" required class="form-control" id="" placeholder="ادخل اسم الموظف  ">
          <span style="color:red" v-if="errors.name">{{errors.name[0]}}</span>
    </div>
  </div>
  
   <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label"> الايميل  </label>
    <div class="col-sm-10">
      <input type="email"  v-model="emp.email" class="form-control" id="" placeholder="ادخل ايميل الموظف  ">
    </div>
  </div>

   <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label"> العنوان </label>
    <div class="col-sm-10">
      <input type="text"  v-model="emp.address"  class="form-control" id="" placeholder="ادخل عنوان الموظف  ">
    </div>
  </div>
 
   <div class="form-group row">
    <label  class="col-sm-2 col-form-label"> مكان العمل </label>
         <div class="col-sm-10">
                  <select class="form-control"   v-model="emp.school_id" >
                    <option disabled>اختر مدرسة</option>
                    <option v-for="sch in school" :key="sch.id" :value="sch.id"> {{sch.name}} </option>
                  
                 </select>    
        </div>
  </div>
   
 <br>
  
  <div class="form-group row">
    <div class="col-sm-10  ">
      <span class="d-flex justify-content-center">
      <button type="submit" @click="addemp" class="btn btn-primary  "> حفظ البيانات  </button>
      </span>
  </div>
  </div>
</form>


  {{$store.state.user.email}}    -{{myid}} -   


</div>

  
    </div>
</template>



<script>
export default {
    data(){
        return{
            emp:{
                school_id:'',
                name:'',
                email:'',
                address:'',
                
            },
            success:false,
            errors:[],
            myid:'',
            school:[],
            sid:'',

        }
        
    },
    methods:{
        addemp(e){
                e.preventDefault();
                let that=this;
                axios.post('api/addemp',this.emp).then(res=>{
                  console.log(res.data.data)
                  if(res.data.status=='errors'){

                  };if(res.data.status=='success'){
                  this.success=true;
                  this.resetinputs();
                  setTimeout(() => {
                   that.success=false;
                    },4000) };
                });
        },
        resetinputs(){
          this.emp.school_id ='';
          this.emp.name ='';
          this.emp.email ='';
          this.emp.address ='';
        }

    },
     created(){
              setTimeout(() => {
                   this.myid=this.$store.state.user.id;
                   axios.get('api/getschoolsinfo/'+this.myid).then(res=>{
                   console.log(res.data.data)
                   this.school=res.data.data;
                    })
                },3000);
          
        }
}
</script>