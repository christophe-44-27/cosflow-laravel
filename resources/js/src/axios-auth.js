import axios from 'axios'

const instance = axios.create({
    baseURL: "http://cosflow-laravel.test"
})

instance.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.accessToken

export default instance
