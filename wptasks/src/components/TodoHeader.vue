<template>
  <header class="header">
    <h1>todos</h1>
    <todo-text-input
      newTodo
      placeholder="What needs to be done?"
      @save="handleSave"
    />
  </header>
</template>

<script>
  import { mapActions } from 'vuex'
  import TodoTextInput from './TodoTextInput.vue'

  export default {
    components: {
      TodoTextInput
    },
    methods: {
      ...mapActions([
        'addTodo'
      ]),

      handleSave: function (text) {
        if (text.length !== 0) {
          this.addTodo({ text })
        }
      }
    }
  }
</script>
