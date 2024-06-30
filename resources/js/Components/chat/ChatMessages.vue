<template>
  <div class="flex flex-col h-full">
    <div v-if="contact" class="p-4 h-[48px]">
      <h2 class="text-xl font-bold">{{ contact.name }}</h2>
    </div>
    <div v-else class="p-4 h-[48px">
      <p class="text-gray-500">Select a contact to see messages.</p>
    </div>
    
    <div class="flex-1 m-4 py-4 px-2 overflow-y-auto bg-slate-100 rounded-lg relative">
      <div v-for="message in messages" :key="message.id" class="p-2 mb-2 border-b flex gap-3">
        <div class="w-2/5">
          <div class="flex gap-3">
            <img src="/assets/icons/user.png" class="profile-image" alt="profile">
            <div class="bg-white flex items-end gap-4 p-4 rounded-lg">
              <p class="text-gray-700 text-sm ">Lorem ipsum dolor sit amet consectetur adipisicing elit. Id optio nostrum possimus, similique fugiat totam quibusdam dolor quae eaque unde? Quod ut itaque, cupiditate eius ducimus voluptatibus in hic sint dolorum, eveniet quisquam tempore adipisci! Corporis veritatis similique officia totam!</p>  
              <p class="text-xs">{{ message.created_at }}</p>  
            </div>
          </div>
        </div>
      </div>
      <div class="flex items-center p-4 w-full absolute bottom-0 left-0">
        <input 
          v-model="newMessage" 
          @keyup.enter="sendMessage" 
          placeholder="Type a message..." 
          class="flex-1 p-2 border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500  "
        >
        <button 
          @click="sendMessage" 
          class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
        >
          Send
        </button>
      </div>
    </div>
    

  </div>
</template>

<script>
export default {
  name: 'ChatMessages',
  props: {
    messages: {
      type: Array,
      required: true
    },
    contact: {
      type: Object,
      required: false,
      default: null
    }
  },
  data() {
    return {
      newMessage: '' // New message input
    };
  },
  methods: {
    async sendMessage() {
      if (this.newMessage.trim() !== '') {
        try {
          // Make POST request to your backend endpoint
          const response = await axios.post('/api/send-message', {
            to: this.contact.id,
            from: 4,
            message: this.newMessage.trim(), 
          });

          // Assuming your backend responds with the saved message
          this.messages.push(response.data.message);

          // Clear the input field
          this.newMessage = '';
        } catch (error) {
          console.error('Error sending message:', error);
        }
      }
    },
  }
}
</script>

<style scoped>

.profile-image {
  width: 36px;
  height: 36px;
}

</style>
