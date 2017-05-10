<template>
  <section id="app" class="todoapp">
    <todo-header></todo-header>
    <main-section></main-section>
  </section>
</template>

<script>
  import TodoHeader from './components/TodoHeader.vue'
  import MainSection from './components/MainSection.vue'

  export default {
    name: 'app',
    components: {
      TodoHeader,
      MainSection
    }
  }
</script>

