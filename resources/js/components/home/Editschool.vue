

<template>
    <div>

       <div class="container">
          <div class="row">

      <router-link class="btn btn-info" to="/">عوده </router-link>

          </div>
        </div>
<hr>

<div class="container">

   <div class="btn btn-success form-control " v-if="success" >  تم تحديث بيانات المدرسة بنجاح</div>

<form action="/updateschool" enctype="multipart/form-data">

  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label"> اسم المدرسة</label>
    <div class="col-sm-10">
      <input type="text" v-model="school.name" required class="form-control" id="" placeholder="ادخل اسم المدرسة  ">
          <span style="color:red" v-if="errors.name">{{errors.name[0]}}</span>
    </div>
  </div>
  
   <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label"> ايميل المدرسة </label>
    <div class="col-sm-10">
      <input type="email"  v-model="school.email" class="form-control" id="" placeholder="ادخل ايميل المدرسة ">
    </div>
  </div>

   <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label"> عنوان المدرسة </label>
    <div class="col-sm-10">
      <input type="text"  v-model="school.address" required class="form-control" id="" placeholder="ادخل عنوان المدرسة  ">
    </div>
  </div>

   <div class="form-group row">
    <label  class="col-sm-2 col-form-label"> نوع المدرسة  </label>
         <div class="col-sm-10">
                  <select class="form-control"  v-model="school.type">
                    <option disabled>اختر نوع  المدرسة</option>
                    <option value="3">بنين و بنات</option>
                    <option value="1">بنين</option>
                    <option value="2">بنات</option>
                 </select>    
        </div>
  </div>


   <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label"> عن المدرسة </label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control"  v-model="school.about" id="" placeholder="نبذه عن المدرسة "></textarea>
    </div>
  </div>

   <div class="form-group row">
    <label  class="col-sm-2 col-form-label"> صورة للمدرسة  </label>
    <div class="col-sm-10">
      <input type="file" ref="image" @change="setphoto" name="image[]"  accept="image/png, image/gif, image/jpeg"
                class="form-control" id=" ">
    </div>
  </div>
 
  
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" @click="updateschool" class="btn btn-primary"> حفظ التعديل</button>
    </div>
  </div>
</form>




</div>

    </div>
</template>


<script>
export default {
    data(){
        return{
              school:{
                  id:'',
                   myid:'',
                   name:'',
                   email:'',
                   address:'',
                   type:'',
                   about:'',
                   image:[],
              },
              errors:[],
              success:false,
              sid:this.$route.params.id,
              myid:this.$store.state.user.id,
              _token:'{{csrf_token()}}',
              
              
              

        }
    },
    methods:{
      setphoto(e){
              this.school.image=[this.$refs.image.files[0]];
              // console.log(this.school.image)
          },
         updateschool(e){
           e.preventDefault();
           let that = this;
           this.errors='';
           let schoolform= new FormData;
           schoolform.append('id',this.sid); 
          //  schoolform.append('_token',this._token); 
           schoolform.append('myid',this.myid); 
           schoolform.append('name',this.school.name); 
           schoolform.append('email',this.school.email); 
           schoolform.append('address',this.school.address); 
           schoolform.append('type',this.school.type);
           schoolform.append('about',this.school.about); 
          //  schoolform.append('photo',this.school.photo);
            let file = this.school.image;
            if(this.school.image!=''){
               schoolform.append("image",this.school.image[0]);
            }
                      console.log(file);
 
             
           axios.post('/api/updateschool',schoolform)
          .then((response)=>{
               console.log(response.data.data)
             if(response.data.status=='errors')
                  {this.errors=response.data.data}else{
                   console.log('updated successfully');
               console.log(response.data.data)
                   this.success=true;
              setTimeout(function(){
               that.success=false;
              // that.$router.push("/");
             },5000)
           };
         })         

         },

         
          


    },
        created(){
              setTimeout(() => {
                 axios.post('/api/getthisschool',{'myid':this.myid,'sid':this.sid})
                 .then(res=>{
                  this.school=res.data.data;
                  this.school.image='';
                  console.log(res.data.data)
                    })     
                  }, 2000);
                       }


}
</script>