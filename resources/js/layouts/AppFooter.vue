<script setup>
import { useLayout } from '../composables/layout';
import { computed } from 'vue';

const { layoutConfig } = useLayout();

const logoUrl = computed(() => {
    return `layout/images/${layoutConfig.darkTheme.value ? 'logo-white' : 'logo-dark'}.svg`;
});
</script>

<template>
    <div>
        <div class="footer-social-media d-flex p-5 flex-wrap justify-content-between"
            style="background-color: #145A79;">
            <div class="col-md-12 col-lg-6 d-sm-flex justify-content-center mb-3">
                <div class="d-flex">
                    <iframe width="250" height="250" class="rounded-4 border-0"
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2992.329138143673!2d2.028863386729124!3d41.41037335131185!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a49a9abc2c50f1%3A0x967c9dc9d440c41b!2sInstitut%20Bernat%20el%20Ferrer!5e0!3m2!1ses!2ses!4v1712599612391!5m2!1ses!2ses"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="d-flex flex-column ms-sm-3 justify-content-around">
                    <div class="d-flex align-items-center my-4 my-sm-0">
                        <i class="pi pi-map-marker text-white" style="font-size: 1.5rem"></i>
                        <p class="text-footer ms-2">{{ $t('ubicacion') }}</p>
                    </div>
                    <div class="d-flex align-items-center my-4 my-sm-0">
                        <i class="pi pi-clock text-white" style="font-size: 1.5rem"></i>
                        <p class="text-footer ms-2">{{ $t('horario') }}</p>
                    </div>
                    <div class="d-flex align-items-center my-4 my-sm-0">
                        <i class="pi pi-phone text-white" style="font-size: 1.5rem"></i>
                        <p class="text-footer ms-2">936683762</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 d-flex justify-content-center mb-3">
                <div class="d-flex flex-column align-items-start">
                    <h2 class="text-footer">{{ $t('tituloPolit') }}</h2>
                    <ul class="list-group list-group-flush">
                        <li class="text-footer bg-transparent border-0 list-group-item">{{ $t('avisLegal') }}</li>
                        <li class="text-footer bg-transparent border-0 list-group-item">{{ $t('polPriv') }}</li>
                        <li class="text-footer bg-transparent border-0 list-group-item">{{ $t('polCook') }}</li>
                    </ul>
                </div>
            </div>


            <div class="col-md-6 col-lg-3 d-flex justify-content-center mb-3">
                <div class="d-flex flex-column align-items-start">
                    <h2 class="text-footer">{{ $t('tituloIns') }}</h2>
                    <ul class="list-group list-group-flush">
                        <router-link to="/moodle">
                            <li class="text-footer bg-transparent border-0 list-group-item">Campus</li>
                        </router-link>
                        <router-link to="/" class="nav-link">
                            <li class="text-footer bg-transparent border-0 list-group-item">BernatRewards</li>
                        </router-link>
                        <router-link to="/shop" class="nav-link">
                            <li class="text-footer bg-transparent border-0 list-group-item">{{ $t('rewards') }}</li>
                        </router-link>                    </ul>
                </div>
            </div>
        </div>
        <div class="p-5 d-flex flex-column justify-content-center align-items-center border-top-1"
            style="background-color: #145A79;">
            <div class="container-fluid d-flex justify-content-center">
                <img class="m-2" src="/images/iconos/instagram.svg" alt="Instagram" style="width: 2rem;" />
                <img class="m-2" src="/images/iconos/facebook.svg" alt="Facebook" style="width: 2rem;" />
                <img class="m-2" src="/images/iconos/twitter.svg" alt="Twitter" style="width: 2rem;" />
            </div>
            <div>
                <p class="text-footer">{{ $t('copyright') }}</p>
            </div>
        </div>
    </div>

</template>
<style lang="scss" scoped>
.text-footer{
    color: white;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.footer-social-media{
    background-image: url('/images/backgrounds/triangles.png');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: bottom;

}
</style>
