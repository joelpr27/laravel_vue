import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'
import { userStore } from '@/store/authPinia';
import useNiveles from "@/composables/niveles"


export default function useProfile() {
    const profile = ref({})

    const router = useRouter()
    const validationErrors = ref({})
    const cargando = ref(false)
    const swal = inject('$swal')

    const getProfile = async (id) => {
        axios.get('/api/perfil/' + id)
        .then(response => {
            
            profile.value = response.data.data;
        })
    }

    const updateProfile = async (user) => {
        if (cargando.value) return;

        cargando.value = true

        // console.log(user);


        axios.post('/api/perfil/update/' + user.id, user, {
            headers: {
                "content-type": "multipart/form-data"
            }
        })
        .then(response => {
            userStore().user = response.data

            userStore().user.nextLevel = useNiveles().hasNextLevel()
            userStore().user.nivelActual = useNiveles().nivelActual()

            swal({
                icon: 'success',
                title: 'Perfil editado correctamente'
            })
        })
        .catch(error => {
            console.log(error)
            swal({
                icon: 'error',
                title: 'Perfil editado incorrectamente'
            })
        })
        .finally(() => cargando.value = false)
    }

    return {
        profile,
        getProfile,
        updateProfile,
        validationErrors,
        cargando
    }
}
