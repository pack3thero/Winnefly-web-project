<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/authStore'
import { UserRound, Pencil, X } from 'lucide-vue-next'

import { Cropper } from 'vue-advanced-cropper'
import 'vue-advanced-cropper/dist/style.css'

const authStore = useAuthStore()
const router = useRouter()

const cropperRef = ref()

const isEditing = ref(false)
const name = ref(authStore.user?.name || '')
const previewImage = ref<string | null>(null)
const selectedImage = ref<File | null>(null)

  const avatar = ref(authStore.user?.avatar || null)

function handleImageChange(event: Event) {
  const target = event.target as HTMLInputElement
  const file = target.files?.[0]

  if (!file) return

  selectedImage.value = file
  previewImage.value = URL.createObjectURL(file)
}

function fileToBase64(file: File): Promise<string> {
  return new Promise((resolve, reject) => {
    const reader = new FileReader()

    reader.onload = () => {
      resolve(reader.result as string)
    }

    reader.onerror = reject

    reader.readAsDataURL(file)
  })
}

function cancelEdit() {
  isEditing.value = false
  name.value = authStore.user?.name || ''
  previewImage.value = null
  selectedImage.value = null
}

async function saveProfile() {
  let croppedFile: File | null = selectedImage.value

  if (cropperRef.value && previewImage.value) {
    const result = cropperRef.value.getResult()
    const canvas = result.canvas

    if (canvas) {
      croppedFile = await new Promise<File>((resolve) => {
        canvas.toBlob((blob: Blob | null) => {
          if (!blob) return

          resolve(
            new File([blob], 'profile-picture.jpg', {
              type: 'image/jpeg',
            })
          )
        }, 'image/jpeg')
      })
    }
  }

  console.log({
    name: name.value,
    image: croppedFile,
  })

  selectedImage.value = croppedFile

    if (croppedFile) {
      previewImage.value = URL.createObjectURL(croppedFile)

      const avatarBase64 = await fileToBase64(croppedFile)

      avatar.value = avatarBase64

      authStore.user = {
        ...authStore.user,
        name: name.value,
        avatar: avatarBase64,
      }
      localStorage.setItem(
        'user',
        JSON.stringify(authStore.user)
      )
    }

  isEditing.value = false
}

async function logout() {
  await authStore.logout()
  router.push('/login')
}
</script>

<template>
  <main class="min-h-screen bg-[#FDF8F0] flex justify-center px-6 py-14 text-[#4A2E2B]">
    <section class="w-full max-w-4xl bg-white/40 border border-[#E3D5C3] rounded-[32px] p-10 shadow-sm">

      <div class="flex justify-between items-start mb-10">
        <div>
          <h1 class="text-3xl font-bold">My Profile</h1>
          <p class="text-sm text-[#8B6B61] mt-1">
            Manage your account information
          </p>
        </div>

        <button
          v-if="!isEditing"
          @click="isEditing = true"
          class="flex items-center gap-2 bg-[#4A2E2B] text-white px-5 py-3 rounded-2xl hover:bg-[#37211f] transition"
        >
          <Pencil class="w-4 h-4" />
          Edit Profile
        </button>

        <button
          v-else
          @click="cancelEdit"
          class="flex items-center gap-2 bg-white border border-[#D8C3A5] text-[#4A2E2B] px-5 py-3 rounded-2xl hover:bg-[#F8EFE5] transition"
        >
          <X class="w-4 h-4" />
          Cancel
        </button>
      </div>

      <div class="flex flex-col items-center text-center">

        <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center shadow-md overflow-hidden">
          <img
            v-if="previewImage || authStore.user?.avatar"
            :src="previewImage || authStore.user?.avatar"
            class="w-full h-full object-cover"
          />

          <UserRound
            v-else
            class="w-14 h-14 text-white"
          />
        </div>

        <div
          v-if="isEditing"
          class="mt-4 w-full max-w-md"
        >
          <label
            class="text-sm text-[#8B6B61] hover:text-[#4A2E2B] cursor-pointer transition"
          >
            Change Profile Picture

            <input
              type="file"
              accept="image/*"
              class="hidden"
              @change="handleImageChange"
            />
          </label>

          <!-- CROPPER -->
          <div
            v-if="previewImage"
            class="mt-6 bg-white border border-[#E8DCCF] rounded-3xl p-4"
          >
            <Cropper
              ref="cropperRef"
              :src="previewImage"
              :stencil-props="{
                aspectRatio: 1
              }"
              class="h-[350px] w-full"
            />
          </div>
        </div>

        <div v-if="authStore.user && !isEditing" class="mt-8 space-y-2">
          <h2 class="text-4xl font-bold">
            {{ authStore.user.name }}
          </h2>

          <p class="text-lg text-[#7A625B]">
            {{ authStore.user.email }}
          </p>
        </div>
      </div>

      <div class="mt-12 border-t border-[#E8DCCF] pt-8">
        <h2 class="text-2xl font-semibold mb-6">
          Account Information
        </h2>

        <div v-if="!isEditing" class="grid gap-5">
          <div class="bg-white/60 rounded-2xl px-5 py-4 border border-[#E8DCCF]">
            <p class="text-sm text-[#8B6B61] mb-1">Full Name</p>
            <p class="font-medium text-lg">{{ authStore.user?.name }}</p>
          </div>

          <div class="bg-white/60 rounded-2xl px-5 py-4 border border-[#E8DCCF]">
            <p class="text-sm text-[#8B6B61] mb-1">Email Address</p>
            <p class="font-medium text-lg">{{ authStore.user?.email }}</p>
          </div>
        </div>

        <form v-else class="grid gap-5" @submit.prevent="saveProfile">
          <div>
            <label class="block text-sm text-[#8B6B61] mb-2">
              Full Name
            </label>

            <input
              v-model="name"
              type="text"
              class="w-full bg-white/70 border border-[#E8DCCF] rounded-2xl px-5 py-4 outline-none focus:border-[#4A2E2B]"
            />
          </div>

          <div>
            <label class="block text-sm text-[#8B6B61] mb-2">
              Email Address
            </label>

            <input
              :value="authStore.user?.email"
              type="email"
              disabled
              class="w-full bg-gray-100 border border-[#E8DCCF] rounded-2xl px-5 py-4 text-gray-500"
            />
          </div>

          <div class="flex justify-end gap-3 mt-4">
            <button
              type="button"
              @click="cancelEdit"
              class="px-6 py-3 rounded-2xl border border-[#D8C3A5] text-[#4A2E2B] hover:bg-[#F8EFE5] transition"
            >
              Cancel
            </button>

            <button
              type="submit"
              class="px-6 py-3 rounded-2xl bg-[#4A2E2B] text-white hover:bg-[#37211f] transition"
            >
              Save Changes
            </button>
          </div>
        </form>
      </div>

      <div v-if="!isEditing" class="mt-20 flex justify-end">
        <button
          @click="logout"
          class="bg-[#4A2E2B] hover:bg-[#37211f] transition text-white px-7 py-3 rounded-2xl font-medium shadow-sm"
        >
          Logout
        </button>
      </div>

    </section>
  </main>
</template>