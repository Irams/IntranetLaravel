<template>
    <!-- <span v-text="formatearFecha"></span> -->
    <span>{{ formatearFecha }}</span>
</template>

<script>
    export default {
        props: ['fecha'],
    //    mounted(){
    //        console.log('la fecha es: ', this.fecha);
    //    },
       //Vigila todos los cambios
       computed: {
           formatearFecha(){
               return moment(this.fecha).locale('es-mx').format('LL');
           }
       }

    }
</script>