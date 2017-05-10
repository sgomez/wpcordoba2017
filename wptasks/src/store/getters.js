import { SHOW_ALL, SHOW_COMPLETED, SHOW_ACTIVE } from './mutation-types'

export const getVisibleTodos = state => {
  const filter = state.filter.filter
  const todos = state.tasks.todos

  switch (filter) {
    case SHOW_ALL:
      return todos
    case SHOW_COMPLETED:
      return todos.filter(todo => todo.isCompleted)
    case SHOW_ACTIVE:
      return todos.filter(todo => !todo.isCompleted)
  }
}
