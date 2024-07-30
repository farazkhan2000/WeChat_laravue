<template>
  <div>
    <div class="relative">
      <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>
      </div>
      <input 
        type="search" 
        placeholder="Search contacts..." 
        class="block w-full p-4 ps-10 text-sm border rounded-lg bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
      >
    </div>
    <ul class="mt-3">
      <li v-for="contact in contacts" :key="contact.id" @click="selectContact(contact)" class="rounded-lg hover:bg-slate-950">
        <div class="flex items-center gap-2 py-3 px-3 cursor-pointer">
          <img src="/assets/icons/user.png" class="profile-image rounded-full" alt="profile">
          <div class="flex justify-between items-end w-full ps-2">
            <div>
              <p class="font-medium text-sm text-white">{{ contact.name }}</p>
              <p class="text-xs text-gray-300 truncate mt-1">Hi there...</p>
            </div>
            <div class="">
              <p class="text-xs text-gray-300">12:47 pm</p>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'ChatContacts',
  props: {
    contacts: {
      type: Array,
      required: true
    }
  },
  data () {
    return {
      
    }
  },
  methods: {
    selectContact(contact) {
      this.$emit('selectedContact', contact)
    }
  }
}
</script>

<style scoped>
.profile-image {
  width: 36px;
}
</style>