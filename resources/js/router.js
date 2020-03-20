import VueRouter from 'vue-router'
// Pages
import Home from './pages/Home'
import Register from './pages/Register'
import Login from './pages/Login'
import ForgotEmailSending from './pages/ForgotEmailSending'
import ForgotPassword from './pages/ForgotPassword'
import Dashboard from './pages/user/Dashboard'
import AdminDashboard from './pages/admin/Dashboard'
import Addrole from './pages/admin/Role/Addrole'
import Rolelist from './pages/admin/Role/Rolelist'
import Editrole from './pages/admin/Role/Editrole'
import Viewrole from './pages/admin/Role/Viewrole'
import Adduser from './pages/admin/User/Adduser'
import Userlist from './pages/admin/User/Userlist'
import Viewuser from './pages/admin/User/Viewuser'
import Edituser from './pages/admin/User/Edituser'
import Addcustomer from './pages/admin/Customer/Addcustomer'
import Customerlist from './pages/admin/Customer/Customerlist'
import Viewcustomer from './pages/admin/Customer/Viewcustomer'
import Editcustomer from './pages/admin/Customer/Editcustomer'
import Addproduct from './pages/admin/Product/Addproduct'
import Productlist from './pages/admin/Product/Productlist'
import Viewproduct from './pages/admin/Product/Viewproduct'
import Editproduct from './pages/admin/Product/Editproduct'
import Addquotation from './pages/admin/Quotation/Addquotation'
import Draftquotation from './pages/admin/Quotation/Draftquotation'
import Retailquotation from './pages/admin/Quotation/Retailquotation'
import Projectquotation from './pages/admin/Quotation/Projectquotation'
import Viewquotation from './pages/admin/Quotation/Viewquotation'
import Editquotation from './pages/admin/Quotation/Editquotation'
import Projectuserinfo from './pages/admin/Report/Projectuserinfo'
import Retailuserinfo from './pages/admin/Report/Retailuserinfo'
import Projectplinfo from './pages/admin/Report/Projectplinfo'
import Retailplinfo from './pages/admin/Report/Retailplinfo'



