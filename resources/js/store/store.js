import Vue  from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
// Create a new store instance.
const store = new Vuex.Store({
  state(){
    return {
      user:'',
    }
  },
  mutations:{
    userauth(state,value){
      state.user=value;
    }
  },
   
})

export default store