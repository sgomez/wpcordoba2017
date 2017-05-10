<template>
  <span class="todo-count">
    <strong>{{ activeCount || 'No' }}</strong>
    {{' '}}
    {{ activeCount === 1 ? 'item' : 'items' }} left
  </span>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    computed: {
      ...mapGetters([
        'activeCount'
      ])
    }
  }
</script>
