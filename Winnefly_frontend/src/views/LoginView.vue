<script setup lang="ts">
import { ref } from 'vue'
import { useRouter, RouterLink } from 'vue-router'
import { useAuthStore } from '@/stores/authStore'

const authStore = useAuthStore()
const router = useRouter()

const form = ref({
  email: '',
  password: '',
})

async function submitLogin() {
  try {
    await authStore.login(form.value)
    router.push('/profile')
  } catch (error) {
    alert('Login gagal')
    console.error(error)
  }
}
</script>

<template>
  <main class="min-h-screen bg-[#FDF8F0] flex items-center justify-center px-6">
    <form @submit.prevent="submitLogin" class="w-full max-w-md border border-[#D8C3A5] rounded-2xl p-8">
      <h1 class="text-3xl font-bold mb-6 text-[#4A2E2B]">Login</h1>

      <input v-model="form.email" type="email" placeholder="Email" class="auth-input" />
      <input v-model="form.password" type="password" placeholder="Password" class="auth-input" />

      <button class="w-full bg-[#4E8BB7] text-white py-3 rounded-xl mt-4">
        Login
      </button>

      <p class="mt-4 text-center">
        Belum punya akun?
        <RouterLink to="/register" class="text-[#4E8BB7]">Register</RouterLink>
      </p>
    </form>
  </main>
</template>

<style scoped>
.auth-input {
  width: 100%;
  border: 1px solid #D8C3A5;
  padding: 12px 16px;
  border-radius: 12px;
  margin-bottom: 14px;
  background: transparent;
}
</style>