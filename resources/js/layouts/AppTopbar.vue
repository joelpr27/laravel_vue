<template>
    <section class="sticky-top">
        <nav class="col-12 cabezera navbar navbar-expand-lg bg-body-tertiary ">
            <div class="container-fluid">
                <router-link to="/" class="d-flex align-items-center contenedorLogo navbar-brand">
                    <img src="/images/logo/bernatRewards_Titulo.svg" class="logo d-none d-lg-block" alt="logo" />
                    <img src="/images/logo/bernatRewards.svg" class="logo d-lg-none" alt="logo" />

                </router-link>

                <div class="divLogo d-flex align-items-start justify-content-end me-4">
                    <button class="botonMenu p-link layout-menu-button layout-topbar-button"
                        @click="onMenuToggle(), cambiarFlecha()">
                        <i :class="classFlecha"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav m-0 ps-lg-2 ps-4">
                        <li class="nav-item">
                            <router-link to="/" class="nav-link" aria-current="page">{{ $t('home') }}</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/shop" class="nav-link">{{ $t('rewards')
                                }}</router-link>
                        </li>
                    </ul>



                    <ul class="navbar-nav ps-lg-0 ps-4 prueba">
                        <LocaleSwitcher />
                    </ul>


                </div>

                <div class="layout-topbar-menu flex" :class="topbarMenuClasses">

                    <button class="p-link layout-topbar-button layout-topbar-button-c nav-item dropdown flex"
                        role="button" data-bs-toggle="dropdown">

                        <i class="pi pi-user"></i>
                        <ul class="menuDesp dropdown-menu dropdown-menu-end">
                            <li><a v-if="user.roles[0]?.name == 'admin'" class="dropdown-item" href="javascript:void(0)" @click="admin()">
                                    Admin</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)" @click="perfil(user.id)">Perfil</a>
                            </li>
                            <li><a href="javascript:void(0)" @click="recompensas()" class="dropdown-item">{{
                                    $t('rewards') }}</a>
                            </li>
                            <li><a href="javascript:void(0)" @click="pedidos()" class="dropdown-item">{{
                                    $t('history') }}</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0)" @click="logout">{{ $t('logout')}}</a>
                            </li>
                            <!-- TODO este logout no borra los niveles del store -->
                        </ul>

                        <span class="nav-link dropdown-toggle ms-3 me-2" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $t('hello')}}, {{ user.name }}
                        </span>
                    </button>
                </div>

            </div>
        </nav>
    </section>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useRouter } from "vue-router";
import { useLayout } from '../composables/layout';
import useAuth from "@/composables/auth";
import { userStore } from '@/store/authPinia';
import LocaleSwitcher from "@/components/LocaleSwitcher.vue";


const user = userStore().vistaUser()
const router = useRouter()

const { onMenuToggle } = useLayout();
const { processing, logout } = useAuth();

const topbarMenuActive = ref(false);

const topbarMenuClasses = computed(() => {
    return {
        'layout-topbar-menu-mobile-active': topbarMenuActive.value
    };
});

const display = ref(true);

const cambiarFlecha = () => {
    display.value = !display.value;
};

const classFlecha = computed(() => {
    return display.value ? 'pi pi-angle-left' : 'pi pi-angle-right';
});

const admin = (() => {
    router.push({ name: 'admin.index' })
})

const perfil = ((id) => {
    router.push({ name: 'perfil.edit', params: { id: id } })
})

const recompensas = (() => {
    router.push({ name: 'recompensas.index' })
})

const pedidos = (() => {
    router.push({ name: 'pedidos.index' })
})
</script>

<style lang="scss" scoped>
.layout-topbar-button-c,
.layout-topbar-button-c:hover {
    width: auto;
    background-color: rgb(255, 255, 255, 0);
    border: 0;
    border-radius: 0%;
    padding: 1em;
}

.layout-topbar-logo {
    width: fit-content;
}


.layout-topbar {
    padding-left: 0px !important;
}

.divLogo {
    height: 100%;
    border-radius: 10px;
    width: fit-content;
    box-shadow: var(--bs-box-shadow);
}

.botonMenu {
    height: 100%;
    background-color: #d6d5d5;
    margin-left: 0px;
    border-radius: 0px 10px 10px 0px;
    border-style: solid;
    border-width: 1px;
    border-color: #dbdbdb;
    fill: #000;
    transition: color 0.25s ease 0.25s, background-color 0.25s ease 0.25s;
}

.botonMenu:hover {
    height: 100%;
    background-color: #145A79;
    margin-left: 0px;
    border-radius: 0px 10px 10px 0px;
    border-style: solid;
    border-width: 1px;
    border-color: #dbdbdb;
    color: #ffffff;
    transition: color 0.2s ease 0.2s, background-color 0.2s ease 0.2s;
}

.cabezera {
    background-color: white !important;
    box-shadow: 0px 0px 6px black !important;
}

.logo{
    height: 3.6rem;
}

.navbar-toggler{
    height: fit-content;
}

.menuPrincipal {
    width: fit-content;
}

.tarjetaUsu{
    width: fit-content !important;
}

.menuDesp{
    position: absolute !important;
    z-index: 99;
}
</style>
