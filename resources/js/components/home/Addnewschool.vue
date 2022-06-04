
<template>
    <div>

       <div class="container">
          <div class="row">

      <router-link class="btn btn-info" to="/">عوده </router-link>

          </div>
        </div>
<hr>

<div class="container">

   <div class="btn btn-success form-control " v-if="success" > تم حفظ المدرسة بنجاح</div>

<form action="/saveschool" enctype="multipart/form-data">

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
      <input type="file" ref="photo" @change="setphoto" name="photo[]"  accept="image/png, image/gif, image/jpeg"
                class="form-control" id=" ">
    </div>
  </div>
 
  
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" @click="saveschool" class="btn btn-primary">اضافة</button>
    </div>
  </div>
</form>

<!-- 
 upload_avatar(e){
              let file = e.target.files[0];
                let reader = new FileReader();  

                if(file['size'] < 2111775)
                {
                    reader.onloadend = (file) => {
                    //console.log('RESULT', reader.result)
                     this.form.avatar = reader.result;
                    }              
                     reader.readAsDataURL(file);
                }else{
                    alert('File size can not be bigger than 2 MB')
                }
            }, -->


    
</div>

    </div>
</template>


<script>
export default {
    data(){
        return{
              school:{
                   myid:'',
                   name:'',
                   email:'',
                   address:'',
                   type:'',
                   about:'',
                   photo:[],
              },
              errors:[],
              success:false,
              

        }
    },
    methods:{
      setphoto(e){
              for (let i = 0; i < this.$refs.photo.files.length; i++) {
              this.school.photo.push(this.$refs.photo.files[i]);
      }
          },
         saveschool(e){
           e.preventDefault();
           let that = this;
           this.errors='';
           let schoolform= new FormData;
           schoolform.append('myid',this.school.myid); 
           schoolform.append('name',this.school.name); 
           schoolform.append('email',this.school.email); 
           schoolform.append('address',this.school.address); 
           schoolform.append('type',this.school.type);
           schoolform.append('about',this.school.about); 
          //  schoolform.append('photo',this.school.photo);
           for (let w = 0; w < this.school.photo.length; w++) {
            let file = that.school.photo[w];
               schoolform.append("photo[" + w + "]", file);
             } 
 
             
           axios.post('api/saveschool',schoolform)
          .then(res=>{
              //  console.log(res.data.data)
             if(res.data.status=='errors')
                  {this.errors=res.data.data}else{
                   console.log('saved successfully');
                 // console.log(res.data.data)
                   this.success=true;
              setTimeout(function(){
               this.success=false;
              that.$router.push("/");
             },5000)
           };
         })         

         },
         
          


    },
    created(){
        window.axios.defaults.headers.common['Authorization'] = `Bearer `+localStorage.getItem('token');
        axios.get('api/user/').then((response)=>{
            this.school.myid = response.data.id

            // console.log(this.user);
        }).catch((errors)=>{
            console.log(errors)
        });
    }


}
</script>