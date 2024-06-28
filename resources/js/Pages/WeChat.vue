<template>
    <Head title="WeChat" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">WeChat</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-wrap -mx-2 h-[70vh]">
                        <div class="w-full lg:w-2/12 border">
                            <h1 class="text-3xl font-bold py-4 px-5">Contacts</h1>
                            <ChatContacts :contacts="contacts" />
                        </div>
                        <div class="w-full lg:w-10/12 border">
                            <ChatMessages />
                        </div>
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
        }
    }, 
    methods: {
        async getContacts() {
            const response = await axios.get('/api/contacts');
            this.contacts = response.data;
        }
    },
    mounted() {
        this.getContacts();
    }
}
</script>
