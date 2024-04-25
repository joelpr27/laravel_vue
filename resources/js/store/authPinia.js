import { defineStore } from 'pinia'
import axios from 'axios'
import { ref, reactive } from 'vue'

export const userStore = defineStore ('userStore', () => {
    
    const user = ref({})
    const authenticated = ref(false)

    function login() {
        axios.get('/api/user').then(response => {
            user.value = response.data.data
            authenticated.value = true
        }).catch((error) => {
            console.error("Error, " + error)
            user.value = {}
            authenticated.value = false
        })
    }


    function vistaUser() {
       return user;
    }
    async function getUser() {
        await axios.get('/api/user').then(response => {
            user.value = response.data.data
            authenticated.value = true

        }).catch((error) => {
            console.error("Error, " + error)
            user.value = {}
            authenticated.value = false

        })
    }

    function logout(){
        user.value = {}
        authenticated.value = false
    }


    return {
        user,
        vistaUser,
        authenticated,
        login,
        getUser,
        logout,
    }
}, {persist: true})