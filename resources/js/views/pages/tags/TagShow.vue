<template>
    <div>
        <h1>Tag selezionato: {{this.$route.params.name}} </h1>

      <TagCard />
    </div>
</template>

<script>

import TagCard from '../../../components/tags/TagCard.vue'

export default {
    name: 'TagShow',
    components:{
        TagCard
    }
}
</script>
