import _ from 'lodash'

import Task from '../../api/tasks'
import { ADD_TODO, COMPLETE_ALL, COMPLETE_TODO, DELETE_TODO, EDIT_TODO, GET_TODOS } from '../mutation-types'

const state = {
  todos: []
}

const getters = {
  activeCount: state => _.filter(state.todos, todo => !todo.isCompleted).length,
  completedCount: state => _.filter(state.todos, todo => todo.isCompleted).length,
  completed: state => _.filter(state.todos, todo => todo.isCompleted),
  listedCount: state => state.todos.length
}

const actions = {
  async getAllTodos ({ commit }) {
    const tasks = await Task.getTasks()
    const todos = tasks.data.map(task => { return { id: task.id, text: task.title.rendered, isCompleted: task.status === 'completed' } })

    commit(GET_TODOS, { todos })
  },

  addTodo ({ commit }, { text }) {
    const task = Task.addTask(text)
    const todo = {
      id: task.id,
      text: text,
      isCompleted: false
    }
    commit(ADD_TODO, { todo })
  },

  clearCompleted ({ dispatch, getters }) {
    _.map(getters.completed, todo => dispatch('deleteTodo', { id: todo.id }))
  },

  completeAll ({ commit, state }) {
    commit(COMPLETE_ALL)
    _.map(state.todos, todo => Task.updateTask(todo))
  },

  completeTodo ({ commit }, todo) {
    commit(COMPLETE_TODO, { todo })
    Task.updateTask(todo)
  },

  deleteTodo ({ commit }, todo) {
    const { id } = todo

    commit(DELETE_TODO, { id })
    Task.deleteTask(id)
  },

  editTodo ({ commit }, { todo, text }) {
    commit(EDIT_TODO, { todo, text })
    Task.updateTask(todo)
  }
}

const mutations = {
  [ADD_TODO] (state, { todo }) {
    state.todos.push(todo)
  },

  [COMPLETE_ALL] (state) {
    const areSomeActive = _.some(state.todos, todo => !todo.isCompleted)
    _.map(state.todos, todo => { todo.isCompleted = areSomeActive })
  },

  [COMPLETE_TODO] (state, { todo }) {
    todo.isCompleted = !todo.isCompleted
  },

  [DELETE_TODO] (state, { id }) {
    state.todos = _.filter(state.todos, todo => todo.id !== id)
  },

  [EDIT_TODO] (state, { todo, text }) {
    todo.text = text
  },

  [GET_TODOS] (state, { todos }) {
    state.todos = todos
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
