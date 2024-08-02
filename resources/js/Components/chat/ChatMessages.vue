<template>
  <div v-if="contact" class="flex flex-col h-full ms-5">
    <div class="mb-3">
      <h2 class="text-2xl text-white font-bold mt-1">{{ contact.name }}</h2>
    </div>    
    <div class="flex-1 size-full bg-slate-900 rounded-lg relative">
      <div class="overflow-y-auto h-[60vh] mb-20" ref="messagesContainer">
        <div 
          v-for="message in messages" :key="message.id" 
          class="p-4 flex gap-3"
        >
          <div class="w-full">
            <div 
              class="flex gap-3"
              :class="{
                'sent': currentUser?.id === message.from,
                'received': currentUser?.id !== message.from
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
                    <svg height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 280.067 280.067" xml:space="preserve" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="1"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> 
                      <path style="fill:#9ca3af;" d="M149.823,257.142c-31.398,30.698-81.882,30.576-113.105-0.429 c-31.214-30.987-31.337-81.129-0.42-112.308l-0.026-0.018L149.841,31.615l14.203-14.098c23.522-23.356,61.65-23.356,85.172,0 s23.522,61.221,0,84.586l-125.19,123.02l-0.044-0.035c-15.428,14.771-40.018,14.666-55.262-0.394 c-15.244-15.069-15.34-39.361-0.394-54.588l-0.044-0.053l13.94-13.756l69.701-68.843l13.931,13.774l-83.632,82.599 c-7.701,7.596-7.701,19.926,0,27.53s20.188,7.604,27.88,0L235.02,87.987l-0.035-0.026l0.473-0.403 c15.682-15.568,15.682-40.823,0-56.39s-41.094-15.568-56.776,0l-0.42,0.473l-0.026-0.018l-14.194,14.089L50.466,158.485 c-23.522,23.356-23.522,61.221,0,84.577s61.659,23.356,85.163,0l99.375-98.675l14.194-14.089l14.194,14.089l-14.194,14.098 l-99.357,98.675C149.841,257.159,149.823,257.142,149.823,257.142z"></path> </g> </g>
                    </svg>
                </div>
                <input type="text" 
                  id="message-input" 
                  class="block w-full p-5 ps-12 text-sm border rounded-lg bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" 
                  placeholder="Type Your Message Here..." 
                  v-model="newMessage"
                  required 
                />
                <button 
                  type="submit" 
                  class="flex items-center px-3 py-1 text-white absolute end-2.5 bottom-3 focus:ring-4 focus:outline-none font-medium rounded-lg text-md bg-blue-600 hover:bg-blue-700 focus:ring-blue-800"
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
  watch: {
    messages() {
      this.scrollToBottom();
    }
  },
  mounted() {
    this.fetchCurrentUser();
    this.scrollToBottom();
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
          this.messages.push(response.data);

          // Clear the input field
          this.newMessage = ''; 

          // Scroll to the bottom after the message is added
          this.scrollToBottom();
        } catch (error) {
          console.error('Error sending message:', error);
        }
      }
    },
    async fetchCurrentUser() {
      try {
        const response = await axios.get('/api/user');
        this.currentUser = response.data;
        // console.log('Current User:', this.currentUser);  
      } catch (error) {
        console.error('Error fetching current user:', error);
      }
    },
    formatTime(dateString) {
      const date = new Date(dateString);
      if (isNaN(date)) {
        console.error(`Invalid date: ${dateString}`);
        return '';
      }
      return format(date, 'HH:mm');
    }, 
    scrollToBottom() {
      this.$nextTick(() => {
        const container = this.$refs.messagesContainer;
        if(container) {
          container.scrollTop = container.scrollHeight;
        }
      });
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
