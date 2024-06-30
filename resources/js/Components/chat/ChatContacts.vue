<template>
  <div>
    <input 
      type="text" 
      placeholder="Search contacts..." 
      class="w-11/12 bg-slate-100 rounded-lg border-0 p-3 mx-2 mt-4 mb-2 text-sm focus:outline-none"
    >
    <ul class="mx-2">
      <li v-for="contact in contacts" :key="contact.id" @click="selectContact(contact)" class="hover:bg-gray-100">
        <div class="flex items-center gap-2 py-3 px-3 cursor-pointer">
          <img src="/assets/icons/user.png" class="profile-image rounded-full" alt="profile">
          <div class="flex justify-between items-center w-full">
            <div>
              <p class="font-medium text-sm text-gray-700 ">{{ contact.name }}</p>
              <p class="text-xs text-gray-500 truncate">Hi there...</p>
            </div>
            <div class="flex items-center">
              <p class="text-xs text-gray-400">12:47 pm</p>
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