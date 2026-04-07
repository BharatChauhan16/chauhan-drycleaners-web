import { createRouter, createWebHistory } from 'vue-router'
import MainLayout from '../layouts/MainLayout.vue'

const routes = [
  {
    path: '/',
    component: MainLayout,   // ← wraps all children
    children: [
      { path: '', name: 'home', component: () => import('../pages/HomePage.vue') },
      { path: 'services', name: 'services', component: () => import('../pages/ServicesPage.vue') },
      { path: 'about', name: 'about', component: () => import('../pages/AboutPage.vue') },
      { path: 'contact', name: 'contact', component: () => import('../pages/ContactPage.vue') },
      { path: 'booking', name: 'booking', component: () => import('../pages/BookingPage.vue') },
      { path: ':pathMatch(.*)*', name: 'not-found', component: () => import('../pages/NotFoundPage.vue') },
    ]
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) return savedPosition
    return { top: 0, behavior: 'smooth' }
  }
})

export default router