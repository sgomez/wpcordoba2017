<template>
  <input
    :class="classes"
    type="text"
    :placeholder="placeholder"
    autofocus="true"
    @keyup.enter="handleSubmit"
    @blur="handleBlur"
    v-model="todo"/>
</template>

<script>
  export default {
    computed: {
      classes: function () {
        return {
          edit: this.editing,
          'new-todo': this.newTodo
        }
      }
    },

    data: function () {
      return {
        todo: this.text || ''
      }
    },

    methods: {
      handleBlur: function (e) {
        if (!this.newTodo) {
          this.$emit('save', this.todo)
        }
      },

      handleSubmit: function (e) {
        if (e.which === 13) {
          this.$emit('save', this.todo)
          if (this.newTodo) {
            this.todo = ''
          }
        }
      }
    },

    props: {
      editing: {
        type: Boolean,
        default: false
      },
      newTodo: {
        type: Boolean,
        default: false
      },
      placeholder: String,
      text: String
    }
  }
</script>
