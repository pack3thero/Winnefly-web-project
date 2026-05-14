import { defineStore } from "pinia";
import { ref } from "vue";
import { api } from "@/services/api";
import { useCartStore } from "./cartStore";

export const useAuthStore = defineStore('auth', () => {
    const token = ref(localStorage.getItem('token'))
    const user = ref(JSON.parse(localStorage.getItem('user') || 'null'))

    async function register(payload:any) {
        const res = await api.post('/register', payload)

        token.value = res.data.token
        user.value = res.data.user

        localStorage.setItem('token', res.data.token)
        localStorage.setItem('user', JSON.stringify(res.data.user))
    }

    async function login(payload:any) {
        const res = await api.post('/login', payload)

        token.value = res.data.token
        user.value = res.data.user

        localStorage.setItem('token', res.data.token)
        localStorage.setItem('user', JSON.stringify(res.data.user))

        const cartStore = useCartStore()
        cartStore.loadCart()
    }

    async function logout() {
        await api.post('/logout')

        token.value = null
        user.value = null

        localStorage.removeItem('token')
        localStorage.removeItem('user')

        const cartStore = useCartStore()
        cartStore.loadCart()
    }

    return {
        token,
        user,
        register,
        login,
        logout,
    }
})