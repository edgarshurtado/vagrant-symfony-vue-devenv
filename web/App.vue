<template>
  <h1>{{ i18n.greetings }}</h1>
</template>
<script>
export default {
    props:{
        propA:Number
    },
    data(){
        return {
            i18n:{
                greetings: 'Saludos Lockers'
            }
        }
    }
}
</script>