// Routes
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      auth: undefined
    }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      auth: false,
      title:'Geberit'
    }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      auth: false,
      title:'Geberit-Login'
    }
  },
  // USER ROUTES
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: {
      auth: true,
      title:'Geberit-Dashboard'
    }
  },
  
  // ADMIN ROUTES
  {
    path: '/admin',
    name: 'admin.dashboard',
    component: AdminDashboard,
    meta: {
      auth: {roles: [1,2,3,4,5,6,7,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Dashboard'
    }
  },
  {
    path: '/addrole',
    name: 'addrole',
    component: Addrole,
    meta: {
      auth: {roles: [1,4,5,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Add Role'
    }
  },
  {
    path: '/rolelist',
    name: 'rolelist',
    component: Rolelist,
    meta: {
      auth: {roles: [1,2,4,5,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Role List'
    }
  },
  {
    path: '/viewrole/:id',
    name: 'viewrole',
    component: Viewrole,
    meta: {
      auth: {roles: [1,2,4,5,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-View Role'
    }
  },
  {
    path: '/editrole/:id',
    name: 'editrole',
    component: Editrole,
    meta: {
      auth: {roles: [1,2,4,5,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Edit Role'
    }
  },
  {
    path: '/adduser',
    name: 'adduser',
    component: Adduser,
    meta: {
      auth: {roles: [1,2,4,5,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Add User'
    }
  },
  {
    path: '/userlist',
    name: 'userlist',
    component: Userlist,
    meta: {
      auth: {roles: [1,2,4,5,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-User List'
    }
  },
  {
    path: '/viewuser/:id',
    name: 'viewuser',
    component: Viewuser,
    meta: {
      auth: {roles: [1,4,2,5,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-View User'
    }
  },
  {
    path: '/edituser/:id',
    name: 'edituser',
    component: Edituser,
    meta: {
      auth: {roles: [1,2,4,5,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Edit User'
    }
  },
  {
    path: '/addcustomer',
    name: 'addcustomer',
    component: Addcustomer,
    meta: {
      auth: {roles: [1,2,4,5,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Add Customer'
    }
  },
  {
    path: '/customerlist',
    name: 'customerlist',
    component: Customerlist,
    meta: {
      auth: {roles: [1,2,4,5,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Customer List'
    }
  },
  {
    path: '/viewcustomer/:id',
    name: 'viewcustomer',
    component: Viewcustomer,
    meta: {
      auth: {roles: [1,2,4,5,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-View Customer'
    }
  },
  {
    path: '/editcustomer/:id',
    name: 'editcustomer',
    component: Editcustomer,
    meta: {
      auth: {roles: [1,2,4,5,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Edit Customer'
    }
  },
  {
    path: '/addproduct',
    name: 'addproduct',
    component: Addproduct,
    meta: {
      auth: {roles: [1,2], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Add Product'
    }
  },
  {
    path: '/productlist',
    name: 'productlist',
    component: Productlist,
    meta: {
      auth: {roles: [1,2,3,4,5,6,7,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Product List'
    }
  },
  {
    path: '/viewproduct/:id',
    name: 'viewproduct',
    component: Viewproduct,
    meta: {
      auth: {roles: [1,2,3,4,5,6,7,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-View Product'
    }
  },
  {
    path: '/editproduct/:id',
    name: 'editproduct',
    component: Editproduct,
    meta: {
      auth: {roles: [1,2], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Edit Product'
    }
  },
  {
    path: '/addquotation',
    name: 'addquotation',
    component: Addquotation,
    meta: {
      auth: {roles: [1,3,4,5,6], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Add Quotation'
    }
  },
  {
    path: '/projectquotation',
    name: 'projectquotation',
    component: Projectquotation,
    meta: {
      auth: {roles: [1,2,3,4,5,6,7,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Project Quotation List'
    }
  },
  {
    path: '/draftquotation',
    name: 'draftquotation',
    component: Draftquotation,
    meta: {
      auth: {roles: [1,3,4,5,6], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Drafted Quotation List'
    }
  },
  {
    path: '/retailquotation',
    name: 'retailquotation',
    component: Retailquotation,
    meta: {
      auth: {roles: [1,2,3,4,5,6,7,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Retail Quotation List'
    }
  },
  {
    path: '/viewquotation/:id/:ref_no',
    name: 'viewquotation',
    component: Viewquotation,
    meta: {
      auth: {roles: [1,2,3,4,5,6,7,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-View Quotation'
    }
  },
  {
    path: '/editquotation/:id',
    name: 'editquotation',
    component: Editquotation,
    meta: {
      auth: {roles: [1,2,3,4,5,6,7,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Edit Quotation'
    }
  },
  {
    path: '/projectquotation/userinfo',
    name: 'projectuserinfo',
    component: Projectuserinfo,
    meta: {
      auth: {roles: [1,2,3,4,5,6,7,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Project User Report'
    }
  },
  {
    path: '/retailquotation/userinfo',
    name: 'retailuserinfo',
    component: Retailuserinfo,
    meta: {
      auth: {roles: [1,2,3,4,5,6,7,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Retail User Report'
    }
  },
  {
    path: '/projectquotation/plinfo',
    name: 'projectplinfo',
    component: Projectplinfo,
    meta: {
      auth: {roles: [1,2,3,4,5,6,7,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Project PL Report'
    }
  },
  {
    path: '/projectquotation/userinfo',
    name: 'retailplinfo',
    component: Retailplinfo,
    meta: {
      auth: {roles: [1,2,3,4,5,6,7,8,9,10], redirect: {name: 'login'}, forbiddenRedirect: '/403'},
      title:'Geberit-Retail PL Report'
    }
  },
  {
    path: '/forgotpassword',
    name: 'forgotpassword',
    component: ForgotEmailSending,
    meta: {
      auth: false,
      title:'Geberit-Reset Password Email Sending'
    }
  },
  {
    path: '/forgotpassword/:token',
    name: 'forgotpassword',
    component: ForgotPassword,
    meta: {
      auth: false,
      title:'Geberit-Reset Password'
    }
  },
  
  
]
const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})
export default router