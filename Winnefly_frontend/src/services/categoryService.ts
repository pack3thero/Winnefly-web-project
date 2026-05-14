import axios from 'axios'
import type { Category } from '@/types/category'

const api = axios.create({
    baseURL: 'http://localhost:8000/api'
})

export const categoryService = {
    async getAll(): Promise<Category[]> {
        const response = await api.get('/categories')
        return response.data
    }
}