// src/router/routes.ts
import type { RouteRecordRaw } from 'vue-router'

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    name: 'home',
    component: () => import('@/views/HomeView.vue')
  },
  {
    path: '/about',
    name: 'about',
    component: () => import('@/views/AboutView.vue')
  },
  {
  path: '/product/:id',
  name: 'product-detail',
  component: () => import('@/views/ProductDetailView.vue')
},
  {
    path: '/cart',
    name: 'cart',
    component: () => import('@/views/CartView.vue')
  },
  {
    path: '/menu',
    name: 'menu',
    component: () => import('@/views/MenuView.vue')
},

  {
  path: '/checkout',
  name: 'checkout',
  component: () => import('@/views/CheckoutView.vue')
},
  {
    path: '/payment-success',
    name: 'payment-success',
    component: () => import('@/views/PaymentSuccessView.vue')
  },
  {
    path: '/payment-failed',
    name: 'payment-failed',
    component: () => import('@/views/PaymentFailedView.vue')
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('@/views/LoginView.vue')
  },
  {
    path: '/register',
    name: 'register',
    component: () => import('@/views/RegisterView.vue')
  },
  {
    path: '/profile',
    name: 'profile',
    component: () => import('@/views/ProfileView.vue')
  }
]

export default routes
