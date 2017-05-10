import axios from 'axios'

axios.defaults.baseURL = process.env.API_BASE_URL
axios.defaults.auth = { username: process.env.AUTH_USER, password: process.env.AUTH_PASS }

export default {
  addTask (text) {
    return axios.post('/tasks', {
      title: text,
      status: 'todo'
    })
  },

  deleteTask (id) {
    return axios.delete(`/tasks/${id}`)
  },

  updateTask (todo) {
    const { id, text, isCompleted } = todo

    return axios.post(`/tasks/${id}`, {
      title: text,
      status: isCompleted ? 'completed' : 'todo'
    })
  },

  getTasks () {
    return axios.get('/tasks?status=completed,todo')
  }
}
