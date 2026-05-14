import { api } from "./api"
import type { Product } from "@/types/product"

export const getProducts = async () => {
  const res = await api.get<{ data: any[] }>("/products")

  return res.data.data.map((item: any) => ({
    id: item.data.id,
    name: item.data.attributes.name,
    price: item.data.attributes.price,
    description: item.data.attributes.description,
    image: item.data.attributes.image_url,
    stock: item.data.attributes.stock,
    category: item.data.attributes.category,
  }))
}

export const getProductById = async (id: number) => {
  const res = await api.get(`/products/${id}`)

  const item = res.data.data

  return {
    id: item.id,
    name: item.attributes.name,
    price: Number(item.attributes.price),
    description: item.attributes.description,
    image: item.attributes.image_url,
    stock: item.attributes.stock,
    category: item.attributes.category,
    created_at: item.attributes.created_at,
    updated_at: item.attributes.updated_at,
  }
}