<template>
  <section class="main">
    <toggle-all></toggle-all>
    <ul class="todo-list">
      <todo-item v-for="todo in getVisibleTodos" :todo="todo" :key="todo.id" />
    </ul>
    <todo-footer></todo-footer>
  </section>
</template>

<script>
  import { mapActions, mapGetters } from 'vuex'

  import TodoFooter from './Footer/TodoFooter.vue'
  import TodoItem from './TodoItem.vue'
  import ToggleAll from './ToggleAll.vue'

  export default {
    components: {
      TodoFooter,
      TodoItem,
      ToggleAll
    },

    computed: {
      ...mapGetters([
        'getVisibleTodos'
      ])
    },

    methods: {
      ...mapActions([
        'getAllTodos'
      ])
    },

    created () {
      this.getAllTodos()
    }
  }
</script>
