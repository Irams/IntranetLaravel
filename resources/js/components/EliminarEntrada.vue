<template>
    <input type="submit" 
           class="btn btn-danger d-block w-100 mb-2" 
           value="Eliminar x"
           @click="eliminarEntrada"
           >
</template>

<script>
    export default {
        props:['entradaId'],
        mounted(){
            // console.log('entrada actual');
        },
        methods: {
            eliminarEntrada(){
                this.$swal({
                    title: '¿Deseas eliminar esta entrada?',
                    text: "Una vez eliminada no se puede recuperar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                  if (result.value) {
                      const params = {
                          id: this.entradaId
                      }

                    //Enviar petición al servidor con Axios
                    axios.post(`/entradas/${this.entradaId}`, {params, _method:'delete'})
                            .then(resp =>{
                                this.$swal({
                                  title: 'Entrada eliminada',
                                  text: 'Se eliminó la entrada',
                                  icon: 'success'
                                });

                                //Eliminar entrada del DOM
                                // console.log(this.$el);
                                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);


                            }).catch(error =>{
                                console.log(error);
                            })

                    // this.$swal({
                    //   title: 'Entrada eliminada',
                    //   text: 'Se eliminó la entrada',
                    //   icon: 'success'
                    // })
                  }
                })
            }
        }
    }
</script>
