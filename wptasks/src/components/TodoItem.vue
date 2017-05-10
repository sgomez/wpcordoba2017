<template>
  <li :class="classes">
    <todo-text-input v-if="editing"
       :text="todo.text"
       editing="editing"
       @save="handleSave"
    >
    </todo-text-input>
    <div class="view" v-else>
      <input
        type="checkbox"
        class="toggle"
        @change="handleChange"
        :checked="todo.isCompleted" />
      <label @dblclick="handleDoubleClick">
        {{ todo.text }}
      </label>
      <button class="destroy" @click="handleDestroy"></button>
    </div>
  </li>
</template>

<script>
  import { mapActions } from 'vuex'
  import TodoTextInput from './TodoTextInput.vue'

  export default {
    components: {
      TodoTextInput
    },

    computed: {
      classes: function () {
        return {
          completed: this.todo.isCompleted,
          editing: this.editing
        }
      }
    },

    data: function () {
      return {
        editing: false
      }
    },

    methods: {
      ...mapActions([
        'completeTodo',
        'deleteTodo',
        'editTodo'
      ]),

      handleChange: function (e) {
        this.completeTodo(this.todo)
      },

      handleDestroy: function (e) {
        this.deleteTodo(this.todo)
      },

      handleDoubleClick: function (e) {
        this.editing = true
      },

      handleSave: function (text) {
        const todo = this.todo

        if (text.length === 0) {
          this.deleteTodo(this.todo)
        } else {
          this.editTodo({ todo, text })
        }

        this.editing = false
      }
    },

    props: {
      todo: Object,
      isCompleted: Boolean,
      isRelatedTodoCompleted: Boolean
    }
  }
</script>
