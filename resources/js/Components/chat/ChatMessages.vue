<template>
  <div v-if="contact" class="flex flex-col h-full ms-5">
    <div class="mb-3">
      <h2 class="text-2xl text-white font-bold mt-1">{{ contact.name }}</h2>
    </div>    
    <div class="flex-1 size-full bg-slate-900 rounded-lg relative">
      <div class="overflow-y-auto h-[60vh] mb-20">
        <div 
          v-for="message in messages" :key="message.id" 
          class="p-4 flex gap-3"
        >
          <div class="w-full">
            <div 
              class="flex gap-3"
              :class="{
                'sent': currentUser.id === message.from,
                'received': currentUser.id !== message.from
              }"
            >
              <img src="/assets/icons/user.png" class="profile-image" alt="profile">
              <div class="flex items-end gap-4 p-4 rounded-lg">
                <p class="message-text">{{ message.message }}</p>  
                <p class="text-sm">{{ formatTime(message.created_at) }}</p>  
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="flex items-center p-4 w-full absolute bottom-0 left-0">      
        <form class="w-full mx-auto" @submit.prevent="sendMessage">   
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" 
                  id="message-input" 
                  class="block w-full p-5 ps-10 text-sm border rounded-lg bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" 
                  placeholder="Type Your Message Here..." 
                  v-model="newMessage"
                  required 
                />
                <button 
                  type="submit" 
                  class="flex items-center px-3 py-1 text-white absolute end-2.5 bottom-2.5 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm bg-blue-600 hover:bg-blue-700 focus:ring-blue-800"
                  @click="sendMessage"
                > 
                  Send Message
                  <svg class="w-8 h-8 ps-2 text-gray-400" viewBox="-2.4 -2.4 28.80 28.80" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> 
                      <path d="M20 4L3 11L10 14M20 4L13 21L10 14M20 4L10 14" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                  </svg>
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <div v-else class="h-full flex items-center justify-center">
    <p class="text-gray-300">Select a contact to see messages.</p>
  </div>
</template>

<script>
import { format } from 'date-fns';

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
      newMessage: '',
      currentUser: null
    };
  },
  mounted() {
    this.fetchCurrentUser();
  },
  methods: {
    async sendMessage() {
      if (this.newMessage.trim() !== '') {
        try {
          // Make POST request to your backend endpoint
          const response = await axios.post('/api/send-message', {
            to: this.contact.id,
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
    async fetchCurrentUser() {
      try {
        const response = await axios.get('/api/user');
        this.currentUser = response.data;
        console.log('Current User:', this.currentUser);
      } catch (error) {
        console.error('Error fetching current user:', error);
      }
    },
    formatTime(dateString) {
      return format(new Date(dateString), 'HH:mm'); // Formats the date as "HH:mm"
    }
  }
}
</script>

<style scoped>

.profile-image {
  width: 36px;
  height: 36px;
}

.sent {
  display: flex;
  flex-direction: row-reverse;
}

.received {
  display: flex;
}

.sent div {
  background-color: #4b5563;
}

.received div {
  background-color: #fff;
}

.sent div .message-text {
  color: #fff;
}

.received div .message-text {
  color: #141414;
}

.overflow-y-auto::-webkit-scrollbar {
  width: 8px;
}

.overflow-y-auto::-webkit-scrollbar-track {
  background: #2d3748; /* Dark background for the track */
  border-radius: 1px;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
  background-color: #4a5568; /* Darker thumb color */
  border-radius: 4px;
  border: 2px solid #2d3748; /* Matches the track background to give it padding */
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
  background-color: #718096; /* Slightly lighter on hover */
}

</style>
