import HomeComponent from './components/HomeComponent';
import DashboardComponent from './components/DashboardComponent';
import CreateBookComponent from './components/CreateBookComponent';
import ViewBookComponent from './components/ViewBookComponent';
import EditBookComponent from './components/EditBookComponent';
import LoginComponent from './components/LoginComponent';
import RegisterComponent from './components/RegisterComponent';

export const routes = [
    { path: '/', component: HomeComponent},
    { path: '/login', component: LoginComponent,  meta: { requiresGuest: true }},
    { path: '/register', component: RegisterComponent,  meta: { requiresGuest: true }},
    { path: '/dashboard',name:'dashboard', component: DashboardComponent,  meta: { requiresAuth: true }},
    { path: '/dashboard/create', name:'createBook', component: CreateBookComponent,  meta: { requiresAuth: true }},
    { path: '/dashboard/view/:id', name:'viewBook', component: ViewBookComponent,  meta: { requiresAuth: true }},
    { path: '/dashboard/:id/edit',  name:'editBook',component: EditBookComponent,  meta: { requiresAuth: true }},
]
