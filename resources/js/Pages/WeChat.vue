<template>
    <Head title="WeChat" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">WeChat</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8 w-12/12 xl:w-9/12">
              
                    <div class="flex flex-wrap bg-gray-800 border border-slate-500 rounded-lg p-3">
                        <div class="w-full md:w-3/12">
                            <ChatContacts @selectedContact="handleSelectedContact" :contacts="contacts" />
                        </div>
                        <div class="w-full ps-3 md:w-9/12">
                            <ChatMessages  :messages="selectedContactMessages" :contact="selectedContact" />
                        </div>
                    </div>
               
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ChatContacts from '../Components/chat/ChatContacts.vue';
import ChatMessages from '../Components/chat/ChatMessages.vue';
import axios from 'axios';

export default {
    name: 'WeChat',
        components: {
        AuthenticatedLayout,
        Head,
        ChatContacts,
        ChatMessages,
    },
    data() {
        return {
            contacts: [],
            selectedContact: null,
            selectedContactMessages: [],
        }
    }, 
    methods: {
        async getContacts() {
            try {
                const response = await axios.get('/api/contacts');
                this.contacts = response.data;
                // console.log('this.contacts: ', this.contacts);
            } catch (error) {
                console.error('Error fetching contacts:', error);
            }
        },

        async handleSelectedContact(contact) {
            try {
                const response = await axios.get(`/api/messages/${contact.id}`);
                this.selectedContactMessages = response.data;
                // console.log('this.selectedContactMessages: ', this.selectedContactMessages);
                this.selectedContact = contact;
                // console.log('this.selectedContact: ', this.selectedContact);
            } catch (error) {
                console.error('Error fetching messages:', error);
            }
        },
    },
    mounted() {
        this.getContacts();
    }
}
</script>
