<template>
  <ul>
    <li v-for="contact in contacts" :key="contact.id">
      <div class="flex items-center gap-2 py-2 px-5 cursor-pointer hover:bg-gray-100 ">
        <img src="/assets/icons/user.png" class="profile-image" alt="profile">
        <div>
          <span class="font-semibold ">{{ contact.name }}</span>
        </div>
      </div>
    </li>
  </ul>
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
    
  },
  methods: {

  }
}
</script>

<style scoped>
.profile-image {
  width: 24px;
}
</style>