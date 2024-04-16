import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

export default function useUsers() {
    const users = ref([])
    const user = ref({
        name: '',
        email: '',
        password: '',
        roles: '',
        imagen: '',
        puntos: '',
        experience: ''
    })

    const router = useRouter()
    const validationErrors = ref({})
    const cargando = ref(false)
    const swal = inject('$swal')

    const getUsers = async (
        page = 1,
        search_id = '',
        search_title = '',
        search_global = '',
        order_column = 'created_at',
        order_direction = 'desc'
    ) => {
        axios.get('/api/users?page=' + page +
            '&search_id=' + search_id +
            '&search_title=' + search_title +
            '&search_global=' + search_global +
            '&order_column=' + order_column +
            '&order_direction=' + order_direction)
            .then(response => {
                users.value = response.data;
            })
    }

    const getUser = async (id) => {
        axios.get('/api/users/' + id)
            .then(response => {
                user.value = response.data.data;
            })
    }

    const storeUser = async (user) => {
        console.log("USER:");
        console.log(user);

        if (cargando.value) return;
        
        cargando.value = true
        validationErrors.value = {}

        let serializedPost = new FormData()
        for (let item in user) {
            if (user.hasOwnProperty(item)) {
                serializedPost.append(item, user[item])
            }
        }

        console.log("SERIAL:")
        console.log(serializedPost);
        
        axios.post('/api/users', serializedPost,{
                headers: {
                    "content-type": "multipart/form-data"
                }
            })
            .then(response =>{
                router.push({ name: 'users.index' })
                    swal({
                        icon: 'success',
                        title: 'Usuario creado correctamente'
                    })
            })
            .catch(error => {
                swal({
                    icon: 'error',
                    title: 'Error al crear el usuario'
                })
            })
            .finally(() => cargando.value = false)


    }


    // const updateUser = async (user) => {
    //     if (isLoading.value) return;

    //     isLoading.value = true
    //     validationErrors.value = {}

    //     axios.put('/api/users/' + user.id, user)
    //         .then(response => {
    //             router.push({name: 'users.index'})
    //             swal({
    //                 icon: 'success',
    //                 title: 'User updated successfully'
    //             })
    //         })
    //         .catch(error => {
    //             if (error.response?.data) {
    //                 validationErrors.value = error.response.data.errors
    //             }
    //         })
    //         .finally(() => isLoading.value = false)
    // }

    const updateUser = async (user) => {
        if (cargando.value) return;

        cargando.value = true


        axios.post('/api/users/update/' + user.id, user, {
            headers: {
                "content-type": "multipart/form-data"
            }
        })
        .then(response => {
            console.log(response)
            // router.push({ name: 'user.index' })
            swal({
                icon: 'success',
                title: 'User editado correctamente'
            })
        })
        .catch(error => {
            console.log(error)
            swal({
                icon: 'error',
                title: 'User editado incorrectamente'
            })
        })
        .finally(() => cargando.value = false)
    }

    const deleteUser = async (id) => {
        swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this action!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#ef4444',
            timer: 20000,
            timerProgressBar: true,
            reverseButtons: true
        })
            .then(result => {
                if (result.isConfirmed) {
                    axios.delete('/api/users/' + id)
                        .then(response => {
                            getUsers()
                            router.push({name: 'users.index'})
                            swal({
                                icon: 'success',
                                title: 'User deleted successfully'
                            })
                        })
                        .catch(error => {
                            swal({
                                icon: 'error',
                                title: 'Something went wrong'
                            })
                        })
                }
            })
    }

    return {
        users,
        user,
        getUsers,
        getUser,
        storeUser,
        updateUser,
        deleteUser,
        validationErrors,
        cargando
    }
}
