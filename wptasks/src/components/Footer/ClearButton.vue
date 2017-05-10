<template>
  <button class="clear-completed"
          @click="handleClick">
    Clear completed
  </button>
</template>

<script>
  import { mapActions } from 'vuex'

  export default {
    methods: {
      ...mapActions([
        'clearCompleted'
      ]),

      handleClick: function (e) {
        this.clearCompleted()
      }
    }
  }
</script>
