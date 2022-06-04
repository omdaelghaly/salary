import Login from './components/log/Login'
import Register from './components/log/Register'
import Home from './components/home/Home'
import Addnewschool from './components/home/Addnewschool'
import  Editschool from './components/home/Editschool'
import  Salary from './components/salary/Salary'
import  Addemp from './components/salary/Addemp'
import  Editemp from './components/salary/Editemp'

const routes = [
    { path: '/', component: Home  },
    { path: '/login', component: Login},
    { path: '/register', component: Register },
    { path: '/addnewschool', component: Addnewschool  },
    { path: '/editschool/:id', component: Editschool , name:'editschool' },
    { path: '/salary', component: Salary  },
    { path: '/addemp', component: Addemp  },
    { path: '/editemp', component: Editemp  },

  ]


  export default routes;